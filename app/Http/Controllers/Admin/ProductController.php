<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Category};
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::isActive()->notDeleted()->where('category_type', 0)->get();
        $corporateCategories = Category::isActive()->notDeleted()->where('category_type', 1)->get();
        $weddingCategories = Category::isActive()->notDeleted()->where('category_type', 2)->get();
        return view('admin.product.index', compact('categories', 'corporateCategories', 'weddingCategories'));
    } 

    public function getProducts(Request $request){
        $catType = config('global_values.category_type');
        $query = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.*', 'categories.category_name as category_name')->notDeleted();

        if (isset($request->status) && $request->status != '') {
            $query = $query->where('products.is_active', (int)$request->status);
        }      
        if (isset($request->product_type) && $request->product_type != '') {
            $query = $query->where('product_type', (int)$request->product_type);
        } 
        return Datatables::of($query)
            ->editColumn('product_type', function ($result) use ($catType) {
                if(isset($result->product_type) && $result->product_type != ''){
                    return $catType[$result->product_type];
                }else{
                   return '-';
                }  
            }) 
            ->editColumn('short_description', function ($result) {
                if(isset($result->short_description) && $result->short_description != ''){
                    return $result->short_description;
                }else{
                   return '-';
                }  
            })      
            ->addColumn('category_name', function ($result) {
                return $result->category_name ?? '-'; 
            })
            ->filterColumn('category_name', function($query, $keyword) {
                $query->where('categories.category_name', 'like', "%{$keyword}%");
            })
            ->addColumn('status', function ($result) {  
                if ($result->is_active == 0) {
                    return '<div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked role="switch" onclick="updateStatus(1,' . $result->id . ');">
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
                $editUrl = route('admin.products.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-product" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })    
            ->rawColumns(['status', 'action', 'category_name', 'list_img', 'detail_img', 'short_description'])
            ->make(true);
    }

    public function updateStatus(Request $request){
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        $product->is_active = $request->status;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    public function create()
    {
        $categories = Category::isActive()->notDeleted()->where('category_type', 1)->get();
        $corporateCategories = Category::isActive()->notDeleted()->where('category_type', 2)->get();
        $weddingCategories = Category::isActive()->notDeleted()->where('category_type', 3)->get();

        return view('admin.product.create', compact('categories', 'corporateCategories', 'weddingCategories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'category_type' => 'required',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|string|max:255',
            'product_url' => 'required|string|max:255|unique:products,product_url',
            'product_stock' => 'required|integer|min:0',
            'list_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            //'list_img' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'detail_imgs'       => 'nullable|array|min:1',
            'detail_imgs.*'     => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'short_note' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'large_description' => 'nullable|string|max:5000',
            'dimensions' => 'nullable|string|max:5000',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:1000',
        ], [
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Selected category does not exist.',
            'category_type.required' => 'Category Type required.',
            'product_name.required' => 'Product name is required.',
            'product_name.string' => 'Product name must be a valid string.',
            'product_name.max' => 'Product name cannot exceed 255 characters.',
            'product_price.required' => 'Product price is required.',
            'product_price.string' => 'Product price must be a valid string.',
            'product_price.max' => 'Product price cannot exceed 255 characters.',
            'product_url.required' => 'Product URL is required.',
            'product_url.string' => 'Product URL must be a valid string.',
            'product_url.max' => 'Product URL cannot exceed 255 characters.',
            'product_url.unique' => 'This product URL is already taken.',
            'product_stock.required' => 'Product stock is required.',
            'product_stock.integer'  => 'Product stock must be a whole number.',
            'product_stock.min'      => 'Product stock cannot be negative.',
            //'list_img.required' => 'Please upload the list page image.',
            'list_img.image'    => 'The list page file must be a valid image.',
            'list_img.mimes'    => 'The list page image must be a JPG, JPEG, PNG, or WEBP file.',
            'list_img.max'      => 'The list page image size must not exceed 5 MB.',
            //'detail_imgs.*.required' => 'Please upload at least one detail page image.',
            'detail_imgs.*.image'    => 'Each detail page file must be a valid image.',
            'detail_imgs.*.mimes'    => 'Detail page images must be JPG, JPEG, PNG, or WEBP files.',
            'short_note.string' => 'Product short Note must be a valid string.',
            'short_note.max' => 'Product short Note cannot exceed 500 characters.',
            'short_description.string' => 'Product short description must be a valid string.',
            'short_description.max' => 'Product short description cannot exceed 500 characters.',
            'large_description.string' => 'Product large description must be a valid string.',
            'large_description.max' => 'Product large description cannot exceed 5000 characters.',
            'dimensions.string' => 'Product Dimension must be a valid string.',
            'dimensions.max' => 'Product Dimension cannot exceed 5000 characters.',
            'meta_title.required' => 'Meta title is required.',
            'meta_title.string' => 'Meta title must be a valid string.',
            'meta_title.max' => 'Meta title cannot exceed 255 characters.',
            'meta_description.required' => 'Meta description is required.',
            'meta_description.string' => 'Meta description must be a valid string.',
            'meta_description.max' => 'Meta description cannot exceed 1000 characters.'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'category_id', 'product_name', 'product_price', 'short_description', 'large_description',
            'meta_title', 'meta_description', 'product_url', 'dimensions', 'moq', 'short_note', 'product_stock'
        ]);

        // STORE LIST PAGE IMAGE (SINGLE)
        $listImageName = null;
        if ($request->hasFile('list_img')) {
            // $file = $request->file('list_img');
            // $listImageName = 'list_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            // $file->move(public_path('images/product_list'), $listImageName);
            $file = $request->file('list_img');
            $originalName = $file->getClientOriginalName();
            $path = public_path('images/admin/product_list');

            // Prevent overwrite
            if (File::exists($path.'/'.$originalName)) {
                //$originalName = time().'_'.$originalName;
                //return redirect()->back()->with('error', 'Name already existed');
            }

            $file->move($path, $originalName);
            $listImageName = $originalName;
        }

        // STORE DETAIL PAGE IMAGES (MULTIPLE)
        $detailImages = [];
        if ($request->hasFile('detail_imgs')) {
            foreach ($request->file('detail_imgs') as $key => $img) {
                //$fileName = 'detail_' . time() . '_' . $key . '_' . Str::random(6) . '.' . $img->getClientOriginalExtension();
                //$img->move(public_path('images/product_detail'), $fileName);

                $originalName = $img->getClientOriginalName();
                $path = public_path('images/admin/product_detail');
                $img->move($path, $originalName);
                $detailImages[] = $originalName;
            }
        }

        $data['list_page_img'] = $listImageName;
        $data['detail_page_imgs'] = json_encode($detailImages);
        $data['is_active'] = 0; // default active
        $data['product_type'] = $request->category_type; 

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully');

    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::isActive()->notDeleted()->where('category_type', 1)->get();
        $corporateCategories = Category::isActive()->notDeleted()->where('category_type', 2)->get();
        $weddingCategories = Category::isActive()->notDeleted()->where('category_type', 3)->get();
        return view('admin.product.edit', compact('product', 'categories', 'corporateCategories', 'weddingCategories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|string|max:255',
            'product_url' => 'required|string|max:255|unique:products,product_url,' . $id,
            'product_stock' => 'required|integer|min:0',
            // 'list_img' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            // 'detail_imgs'       => 'required|array|min:1',
            // 'detail_imgs.*'     => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            // LIST IMAGE: required ONLY if not exists
            'list_img' => $product->list_page_img ? 'nullable|mimes:jpg,jpeg,png,webp|max:5120' : 'required|mimes:jpg,jpeg,png,webp|max:5120',
            // DETAIL IMAGES: required ONLY if not exists
            'detail_imgs' => empty($product->detail_page_imgs) ? 'required|array|min:1': 'nullable|array',
            'detail_imgs.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'short_note' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'large_description' => 'nullable|string|max:5000',
            'dimensions' => 'nullable|string|max:5000',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:1000',
        ], [
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Selected category does not exist.',
            'product_name.required' => 'Product name is required.',
            'product_name.string' => 'Product name must be a valid string.',
            'product_name.max' => 'Product name cannot exceed 255 characters.',
            'product_price.required' => 'Product price is required.',
            'product_price.string' => 'Product price must be a valid string.',
            'product_price.max' => 'Product price cannot exceed 255 characters.',
            'product_url.required' => 'Product URL is required.',
            'product_url.string' => 'Product URL must be a valid string.',
            'product_url.max' => 'Product URL cannot exceed 255 characters.',
            'product_url.unique' => 'This product URL is already taken.',
            'product_stock.required' => 'Product stock is required.',
            'product_stock.integer'  => 'Product stock must be a whole number.',
            'product_stock.min'      => 'Product stock cannot be negative.',
            'list_img.required' => 'Please upload the list page image.',
            'list_img.image'    => 'The list page file must be a valid image.',
            'list_img.mimes'    => 'The list page image must be a JPG, JPEG, PNG, or WEBP file.',
            'list_img.max'      => 'The list page image size must not exceed 5 MB.',
            'detail_imgs.required' => 'Please upload at least one detail page image.',
            'detail_imgs.*.image'    => 'Each detail page file must be a valid image.',
            'detail_imgs.*.mimes'    => 'Detail page images must be JPG, JPEG, PNG, or WEBP files.',
            'short_note.string' => 'Product short Note must be a valid string.',
            'short_note.max' => 'Product short Note cannot exceed 500 characters.',
            'short_description.string' => 'Product short description must be a valid string.',
            'short_description.max' => 'Product short description cannot exceed 500 characters.',
            'large_description.string' => 'Product large description must be a valid string.',
            'large_description.max' => 'Product large description cannot exceed 5000 characters.',
            'dimensions.string' => 'Product Dimension must be a valid string.',
            'dimensions.max' => 'Product Dimension cannot exceed 5000 characters.',
            'meta_title.required' => 'Meta title is required.',
            'meta_title.string' => 'Meta title must be a valid string.',
            'meta_title.max' => 'Meta title cannot exceed 255 characters.',
            'meta_description.required' => 'Meta description is required.',
            'meta_description.string' => 'Meta description must be a valid string.',
            'meta_description.max' => 'Meta description cannot exceed 1000 characters.'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::findOrFail($id);
        $data = $request->only([
            'category_id', 'product_name', 'product_price', 'short_description', 'large_description',
            'meta_title', 'meta_description', 'product_url', 'dimensions', 'moq', 'short_note', 'product_stock'
        ]);
        if ($request->hasFile('list_img')) {
            // delete old file
            if ($product->list_page_img && file_exists(public_path('images/admin/product_list/' . $product->list_page_img))) {
                unlink(public_path('images/admin/product_list/' . $product->list_page_img));
            }
            $listImg = $request->file('list_img');
            $listName = $listImg->getClientOriginalName();
            $listImg->move(public_path('images/admin/product_list'), $listName);
            $product->update([
                'list_page_img' => $listName
            ]);
        }
        if ($request->hasFile('detail_imgs')) {
            // existing images from DB
            $existingImages = $product->detail_page_imgs
                ? json_decode($product->detail_page_imgs, true)
                : [];
            foreach ($request->file('detail_imgs') as $img) {
                $name = $img->getClientOriginalName();
                $img->move(public_path('images/admin/product_detail'), $name);
                $existingImages[] = $name;
            }
            $product->update([
                'detail_page_imgs' => json_encode($existingImages)
            ]);
        }
        $data['product_type'] = $request->category_type;
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        if (empty($product)) {
            return response()->json([
                'result' => false,
                'message' => "Product Not Found."
            ]);
        }
        $product->delete();

        return response()->json([
            'result' => true,
            'message' => "Data Deleted."
        ]);
    }

    public function deleteDetailImage(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $images = json_decode($product->detail_page_imgs, true);
        if (isset($images[$request->index])) {
            $path = public_path('images/admin/product_detail/'.$images[$request->index]);
            if (file_exists($path)) unlink($path);
            unset($images[$request->index]);
            $product->detail_page_imgs = json_encode(array_values($images));
            $product->save();
        }

        return response()->json(['success' => true]);
    }

    public function deleteAllDetailImages(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $images = json_decode($product->detail_page_imgs, true);
        if ($images) {
            foreach ($images as $img) {
                $path = public_path('images/admin/product_detail/'.$img);
                if (file_exists($path)) unlink($path);
            }
        }
        $product->detail_page_imgs = null;
        $product->save();

        return response()->json(['success' => true]);
    }
}
