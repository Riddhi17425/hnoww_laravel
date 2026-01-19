<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Blessing};
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BlessingController extends Controller
{
    public function index()
    {
        return view('admin.blessing.index');
    }

    public function getBlessings(Request $request){
        $query = Blessing::query();
        $blessingOf = config('global_values.blessing_of');
        if (isset($request->status) && $request->status != '') {
            $query = $query->where('is_active', (int)$request->status);
        }       
        return Datatables::of($query) 
            ->editColumn('blessing_of', function ($result) use($blessingOf) {
                if(isset($result->blessing_of)){
                    return $blessingOf[$result->blessing_of];
                }else{
                   return '-';
                }  
            })       
            ->editColumn('description', function ($result) {
                if(isset($result->description)){
                    return $result->description;
                }else{
                   return '-';
                }  
            })  
            ->editColumn('image', function ($result) {
                if(isset($result->image)){
                    return '<img src="' . url('public/images/admin/blessing/images/' . $result->image) . '" width="150">';
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
                $editUrl = route('admin.blessings.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-blessing" data-id="' . $row->id . '">
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
        return view('admin.blessing.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blessing_of' => 'required|in:'.implode(',', array_keys(config('global_values.blessing_of'))),
            'title'       => 'required|string|max:255',
            'sub_title'   => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'audio_file'  => 'required|mimes:mp3,wav|max:10240', // max 10MB
        ], [
            'blessing_of.required' => 'Please select a blessing type.',
            'blessing_of.in'       => 'Please select a valid blessing type.',

            'title.required'       => 'The title is required.',
            'title.string'         => 'The title must be a valid text.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'sub_title.required'   => 'The sub title is required.',
            'sub_title.string'     => 'The sub title must be a valid text.',
            'sub_title.max'        => 'The sub title may not be greater than 255 characters.',

            'description.required' => 'The description is required.',
            'description.string'   => 'The description must be valid text.',

            'image.required'       => 'An image is required.',
            'image.image'          => 'The uploaded file must be an image.',
            'image.mimes'          => 'The image must be jpeg, png, jpg, or gif.',
            'image.max'            => 'The image size may not be greater than 2MB.',

            'audio_file.required'  => 'An audio file is required.',
            'audio_file.mimes'     => 'The audio file must be mp3 or wav.',
            'audio_file.max'       => 'The audio file size may not be greater than 10MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blessing = new Blessing();
        $blessing->blessing_of = $request->blessing_of;
        $blessing->title = $request->title;
        $blessing->sub_title = $request->sub_title;
        $blessing->description = $request->description;
        $blessing->is_active = 0;
        $blessing->save();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/admin/blessing/images/'), $imageName);
            $blessing->image = $imageName;
        }

        if ($request->hasFile('audio_file')) {
            $audio = $request->file('audio_file');
            $audioName = $audio->getClientOriginalName();
            $audio->move(public_path('images/admin/blessing/audios/'), $audioName);
            $blessing->audio_file = $audioName;
        }

        $blessing->save();

        return redirect()->route('admin.blessings.index')->with('success', 'Blessing added successfully!');
    }

    public function updateStatus(Request $request){
        $blessing = Blessing::find($request->id);
        if (!$blessing) {
            return response()->json([
                'success' => false,
                'message' => 'Blessing not found'
            ]);
        }
        $blessing->is_active = $request->status;
        $blessing->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    public function edit(string $id)
    {
        $blessing = Blessing::find($id);
        return view('admin.blessing.edit', compact('blessing'));
    }

    public function update(Request $request, string $id)
    { 
        $blessing = Blessing::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'blessing_of' => 'required|in:'.implode(',', array_keys(config('global_values.blessing_of'))),
            'title'       => 'required|string|max:255',
            'sub_title'   => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'audio_file'  => 'nullable|mimes:mp3,wav|max:10240',
        ], [
            'blessing_of.required' => 'Please select a blessing type.',
            'blessing_of.in'       => 'Please select a valid blessing type.',

            'title.required'       => 'The title is required.',
            'title.string'         => 'The title must be a valid text.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'sub_title.required'   => 'The sub title is required.',
            'sub_title.string'     => 'The sub title must be a valid text.',
            'sub_title.max'        => 'The sub title may not be greater than 255 characters.',

            'description.required' => 'The description is required.',
            'description.string'   => 'The description must be valid text.',

            'image.image'          => 'The uploaded file must be an image.',
            'image.mimes'          => 'The image must be jpeg, png, jpg, or gif.',
            'image.max'            => 'The image size may not be greater than 2MB.',

            'audio_file.mimes'     => 'The audio file must be mp3 or wav.',
            'audio_file.max'       => 'The audio file size may not be greater than 10MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blessing->blessing_of = $request->blessing_of;
        $blessing->title = $request->title;
        $blessing->sub_title = $request->sub_title;
        $blessing->description = $request->description;

        if ($request->hasFile('image')) {
            // Remove old image
            // if($blessing->image && file_exists(public_path('images/admin/blessing/images/'.$blessing->image))){
            //     unlink(public_path('images/admin/blessing/images/'.$blessing->image));
            // }
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/admin/blessing/images/'), $imageName);
            $blessing->image = $imageName;
        }

        if ($request->hasFile('audio_file')) {
            // Remove old audio
            // if($blessing->audio_file && file_exists(public_path('audio/blessings/'.$blessing->audio_file))){
            //     unlink(public_path('audio/blessings/'.$blessing->audio_file));
            // }
            $audio = $request->file('audio_file');
            $audioName = $audio->getClientOriginalName();
            $audio->move(public_path('images/admin/blessing/audios/'), $audioName);
            $blessing->audio_file = $audioName;
        }

        $blessing->save();

        return redirect()->route('admin.blessings.index')->with('success', 'Blessing updated successfully!');

    }

    public function destroy(Blessing $blessing)
    {
        $blessing->delete();

        return response()->json([
            'result' => true,
            'message' => "Data Deleted."
        ]);
    }
}
