<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Product};
use DataTables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function getCategories(Request $request){
        $catType = config('global_values.category_type');
        $query = Category::notDeleted();

        if (isset($request->status) && $request->status != '') {
            $query = $query->where('is_active', (int)$request->status);
        }       
        if (isset($request->category_type) && $request->category_type != '') {
            $query = $query->where('category_type', (int)$request->category_type);
        }       
        return Datatables::of($query)      
            ->editColumn('category_type', function ($result) use ($catType){
                if(isset($result->category_type)){
                    return $catType[$result->category_type];
                }else{
                   return '-';
                }  
            })  
            ->editColumn('banner_image', function ($result) {
                if(isset($result->banner_image)){
                    return '<img src="' . url('public/images/admin/category_banner/' . $result->banner_image) . '" width="150">';
                }else{
                   return '<img src="' . url('public/images/no_img.png') . '" width="80">';
                }  
            })
            ->addColumn('status', function ($result) {  
                if ($result->is_active == 0) {
                    return '<div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked onclick="updateStatus(1,' . $result->id . ');">
                                <label class="form-check-label">Active</label>
                            </div>';
                    }
                    else
                    {
                        return '<div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" onclick="updateStatus(0,' . $result->id . ');">
                                <label class="form-check-label">In-Active</label>
                            </div>';;
                    }              
            })        
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.categories.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-category" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })    
            //->escapeColumns([])  
            ->rawColumns(['status', 'action', 'banner_image'])
            ->make(true);
    }

    public function updateStatus(Request $request){
        $category = Category::find($request->id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ]);
        }
        $checkProduct = Product::isActive()->notDeleted()->where('category_id', $request->id)->exists();
        if($checkProduct && $request->status == 0){
            return response()->json([
                'success' => false,
                'message' => 'You can not update status for this Category as it associated with any Product'
            ]);
        }

        $category->is_active = $request->status;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    public function create()
    {
        return view('admin.category.create');

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'category_type' => 'required',
            'category_url' => 'required|string|max:255|unique:categories,category_url',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'category_name.required' => 'Category name is required.',
            'category_name.string' => 'Category name must be a valid string.',
            'category_name.max' => 'Category name cannot exceed 255 characters.',

            'category_type.required' => 'Category type is required.',

            'category_url.required' => 'Category URL is required.',
            'category_url.string' => 'Category URL must be a valid string.',
            'category_url.max' => 'Category URL cannot exceed 255 characters.',
            'category_url.unique' => 'This category URL is already taken.',

            'meta_title.required' => 'Meta title is required.',
            'meta_title.string' => 'Meta title must be a valid string.',
            'meta_title.max' => 'Meta title cannot exceed 255 characters.',

            'meta_description.required' => 'Meta description is required.',
            'meta_description.string' => 'Meta description must be a valid string.',
            'meta_description.max' => 'Meta description cannot exceed 255 characters.',

            'banner_image.required' => 'Banner image name is required.',
            'banner_image.image' => 'Banner image must be a valid image.',
            'banner_image.mimes' => 'Banner image must be a file of type: jpg, jpeg, png, webp.',
            'banner_image.max' => 'Banner image size must not exceed 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'category_name',
            'title',
            'description',
            'meta_title',
            'meta_description',
            'category_url',
            'category_type',
            'magic_heading_first',
            'magic_heading_second',
            'magic_title',
            'magic_description'
        ]);

        if ($request->hasFile('banner_image')) {
            // $image = $request->file('banner_image');
            // $imageName = "CategoryBanner_".time() . '.' . $image->getClientOriginalExtension();
            // $image->move(public_path('images/admin/category_banner'), $imageName);
            // $data['banner_image'] = $imageName;
            $image = $request->file('banner_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/admin/category_banner'), $imageName);
            $data['banner_image'] = $imageName;
        }
        if ($request->hasFile('magic_image')) {
            $image = $request->file('magic_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/admin/category_magic'), $imageName);
            $data['magic_image'] = $imageName;
        }
        $data['is_active'] = 0;
        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully');

    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'category_type' => 'required',
            'category_url' => 'required|string|max:255|unique:categories,category_url,' . $id,
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'category_name.required' => 'Category name is required.',
            'category_name.string' => 'Category name must be a valid string.',
            'category_name.max' => 'Category name cannot exceed 255 characters.',

            'category_type.required' => 'Category type is required.',

            'category_url.required' => 'Category URL is required.',
            'category_url.string' => 'Category URL must be a valid string.',
            'category_url.max' => 'Category URL cannot exceed 255 characters.',
            'category_url.unique' => 'This category URL is already taken.',

            'meta_title.required' => 'Meta title is required.',
            'meta_title.string' => 'Meta title must be a valid string.',
            'meta_title.max' => 'Meta title cannot exceed 255 characters.',

            'meta_description.required' => 'Meta description is required.',
            'meta_description.string' => 'Meta description must be a valid string.',
            'meta_description.max' => 'Meta description cannot exceed 255 characters.',

            'banner_image.image' => 'Banner image must be a valid image.',
            'banner_image.mimes' => 'Banner image must be a file of type: jpg, jpeg, png, webp.',
            'banner_image.max' => 'Banner image size must not exceed 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = Category::findOrFail($id);
            $data = $request->only([
            'category_name',
            'title',
            'description',
            'meta_title',
            'meta_description',
            'category_url',
            'category_type',
            'magic_heading_first',
            'magic_heading_second',
            'magic_title',
            'magic_description'
        ]);

        if ($request->hasFile('banner_image')) {
            // $image = $request->file('banner_image');
            // $imageName = "CategoryBanner_".time() . '.' . $image->getClientOriginalExtension();
            // $image->move(public_path('images/admin/category_banner'), $imageName);
            // $data['banner_image'] = $imageName;
            $image = $request->file('banner_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/admin/category_banner'), $imageName);
            $data['banner_image'] = $imageName;

            // if ($category->banner_image && file_exists(public_path('images/admin/category_banner/'.$category->banner_image))) {
            //     unlink(public_path('images/admin/category_banner/'.$category->banner_image));
            // }
        }
        if ($request->hasFile('magic_image')) {
            $image = $request->file('magic_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/admin/category_magic'), $imageName);
            $data['magic_image'] = $imageName;
        }
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $category = Category::where('id', $id)->first();
        if (empty($category)) {
            return response()->json([
                'result' => false,
                'message' => "Category Not Found."
            ]);
        }
        $checkProduct = Product::isActive()->notDeleted()->where('category_id', $id)->exists();
        if($checkProduct){
            return response()->json([
                'success' => false,
                'message' => 'You can not update status for this Category as it associated with any Product'
            ]);
        }
        $category->delete();

        return response()->json([
            'result' => true,
            'message' => "Data Deleted."
        ]);
    }
}