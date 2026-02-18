<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Blessing};
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Storage;

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
            // ->editColumn('blessing_of', function ($result) use($blessingOf) {
            //     if(isset($result->blessing_of)){
            //         return $blessingOf[$result->blessing_of];
            //     }else{
            //        return '-';
            //     }  
            // })    
            ->editColumn('blessing_of', function ($result) use ($blessingOf) {
                if (!empty($result->blessing_of)) {
                    $values = explode(',', $result->blessing_of);
                    $formatted = collect($values)->map(function ($value) use ($blessingOf) {
                        return isset($blessingOf[$value])
                            ? ucwords($blessingOf[$value])
                            : ucfirst(str_replace('_', ' ', $value));
                    })->implode(', ');
                    return $formatted;
                }
                return '-';
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
            // 'blessing_of' => 'required|in:'.implode(',', array_keys(config('global_values.blessing_of'))),
            'blessing_of' => 'required|array',
            'blessing_of.*' => 'in:' . implode(',', array_keys(config('global_values.blessing_of'))),
            'title'       => 'required|string|max:255',
            'sub_title'   => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'audio_file'  => 'required|mimes:mp3,wav|max:10240', // max 10MB
            'audio_content' => 'required|max:700',
        ], [
            // 'blessing_of.required' => 'Please select a blessing type.',
            // 'blessing_of.in'       => 'Please select a valid blessing type.',
            'blessing_of.required' => 'Please select at least one blessing type.',
            'blessing_of.array' => 'Invalid blessing selection format.',
            'blessing_of.*.in' => 'Please select a valid blessing type.',

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

            // 'audio_file.required'  => 'An audio file is required.',
            // 'audio_file.mimes'     => 'The audio file must be mp3 or wav.',
            // 'audio_file.max'       => 'The audio file size may not be greater than 10MB.',
            'audio_content.required' => 'The Audio Content is required.',
            'audio_content.max'      => 'The Audio content may not be greater than 700 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $content = $request->audio_content ?? null;
        $blessing = new Blessing();
        $blessing->blessing_of = $request->blessing_of ? implode(',', $request->blessing_of) : null;
        $blessing->title = $request->title;
        $blessing->sub_title = $request->sub_title;
        $blessing->description = $request->description;
        $blessing->is_active = 0;
        $blessing->audio_content = $content;
        $blessing->save();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/admin/blessing/images/'), $imageName);
            $blessing->image = $imageName;
        }

        // OLD CODE
        // if ($request->hasFile('audio_file')) {
        //     $audio = $request->file('audio_file');
        //     $audioName = $audio->getClientOriginalName();
        //     $audio->move(public_path('images/admin/blessing/audios/'), $audioName);
        //     $blessing->audio_file = $audioName;
        // }

        // NEW CODE (Converted Text to Audio file)
        if(isset($content) && $content != null){
            $folderPath = public_path('images/admin/blessing/audios/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }
            // Split text into chunks (max 180 characters)
            $chunks = str_split($content, 180);
            $audioName = 'audio_'.$blessing->id.'_'.time().'.mp3';
            $fullPath = $folderPath.$audioName;
            $finalAudio = '';
            foreach($chunks as $chunk){
                $text = urlencode($chunk);
                $url = "https://translate.googleapis.com/translate_tts?ie=UTF-8&q={$text}&tl=en&client=gtx";
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0'
                ])->get($url);
                if($response->successful()){
                    $finalAudio .= $response->body();
                }
            }
            if($finalAudio != ''){
                file_put_contents($fullPath, $finalAudio);
                $blessing->audio_file = $audioName;
                $blessing->save();
            }
        }

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
            //'blessing_of' => 'required|in:'.implode(',', array_keys(config('global_values.blessing_of'))),
            'blessing_of' => 'required|array',
            'blessing_of.*' => 'in:' . implode(',', array_keys(config('global_values.blessing_of'))),
            'title'       => 'required|string|max:255',
            'sub_title'   => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            //'audio_file'  => 'nullable|mimes:mp3,wav|max:10240',
            'audio_content' => 'required|max:700',
        ], [
            // 'blessing_of.required' => 'Please select a blessing type.',
            // 'blessing_of.in'       => 'Please select a valid blessing type.',
            'blessing_of.required' => 'Please select at least one blessing type.',
            'blessing_of.array' => 'Invalid blessing selection format.',
            'blessing_of.*.in' => 'Please select a valid blessing type.',

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

            // 'audio_file.mimes'     => 'The audio file must be mp3 or wav.',
            // 'audio_file.max'       => 'The audio file size may not be greater than 10MB.',
            'audio_content.required' => 'The Audio Content is required.',
            'audio_content.max'      => 'The Audio content may not be greater than 700 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $content = $request->audio_content ?? null;
        $blessing->blessing_of = $request->blessing_of ? implode(',', $request->blessing_of) : null;
        $blessing->title = $request->title;
        $blessing->sub_title = $request->sub_title;
        $blessing->description = $request->description;
        $blessing->audio_content = $content;
        $blessing->save();
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

        // OLD CODE
        // if ($request->hasFile('audio_file')) {
        //     // Remove old audio
        //     // if($blessing->audio_file && file_exists(public_path('audio/blessings/'.$blessing->audio_file))){
        //     //     unlink(public_path('audio/blessings/'.$blessing->audio_file));
        //     // }
        //     $audio = $request->file('audio_file');
        //     $audioName = $audio->getClientOriginalName();
        //     $audio->move(public_path('images/admin/blessing/audios/'), $audioName);
        //     $blessing->audio_file = $audioName;
        // }

        // NEW CODE (Converted Text to Audio file)
        if(isset($content) && $content != null){
            $folderPath = public_path('images/admin/blessing/audios/');
            // Create folder if it doesn't exist
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }
            // Remove old audio file if exists
            if($blessing->audio_file && file_exists($folderPath.$blessing->audio_file)){
                unlink($folderPath.$blessing->audio_file);
            }
            // Split content into safe chunks (<200 characters per request)
            $chunks = explode("\n", wordwrap($content, 180));
            $audioName = 'audio_'.$blessing->id.'_'.time().'.mp3';
            $fullPath = $folderPath.$audioName;
            $finalAudio = '';
            foreach($chunks as $chunk){
                $text = urlencode($chunk);
                // Use reliable Google API endpoint
                $url = "https://translate.googleapis.com/translate_tts?ie=UTF-8&q={$text}&tl=en&client=gtx";
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                ])->get($url);
                if($response->successful()){
                    $finalAudio .= $response->body();
                } else {
                    \Log::error('TTS request failed', [
                        'status' => $response->status(),
                        'text' => $chunk
                    ]);
                }
            }
            if($finalAudio != ''){
                // Save new audio
                file_put_contents($fullPath, $finalAudio);
                // Update database
                $blessing->audio_file = $audioName;
                $blessing->save();
            }   
        }

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
