<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Ceremonial};
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CeremonialController extends Controller
{
    public function index()
    {
        return view('admin.ceremonial.index');
    }

    public function getCeremonials(Request $request){
        $query = Ceremonial::query();
        if (isset($request->status) && $request->status != '') {
            $query = $query->where('is_active', (int)$request->status);
        }       
        return Datatables::of($query)  
            ->editColumn('description', function ($result) {
                if(isset($result->description)){
                    return $result->description;
                }else{
                   return '-';
                }  
            })  
            ->editColumn('image', function ($result) {
                if(isset($result->image)){
                    return '<img src="' . url('public/images/admin/ceremonial/' . $result->image) . '" width="150">';
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
                $editUrl = route('admin.ceremonials.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-ceremonial" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })    
            //->escapeColumns([])  
            ->rawColumns(['status', 'action', 'image', 'description'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.ceremonial.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required'       => 'The title is required.',
            'title.string'         => 'The title must be a valid text.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'description.required' => 'The description is required.',
            'description.string'   => 'The description must be valid text.',

            'image.required'       => 'An image is required.',
            'image.image'          => 'The uploaded file must be an image.',
            'image.mimes'          => 'The image must be jpeg, png, jpg, or gif.',
            'image.max'            => 'The image size may not be greater than 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ceremonial = new Ceremonial();
        $ceremonial->title = $request->title;
        $ceremonial->description = $request->description;
        $ceremonial->is_active = 0;
        $ceremonial->save();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/admin/ceremonial/'), $imageName);
            $ceremonial->image = $imageName;
        }

        $ceremonial->save();

        return redirect()->route('admin.ceremonials.index')->with('success', 'Ceremonial added successfully!');
    }

    public function updateStatus(Request $request){
        $ceremonial = Ceremonial::find($request->id);
        if (!$ceremonial) {
            return response()->json([
                'success' => false,
                'message' => 'Ceremonial not found'
            ]);
        }
        $ceremonial->is_active = $request->status;
        $ceremonial->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    public function edit(string $id)
    {
        $ceremonial = Ceremonial::find($id);
        return view('admin.ceremonial.edit', compact('ceremonial'));
    }

    public function update(Request $request, string $id)
    { 
        $ceremonial = Ceremonial::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required'       => 'The title is required.',
            'title.string'         => 'The title must be a valid text.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'description.required' => 'The description is required.',
            'description.string'   => 'The description must be valid text.',

            'image.image'          => 'The uploaded file must be an image.',
            'image.mimes'          => 'The image must be jpeg, png, jpg, or gif.',
            'image.max'            => 'The image size may not be greater than 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $ceremonial->title = $request->title;
        $ceremonial->description = $request->description;

        if ($request->hasFile('image')) {
            // Remove old image
            // if($ceremonial->image && file_exists(public_path('images/admin/ceremonial/images/'.$ceremonial->image))){
            //     unlink(public_path('images/admin/ceremonial/images/'.$ceremonial->image));
            // }
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/admin/ceremonial/'), $imageName);
            $ceremonial->image = $imageName;
        }

        $ceremonial->save();

        return redirect()->route('admin.ceremonials.index')->with('success', 'Ceremonial updated successfully!');

    }

    public function destroy(Ceremonial $ceremonial)
    {
        $ceremonial->delete();

        return response()->json([
            'result' => true,
            'message' => "Data Deleted."
        ]);
    }
}
