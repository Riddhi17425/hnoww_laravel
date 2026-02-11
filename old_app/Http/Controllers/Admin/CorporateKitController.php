<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{CorporateKit};
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CorporateKitController extends Controller
{
    public function index()
    { 
        return view('admin.corporatekit.index');
    }

    public function getCorporateKits(Request $request){
        $query = CorporateKit::whereNull('deleted_at');

        if (isset($request->status) && $request->status != '') {
            $query = $query->where('is_active', (int)$request->status);
        }     
        return Datatables::of($query)
            ->editColumn('short_description', function ($result) {
                if(isset($result->short_description) && $result->short_description != ''){
                    return $result->short_description;
                }else{
                   return '-';
                }  
            })     
            ->editColumn('image', function ($result) {
                if(isset($result->image)){
                    return '<img src="' . url('public/images/admin/corporatekit/' . $result->image) . '" width="150">';
                }else{
                   return '<img src="' . url('public/images/no_img.png') . '" width="80">';
                }  
            })
            ->addColumn('status', function ($result) {  
                if ($result->is_active == 0) {
                    return '<div class="form-check form-switch">
                                <input class="form-check-i`nput" type="checkbox" checked role="switch" onclick="updateStatus(1,' . $result->id . ');">
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
                $editUrl = route('admin.corporate-kits.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-corporatekit" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })    
            ->rawColumns(['status', 'action', 'image', 'short_description'])
            ->make(true);
    }

    public function updateStatus(Request $request){
        $corporateKit = CorporateKit::find($request->id);

        if (!$corporateKit) {
            return response()->json([
                'success' => false,
                'message' => 'Corporate Kit not found'
            ]);
        }

        $corporateKit->is_active = $request->status;
        $corporateKit->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    public function create()
    {
        return view('admin.corporatekit.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'moq' => 'required|max:255',
            'price_range' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'short_description' => 'required|string|max:500',
            'large_description' => 'nullable|string|max:5000',
        ], [
            'title.required' => 'Title is required.',
            'title.string' => 'Title must be a valid string.',
            'title.max' => 'Title cannot exceed 255 characters.',
            'moq.required' => 'MOQ is required.',
            'moq.max' => 'MOQ cannot exceed 255 characters.',
            'price_range.required' => 'Price Range is required.',
            'price_range.string' => 'Price Range must be a valid string.',
            'price_range.max' => 'Price Range cannot exceed 255 characters.',
            'image.required' => 'Please upload the image.',
            'image.image'    => 'The image must be a valid image.',
            'image.mimes'    => 'The image must be a JPG, JPEG, PNG, or WEBP file.',
            'image.max'      => 'The image size must not exceed 5 MB.',
            'short_description.required' => 'Short description is Required.',
            'short_description.string' => 'Short description must be a valid string.',
            'short_description.max' => 'Short description cannot exceed 500 characters.',
            'large_description.string' => 'Large description must be a valid string.',
            'large_description.max' => 'Large description cannot exceed 5000 characters.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'title', 'short_description', 'large_description', 'image', 'price_range', 'moq'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $path = public_path('images/admin/corporatekit/');

            $file->move($path, $originalName);
            $imageName = $originalName;
        }

        $data['image'] = $imageName;
        $data['is_active'] = 0; // default active

        CorporateKit::create($data);

        return redirect()->route('admin.corporate-kits.index')->with('success', 'Corporate Kit added successfully');

    }

    public function edit($id)
    {
        $corporateKit = CorporateKit::find($id);
        return view('admin.corporatekit.edit', compact('corporateKit'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'moq' => 'required|max:255',
            'price_range' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'short_description' => 'required|string|max:500',
            'large_description' => 'nullable|string|max:5000',
        ], [
            'title.required' => 'Title is required.',
            'title.string' => 'Title must be a valid string.',
            'title.max' => 'Title cannot exceed 255 characters.',
            'moq.required' => 'MOQ is required.',
            'moq.max' => 'MOQ cannot exceed 255 characters.',
            'price_range.required' => 'Price Range is required.',
            'price_range.string' => 'Price Range must be a valid string.',
            'price_range.max' => 'Price Range cannot exceed 255 characters.',
            'image.image'    => 'The image must be a valid image.',
            'image.mimes'    => 'The image must be a JPG, JPEG, PNG, or WEBP file.',
            'image.max'      => 'The image size must not exceed 5 MB.',
            'short_description.required' => 'Short description is Required.',
            'short_description.string' => 'Short description must be a valid string.',
            'short_description.max' => 'Short description cannot exceed 500 characters.',
            'large_description.string' => 'Large description must be a valid string.',
            'large_description.max' => 'Large description cannot exceed 5000 characters.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $corporateKit = CorporateKit::where('id', $id)->first();
        $data = $request->only(['title', 'short_description', 'large_description', 'image', 'price_range', 'moq']);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = $imageFile->getClientOriginalName();
            $imageFile->move(public_path('images/admin/corporatekit/'), $imageName);
            $data['image'] = $imageName;
        }
        
        $corporateKit->update($data);

        return redirect()->route('admin.corporate-kits.index')->with('success', 'Corporate Kit updated successfully');
    }

    public function delete($id)
    {
        $gift = CorporateKit::where('id', $id)->first();
        if (empty($gift)) {
            return response()->json([
                'result' => false,
                'message' => "Gift Not Found."
            ]);
        }
        $gift->delete();

        return response()->json([
            'result' => true,
            'message' => "Data Deleted."
        ]);
    }
}
