<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banner.index');
    }

    public function getBanners(Request $request)
    {
        $query = Banner::query();

        if (isset($request->status) && $request->status != '') {
            $query = $query->where('is_active', (int) $request->status);
        }

        return Datatables::of($query)
            ->editColumn('type', function ($result) {
                return ucfirst($result->type);
            })
            ->editColumn('description', function ($result) {
                return $result->description ?? '-';
            })
            ->editColumn('image', function ($result) {
                if ($result->type == 'image' && $result->image) {
                    return '<img src="' . url('public/images/admin/banner/images/' . $result->image) . '" width="150">';
                } elseif ($result->type == 'video' && $result->video) {
                    return '<video width="150" controls><source src="' . url('public/images/admin/banner/videos/' . $result->video) . '"></video>';
                }
                return '<img src="' . url('public/images/no_img.png') . '" width="80">';
            })
            ->addColumn('status', function ($result) {
                if ($result->is_active == 0) {
                    return '<div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" checked onclick="updateStatus(1,' . $result->id . ');">
                            <label class="form-check-label">Active</label>
                        </div>';
                } else {
                    return '<div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" onclick="updateStatus(0,' . $result->id . ');">
                            <label class="form-check-label">In-Active</label>
                        </div>';
                }
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.banners.edit', $row->id);
                return '
                <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                    <i class="icofont-edit"></i>
                </a>
                <button type="button" class="btn btn-outline-danger btn-sm delete-banner" data-id="' . $row->id . '">
                    <i class="icofont-ui-delete"></i>
                </button>
            ';
            })
            ->rawColumns(['status', 'action', 'image', 'description'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:image,video',
            'description' => 'required|string',
        ];

        if ($request->type == 'image') {
            $rules['image']        = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            $rules['mobile_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            $rules['alt_text']     = 'required|string|max:255';
        } else {
            $rules['video']        = 'required|mimes:mp4,mov,avi,webm|max:20480';
            $rules['mobile_video'] = 'nullable|mimes:mp4,mov,avi,webm|max:20480';
        }

        $validator = Validator::make($request->all(), $rules, [
            'title.required'       => 'The title is required.',
            'type.required'        => 'Please select a category.',
            'description.required' => 'The description is required.',
            'image.required'       => 'An image is required.',
            'video.required'       => 'A video is required.',
            'alt_text.required'    => 'Alt text is required for image banners.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $banner              = new Banner();
        $banner->title       = $request->title;
        $banner->type        = $request->type;
        $banner->description = $request->description;
        $banner->is_active   = $request->is_active ?? 0;

        if ($request->type == 'image') {
            $banner->alt_text = $request->alt_text;
        }

        $banner->save();

        if ($request->type == 'image') {
            if ($request->hasFile('image')) {
                $image     = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/admin/banner/images/'), $imageName);
                $banner->image = $imageName;
            }
            if ($request->hasFile('mobile_image')) {
                $mobileImage     = $request->file('mobile_image');
                $mobileImageName = time() . '_' . $mobileImage->getClientOriginalName();
                $mobileImage->move(public_path('images/admin/banner/images/'), $mobileImageName);
                $banner->mobile_image = $mobileImageName;
            }
        } else {
            if ($request->hasFile('video')) {
                $video     = $request->file('video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path('images/admin/banner/videos/'), $videoName);
                $banner->video = $videoName;
            }
            if ($request->hasFile('mobile_video')) {
                $mobileVideo     = $request->file('mobile_video');
                $mobileVideoName = time() . '_' . $mobileVideo->getClientOriginalName();
                $mobileVideo->move(public_path('images/admin/banner/videos/'), $mobileVideoName);
                $banner->mobile_video = $mobileVideoName;
            }
        }

        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner added successfully!');
    }

    public function updateStatus(Request $request)
    {
        $banner = Banner::find($request->id);
        if (! $banner) {
            return response()->json(['success' => false, 'message' => 'Banner not found']);
        }
        $banner->is_active = $request->status;
        $banner->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    public function edit(string $id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, string $id)
    {
        $banner = Banner::findOrFail($id);

        $rules = [
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:image,video',
            'description' => 'required|string',
        ];

        if ($request->type == 'image') {
            $rules['image']        = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            $rules['mobile_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            $rules['alt_text']     = 'required|string|max:255';
        } else {
            $rules['video']        = 'nullable|mimes:mp4,mov,avi,webm|max:20480';
            $rules['mobile_video'] = 'nullable|mimes:mp4,mov,avi,webm|max:20480';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $banner->title       = $request->title;
        $banner->type        = $request->type;
        $banner->description = $request->description;
        $banner->alt_text    = $request->type == 'image' ? $request->alt_text : null;
        $banner->is_active = $request->is_active ?? $banner->is_active;
        $banner->save();

        if ($request->type == 'image') {
            if ($request->hasFile('image')) {
                $image     = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/admin/banner/images/'), $imageName);
                $banner->image = $imageName;
            }
            if ($request->hasFile('mobile_image')) {
                $mobileImage     = $request->file('mobile_image');
                $mobileImageName = time() . '_' . $mobileImage->getClientOriginalName();
                $mobileImage->move(public_path('images/admin/banner/images/'), $mobileImageName);
                $banner->mobile_image = $mobileImageName;
            }
        } else {
            if ($request->hasFile('video')) {
                $video     = $request->file('video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path('images/admin/banner/videos/'), $videoName);
                $banner->video = $videoName;
            }
            if ($request->hasFile('mobile_video')) {
                $mobileVideo     = $request->file('mobile_video');
                $mobileVideoName = time() . '_' . $mobileVideo->getClientOriginalName();
                $mobileVideo->move(public_path('images/admin/banner/videos/'), $mobileVideoName);
                $banner->mobile_video = $mobileVideoName;
            }
        }

        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully!');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        return response()->json([
            'result'  => true,
            'message' => "Data Deleted.",
        ]);
    }
}