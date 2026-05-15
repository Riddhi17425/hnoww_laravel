<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use Str;
use DataTables; 

class BlogController extends Controller
{
    public function index(){
        return view('admin.blog.index');
    }

    public function fetchBlogs(Request $request)
    {
        $blogs = Blog::whereNull('deleted_at')->get();
         
        return DataTables::of($blogs)
            ->addIndexColumn()
            ->addColumn('status', function ($result) {  
                if ($result->status == 'Active') {
                    return '<div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked onclick="updateStatus(\'Active\',' . $result->id . ');">
                                <label class="form-check-label">Active</label>
                            </div>';
                    }
                    else
                    {
                        return '<div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" onclick="updateStatus(\'In-Active\',' . $result->id . ');">
                                <label class="form-check-label">In-Active</label>
                            </div>';;
                    }              
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.blogs.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete_blogs" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create(){
        return view('admin.blog.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title'               => 'required|string',
            'short_description'   => 'required|string',
            'detail_description'  => 'required|string',
            'conclusion'          => 'nullable|string',
            'date'                => 'required|date',
            'url'                 => 'required|string',
            'front_image'         => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_image'        => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_image'           => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'status'              => 'required|in:Active,In-Active',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $frontImagePath = null;
            $detailImagePath = null;

            $uploadPath = public_path('admin/blogs/');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Step 2: Handle front_image upload
            if ($request->hasFile('front_image')) {
                $frontImage = $request->file('front_image');
                $frontName = \Str::slug(pathinfo($frontImage->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $frontImage->getClientOriginalExtension();
                $frontSavePath = $uploadPath . $frontName;
                $frontImage->move($uploadPath, $frontName);
                $frontImagePath = 'public/admin/blogs/' . $frontName;
            }

            // Step 3: Handle detail_image upload
            if ($request->hasFile('detail_image')) {
                $detailImage = $request->file('detail_image');
                $detailName = \Str::slug(pathinfo($detailImage->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $detailImage->getClientOriginalExtension();
                $detailSavePath = $uploadPath . $detailName;
                $detailImage->move($uploadPath, $detailName);
                $detailImagePath = 'public/admin/blogs/' . $detailName;
            }

            $ctaImagePath = '';
            // Step X: Handle cta_image upload
            if ($request->hasFile('cta_image')) {
                $ctaImage = $request->file('cta_image');
                $ctaName = \Str::slug(pathinfo($ctaImage->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $ctaImage->getClientOriginalExtension();
                $ctaSavePath = $uploadPath . $ctaName;
                $ctaImage->move($uploadPath, $ctaName);
                $ctaImagePath = 'public/admin/blogs/' . $ctaName;
            }

            $ogImagePath = '';
            // Step X: Handle og_image upload
            if ($request->hasFile('og_image')) {
                $ogImage = $request->file('og_image');
                $ogName = \Str::slug(pathinfo($ogImage->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $ogImage->getClientOriginalExtension();
                $ogSavePath = $uploadPath . $ogName;
                $ogImage->move($uploadPath, $ogName);
                $ogImagePath = 'public/admin/blogs/' . $ogName;
            }
        
            $faqTitles = $request->faq_title ?? [];
            $faqDescriptions = $request->faq_description ?? [];
            $title_description = [];
            foreach ($faqTitles as $index => $title) {
                if (empty(trim(strip_tags($title))) || empty(trim(strip_tags($faqDescriptions[$index] ?? '')))) {
                    continue;
                }
                $title_description[] = [
                    'faq_title' => $title,
                    'faq_description' => $faqDescriptions[$index],
                ];
            }

            // Step 4: Store in DB
            Blog::create([
                'title'              => $request->title,
                'short_description'  => $request->short_description,
                'conclusion'         => $request->conclusion,
                'detail_description' => $request->detail_description,
                'date'               => date('Y-m-d', strtotime($request->input('date'))),
                'url'                => $request->url,
                'status'             => $request->status ?? null,
                'front_image'        => $frontImagePath,
                'detail_image'       => $detailImagePath,
                'cta_content'        => $request->cta_content ?? null,
                'cta_image'          => $ctaImagePath,
                'og_image'           => $ogImagePath,
                'meta_title'         => $request->get('meta_title'),
                'meta_description'         => $request->get('meta_description'),
                'blog_schema'         => $request->get('blogs_schema'),
                'blog_faq'         => json_encode($title_description),
                'front_image_alt' => $request->front_image_alt ?? null,
                'detail_image_alt' => $request->banner_image_alt ?? null,
                'cta_image_alt' => $request->cta_image_alt ?? null,
                'og_image_alt' => $request->og_image_alt ?? null,

            ]); 
            return redirect()->route('admin.blogs.index')->with('success', 'Blogs created successfully!');
        } catch (\Exception $e) {
            \Log::error('BlogsStore error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create blogs: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request){
        $blog = Blog::find($request->id);
        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found'
            ]);
        }
        $status = $request->status == 'Active' ? 'In-Active' : 'Active';
        $blog->status = $status;
        $blog->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    public function edit($id){
        $blog = Blog::find($id);
        return view('admin.blog.edit',compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'title'               => 'required|string',
            'short_description'   => 'required|string',
            'detail_description'  => 'required|string',
            'conclusion'          => 'nullable|string',
            'date'                => 'required|date',
            'url'                 => 'required|string',
            'front_image'         => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_image'        => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_image'           => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'og_image'            => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'status'              => 'required|in:Active,In-Active',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $blogs = Blog::findOrFail($id);
            $frontImagePath  = $blogs->front_image;
            $detailImagePath = $blogs->detail_image;
            $ctaImagePath    = $blogs->cta_image;
            $ogImagePath     = $blogs->og_image;
            $uploadPath = public_path('admin/blogs/');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($request->hasFile('front_image')) {
                if (
                    $frontImagePath &&
                    file_exists(public_path(str_replace('public/', '', $frontImagePath)))
                ) {
                    unlink(public_path(str_replace('public/', '', $frontImagePath)));
                }
                $frontImage = $request->file('front_image');
                $frontName =
                    \Str::slug(
                        pathinfo($frontImage->getClientOriginalName(), PATHINFO_FILENAME)
                    )
                    . '-' . uniqid()
                    . '.'
                    . $frontImage->getClientOriginalExtension();

                $frontImage->move($uploadPath, $frontName);
                $frontImagePath = 'public/admin/blogs/' . $frontName;
            }

            if ($request->hasFile('detail_image')) {
                if (
                    $detailImagePath &&
                    file_exists(public_path(str_replace('public/', '', $detailImagePath)))
                ) {
                    unlink(public_path(str_replace('public/', '', $detailImagePath)));
                }
                $detailImage = $request->file('detail_image');
                $detailName =
                    \Str::slug(
                        pathinfo($detailImage->getClientOriginalName(), PATHINFO_FILENAME)
                    )
                    . '-' . uniqid()
                    . '.'
                    . $detailImage->getClientOriginalExtension();

                $detailImage->move($uploadPath, $detailName);
                $detailImagePath = 'public/admin/blogs/' . $detailName;
            }

            if ($request->hasFile('cta_image')) {
                if (
                    $ctaImagePath &&
                    file_exists(public_path(str_replace('public/', '', $ctaImagePath)))
                ) {
                    unlink(public_path(str_replace('public/', '', $ctaImagePath)));
                }
                $ctaImage = $request->file('cta_image');
                $ctaName =
                    \Str::slug(
                        pathinfo($ctaImage->getClientOriginalName(), PATHINFO_FILENAME)
                    )
                    . '-' . uniqid()
                    . '.'
                    . $ctaImage->getClientOriginalExtension();
                $ctaImage->move($uploadPath, $ctaName);
                $ctaImagePath = 'public/admin/blogs/' . $ctaName;
            }

            if ($request->hasFile('og_image')) {
                if (
                    $ogImagePath &&
                    file_exists(public_path(str_replace('public/', '', $ogImagePath)))
                ) {
                    unlink(public_path(str_replace('public/', '', $ogImagePath)));
                }
                $ogImage = $request->file('og_image');
                $ogName =
                    \Str::slug(
                        pathinfo($ogImage->getClientOriginalName(), PATHINFO_FILENAME)
                    )
                    . '-' . uniqid()
                    . '.'
                    . $ogImage->getClientOriginalExtension();

                $ogImage->move($uploadPath, $ogName);
                $ogImagePath = 'public/admin/blogs/' . $ogName;
            }

            $faqTitles = $request->faq_title ?? [];
            $faqDescriptions = $request->faq_description ?? [];
            $title_description = [];
            foreach ($faqTitles as $index => $title) {
                if (
                    empty(trim(strip_tags($title))) ||
                    empty(trim(strip_tags($faqDescriptions[$index] ?? '')))
                ) {
                    continue;
                }

                $title_description[] = [
                    'faq_title'       => $title,
                    'faq_description' => $faqDescriptions[$index],
                ];
            }

            $blogs->update([
                'title'               => $request->title,
                'short_description'   => $request->short_description,
                'detail_description'  => $request->detail_description,
                'conclusion'          => $request->conclusion,
                'date'                => date('Y-m-d', strtotime($request->date)),
                'url'                 => $request->url,
                'status'              => $request->status ?? null,
                'front_image'         => $frontImagePath,
                'detail_image'        => $detailImagePath,
                'cta_image'           => $ctaImagePath,
                'og_image'            => $ogImagePath,
                'cta_content'         => $request->cta_content ?? null,
                'meta_title'          => $request->meta_title,
                'meta_description'    => $request->meta_description,
                'blog_schema'         => $request->blogs_schema,
                'blog_faq'            => json_encode($title_description),
                'front_image_alt'     => $request->front_image_alt ?? null,
                'detail_image_alt'    => $request->banner_image_alt ?? null,
                'cta_image_alt'       => $request->cta_image_alt ?? null,
                'og_image_alt'        => $request->og_image_alt ?? null,
            ]);

            return redirect()
                ->route('admin.blogs.index')
                ->with('success', 'Blogs updated successfully!');

        } catch (\Exception $e) {

            \Log::error('Blog Update Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to update blog: ' . $e->getMessage());
        }
    }

    public function delete($id){
        $blogs = Blog::find($id);
        if(empty($blogs)){
            return response()->json([
                'result' => false,
                "message" => "Blog Not Found."
            ]);
        }
        $blogs->delete();
        return response()->json([
            'result' => true,
            'message' => "Data Deleted."
        ]);
    }
}
