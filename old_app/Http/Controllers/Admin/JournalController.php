<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Journal};
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::orderBy('id', 'desc')->get();
        return view('admin.journal.index', compact('journals'));
    }

    public function getJournals(Request $request){
        $query = Journal::query();

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
            ->editColumn('thumbnail_img', function ($result) {
                if(isset($result->thumbnail_img)){
                    return '<img src="' . url('public/images/admin/journal/thumbnail_images/' . $result->thumbnail_img) . '" width="150">';
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
                $editUrl = route('admin.journals.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                ';
            })    
            //->escapeColumns([])  
            ->rawColumns(['status', 'action', 'thumbnail_img', 'description'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.journal.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month_name' => ['required', Rule::in(config('global_values.months')),'unique:journals,month_name'],
            'title'        => 'required|string|max:255',
            'feature_title'        => 'required|string|max:255',
            'feature_description'        => 'required|string|max:500',
            'description'  => 'required|string|max:2000',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'month_name.required'  => 'The month name is required.',
            'month_name.in'       => 'Please select a valid month.',
            'month_name.unique'   => 'This month already exists.',

            'title.required'       => 'The title is required.',
            'title.string'         => 'The title must be a valid text.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'feature_title.required'       => 'The feature title is required.',
            'feature_title.string'         => 'The feature title must be a valid text.',
            'feature_title.max'            => 'The feature title may not be greater than 255 characters.',
            'feature_description.required'       => 'The feature description is required.',
            'feature_description.string'         => 'The feature description must be a valid text.',
            'feature_description.max'            => 'The feature description may not be greater than 500 characters.',

            'description.required' => 'The description is required.',
            'description.string'   => 'The description must be a valid text.',
            'description.max'      => 'The description may not be greater than 2000 characters.',

            'image.required'       => 'An image is required.',
            'image.image'          => 'The uploaded file must be an image.',
            'image.mimes'          => 'The image must be a file of type: jpeg, png, jpg, or gif.',
            'image.max'            => 'The image size may not be greater than 2MB.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $journal = new Journal();
        $journal->month_name = $request->month_name;
        $journal->title = $request->title ?? null;
        $journal->feature_title = $request->feature_title ?? null;
        $journal->feature_description = $request->feature_description ?? null;
        $journal->description = $request->description;
        $journal->is_active = 0;
        $journal->save();

        if($request->hasFile('thumbnail_img')){
            // $file = $request->file('thumbnail_img');
            // $originalName = $journal->id.'_'.$file->getClientOriginalName();
            // $path = public_path('images/admin/journal/thumbnail_images/');
            // $file->move($path, $originalName);
            // $journal->thumbnail_img = $originalName;
            $file = $request->file('thumbnail_img');
            $originalName = $file->getClientOriginalName();
            $path = public_path('images/admin/journal/thumbnail_images/');
            $file->move($path, $originalName);
            $journal->thumbnail_img = $originalName;
        }
        if($request->hasFile('detail_img')){
            // $file = $request->file('detail_img');
            // $originalName = $journal->id.'_'.$file->getClientOriginalName();
            // $path = public_path('images/admin/journal/detail_images/');
            // $file->move($path, $originalName);
            // $journal->detail_img = $originalName;
            $file = $request->file('detail_img');
            $originalName = $file->getClientOriginalName();
            $path = public_path('images/admin/journal/detail_images/');
            $file->move($path, $originalName);
            $journal->detail_img = $originalName;
        }
        $journal->save();

        return redirect()->route('admin.journals.index')->with('success', 'Journal added successfully!');
    }

    public function edit(Journal $journal)
    {
        return view('admin.journal.edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
        $validator = Validator::make($request->all(), [
            'month_name' => ['required', Rule::in(config('global_values.months')), Rule::unique('journals', 'month_name')->ignore($journal->id)],
            'title'        => 'required|string|max:255',
            'feature_title'        => 'required|string|max:255',
            'feature_description'        => 'required|string|max:500',
            'description'  => 'required|string|max:2000',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'month_name.required'  => 'The month name is required.',
            'month_name.in'       => 'Please select a valid month.',
            'month_name.unique'   => 'This month already exists.',

            'title.required'       => 'The title is required.',
            'title.string'         => 'The title must be a valid text.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'feature_title.required'       => 'The feature title is required.',
            'feature_title.string'         => 'The feature title must be a valid text.',
            'feature_title.max'            => 'The feature title may not be greater than 255 characters.',
            'feature_description.required'       => 'The feature description is required.',
            'feature_description.string'         => 'The feature description must be a valid text.',
            'feature_description.max'            => 'The feature description may not be greater than 500 characters.',

            'description.required' => 'The description is required.',
            'description.string'   => 'The description must be a valid text.',
            'description.max'      => 'The description may not be greater than 2000 characters.',

            'image.image'          => 'The uploaded file must be an image.',
            'image.mimes'          => 'The image must be a file of type: jpeg, png, jpg, or gif.',
            'image.max'            => 'The image size may not be greater than 2MB.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $journal->month_name = $request->month_name;
        $journal->title = $request->title;
        $journal->feature_title = $request->feature_title ?? null;
        $journal->feature_description = $request->feature_description ?? null;
        $journal->description = $request->description;
        $journal->save();

        if($request->hasFile('thumbnail_img')){
            // $oldImagePath = public_path('images/admin/journal/thumbnail_images/' . $journal->thumbnail_img);
            // if (file_exists($oldImagePath)) {
            //     unlink($oldImagePath);
            // }
            $file = $request->file('thumbnail_img');
            $originalName = $file->getClientOriginalName();
            $path = public_path('images/admin/journal/thumbnail_images/');
            $file->move($path, $originalName);
            $journal->thumbnail_img = $originalName;
        }
        if($request->hasFile('detail_img')){
            // $oldImagePath = public_path('images/admin/journal/detail_images/' . $journal->detail_img);
            // if (file_exists($oldImagePath)) {
            //     unlink($oldImagePath);
            // }
            $file = $request->file('detail_img');
            $originalName = $file->getClientOriginalName();
            $path = public_path('images/admin/journal/detail_images/');
            $file->move($path, $originalName);
            $journal->detail_img = $originalName;
        }

        $journal->save();

        return redirect()->route('admin.journals.index')->with('success', 'Journal updated successfully!');
    }

    public function updateStatus(Request $request){
        $journal = Journal::find($request->id);

        if (!$journal) {
            return response()->json([
                'success' => false,
                'message' => 'Journal not found'
            ]);
        }
  
        $journal->is_active = $request->status;
        $journal->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    public function destroy(Journal $journal)
    {
        // if($journal->image && file_exists(public_path('uploads/journals/'.$journal->image))){
        //     unlink(public_path('uploads/journals/'.$journal->image));
        // }
        // $journal->delete();
        // return redirect()->route('admin.journal.index')->with('success', 'Journal deleted successfully!');
    }
}
