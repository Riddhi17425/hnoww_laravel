<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{GiftShop};
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GiftShopController extends Controller
{
    public function index()
    { 
        return view('admin.giftshop.index');
    }

    public function getGifts(Request $request){
        $giftFor = config('global_values.gift_for');
        $toCelebrate = config('global_values.to_celebrate');

        $query = GiftShop::whereNull('deleted_at');

        if (isset($request->status) && $request->status != '') {
            $query = $query->where('is_active', (int)$request->status);
        }      
        if (isset($request->gift_for) && $request->gift_for != '') {
            $query = $query->where('gift_for', (int)$request->gift_for);
        } 
        if (isset($request->to_celebrate) && $request->to_celebrate != '') {
            $query = $query->where('to_celebrate', (int)$request->to_celebrate);
        } 
        return Datatables::of($query)
            ->editColumn('gift_for', function ($result) use ($giftFor) {
                if(isset($result->gift_for) && $result->gift_for != ''){
                    return $giftFor[$result->gift_for];
                }else{
                   return '-';
                }  
            }) 
            ->editColumn('to_celebrate', function ($result) use ($toCelebrate) {
                if(isset($result->to_celebrate) && $result->to_celebrate != ''){
                    return $toCelebrate[$result->to_celebrate];
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
            ->editColumn('list_page_img', function ($result) {
                if(isset($result->list_page_img)){
                    return '<img src="' . url('public/images/admin/gifts/product_list/' . $result->list_page_img) . '" width="150">';
                }else{
                   return '<img src="' . url('public/images/no_img.png') . '" width="80">';
                }  
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
                $editUrl = route('admin.giftshops.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-gift" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })    
            ->rawColumns(['status', 'action', 'list_page_img', 'short_description'])
            ->make(true);
    }

    public function updateStatus(Request $request){
        $gift = GiftShop::find($request->id);

        if (!$gift) {
            return response()->json([
                'success' => false,
                'message' => 'Gift not found'
            ]);
        }

        $gift->is_active = $request->status;
        $gift->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    public function create()
    {
        return view('admin.giftshop.create');
    }

    public function store(Request $request)
    {
        $giftFor = array_keys(config('global_values.gift_for'));
        $toCelebrate = array_keys(config('global_values.to_celebrate'));
        $validator = Validator::make($request->all(), [
            'gift_for' => ['required', Rule::in($giftFor)],
            'to_celebrate' => ['required', Rule::in($toCelebrate)],
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|string|max:255',
            'product_url' => 'required|string|max:255|unique:products,product_url',
            'list_img' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'detail_imgs'       => 'required|array|min:1',
            'detail_imgs.*'     => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'short_description' => 'required|string|max:500',
            'large_description' => 'nullable|string|max:5000',
            'dimensions' => 'nullable|string|max:5000',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:1000',
        ], [
            'gift_for.in' => 'Invalid gift recipient selected.',
            'to_celebrate.in' => 'Invalid celebration type selected.',
            'gift_for.required' => 'Gift Receipient is required.',
            'to_celebrate.required' => 'Celebration Type is required.',
            'product_name.required' => 'Gift name is required.',
            'product_name.string' => 'Gift name must be a valid string.',
            'product_name.max' => 'Gift name cannot exceed 255 characters.',
            'product_price.required' => 'Gift price is required.',
            'product_price.string' => 'Gift price must be a valid string.',
            'product_price.max' => 'Gift price cannot exceed 255 characters.',
            'product_url.required' => 'Gift URL is required.',
            'product_url.string' => 'Gift URL must be a valid string.',
            'product_url.max' => 'Gift URL cannot exceed 255 characters.',
            'product_url.unique' => 'This product URL is already taken.',
            'list_img.required' => 'Please upload the list page image.',
            'list_img.image'    => 'The list page file must be a valid image.',
            'list_img.mimes'    => 'The list page image must be a JPG, JPEG, PNG, or WEBP file.',
            'list_img.max'      => 'The list page image size must not exceed 5 MB.',
            'detail_imgs.*.required' => 'Please upload at least one detail page image.',
            'detail_imgs.*.image'    => 'Each detail page file must be a valid image.',
            'detail_imgs.*.mimes'    => 'Detail page images must be JPG, JPEG, PNG, or WEBP files.',
            'short_description.required' => 'Gift short description is Required.',
            'short_description.string' => 'Gift short description must be a valid string.',
            'short_description.max' => 'Gift short description cannot exceed 500 characters.',
            'large_description.string' => 'Gift large description must be a valid string.',
            'large_description.max' => 'Gift large description cannot exceed 5000 characters.',
            'dimensions.string' => 'Gift Dimension must be a valid string.',
            'dimensions.max' => 'Gift Dimension cannot exceed 5000 characters.',
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
            'gift_for', 'to_celebrate', 'product_name', 'product_price', 'short_description', 'large_description',
            'meta_title', 'meta_description', 'product_url', 'dimensions'
        ]);

        // STORE LIST PAGE IMAGE (SINGLE)
        $listImageName = null;
        if ($request->hasFile('list_img')) {
            $file = $request->file('list_img');
            $originalName = $file->getClientOriginalName();
            $path = public_path('images/admin/gifts/product_list');

            $file->move($path, $originalName);
            $listImageName = $originalName;
        }

        // STORE DETAIL PAGE IMAGES (MULTIPLE)
        $detailImages = [];
        if ($request->hasFile('detail_imgs')) {
            foreach ($request->file('detail_imgs') as $key => $img) {
                $originalName = $img->getClientOriginalName();
                $path = public_path('images/admin/gifts/product_detail');
                $img->move($path, $originalName);
                $detailImages[] = $originalName;
            }
        }

        $data['list_page_img'] = $listImageName;
        $data['detail_page_imgs'] = json_encode($detailImages);
        $data['is_active'] = 0; // default active

        GiftShop::create($data);

        return redirect()->route('admin.giftshops.index')->with('success', 'Gift added successfully');

    }

    public function edit($id)
    {
        $gift = GiftShop::find($id);
        return view('admin.giftshop.edit', compact('gift'));
    }

    public function update(Request $request, $id)
    {
        $giftFor = array_keys(config('global_values.gift_for'));
        $toCelebrate = array_keys(config('global_values.to_celebrate'));
        $validator = Validator::make($request->all(), [
            'gift_for' => ['required', Rule::in($giftFor)],
            'to_celebrate' => ['required', Rule::in($toCelebrate)],
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|string|max:255',
            'product_url' => 'required|string|max:255|unique:products,product_url',
            'list_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'detail_imgs'       => 'nullable|array|min:1',
            'detail_imgs.*'     => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'short_description' => 'required|string|max:500',
            'large_description' => 'nullable|string|max:5000',
            'dimensions' => 'nullable|string|max:5000',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:1000',
        ], [
            'gift_for.in' => 'Invalid gift recipient selected.',
            'to_celebrate.in' => 'Invalid celebration type selected.',
            'gift_for.required' => 'Gift Receipient is required.',
            'to_celebrate.required' => 'Celebration Type is required.',
            'product_name.required' => 'Gift name is required.',
            'product_name.string' => 'Gift name must be a valid string.',
            'product_name.max' => 'Gift name cannot exceed 255 characters.',
            'product_price.required' => 'Gift price is required.',
            'product_price.string' => 'Gift price must be a valid string.',
            'product_price.max' => 'Gift price cannot exceed 255 characters.',
            'product_url.required' => 'Gift URL is required.',
            'product_url.string' => 'Gift URL must be a valid string.',
            'product_url.max' => 'Gift URL cannot exceed 255 characters.',
            'product_url.unique' => 'This product URL is already taken.',
            'list_img.image'    => 'The list page file must be a valid image.',
            'list_img.mimes'    => 'The list page image must be a JPG, JPEG, PNG, or WEBP file.',
            'list_img.max'      => 'The list page image size must not exceed 5 MB.',
            'detail_imgs.*.image'    => 'Each detail page file must be a valid image.',
            'detail_imgs.*.mimes'    => 'Detail page images must be JPG, JPEG, PNG, or WEBP files.',
            'short_description.required' => 'Gift short description is Required.',
            'short_description.string' => 'Gift short description must be a valid string.',
            'short_description.max' => 'Gift short description cannot exceed 500 characters.',
            'large_description.string' => 'Gift large description must be a valid string.',
            'large_description.max' => 'Gift large description cannot exceed 5000 characters.',
            'dimensions.string' => 'Gift Dimension must be a valid string.',
            'dimensions.max' => 'Gift Dimension cannot exceed 5000 characters.',
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

        $gift = GiftShop::findOrFail($id);
        $data = $request->only([
            'gift_for', 'to_celebrate', 'product_name', 'product_price', 'large_description',
            'meta_title', 'meta_description', 'product_url', 'dimensions'
        ]);
        
        $shortDescription = $request->short_description;
        $shortDescription = preg_replace('/^<p>(.*)<\/p>$/si', '$1', trim($shortDescription));
        $data['short_description'] = $shortDescription;

        if ($request->hasFile('list_page_img')) {
            // delete old file
            // if ($gift->list_page_img && file_exists(public_path('images/admin/gifts/product_list' . $gift->list_page_img))) {
            //     unlink(public_path('images/admin/gifts/product_list' . $gift->list_page_img));
            // }
            $listImg = $request->file('list_page_img');
            $listName = $listImg->getClientOriginalName();
            $listImg->move(public_path('images/admin/gifts/product_list'), $listName);
            $gift->update([
                'list_page_img' => $listName
            ]);
        }
        if ($request->hasFile('detail_page_imgs')) {
            $existingImages = $gift->detail_page_imgs
                ? json_decode($gift->detail_page_imgs, true)
                : [];
            foreach ($request->file('detail_page_imgs') as $img) {
                $name = $img->getClientOriginalName();
                $img->move(public_path('images/admin/gifts/product_detail'), $name);
                $existingImages[] = $name;
            }
            $gift->update([
                'detail_page_imgs' => json_encode($existingImages)
            ]);
        }
        $gift->update($data);

        return redirect()->route('admin.giftshops.index')->with('success', 'Gift updated successfully');
    }

    public function delete($id)
    {
        $gift = GiftShop::where('id', $id)->first();
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

    public function deleteGiftDetailImage(Request $request)
    {
        $gift = GiftShop::findOrFail($request->gift_id);
        $images = json_decode($gift->detail_page_imgs, true);
        if (isset($images[$request->index])) {
            $path = public_path('images/admin/gifts/product_detail/'.$images[$request->index]);
            if (file_exists($path)) unlink($path);
            unset($images[$request->index]);
            $gift->detail_page_imgs = json_encode(array_values($images));
            $gift->save();
        }

        return response()->json(['success' => true]);
    }

    public function deleteAllGiftDetailImages(Request $request)
    {
        $gift = GiftShop::findOrFail($request->gift_id);
        $images = json_decode($gift->detail_page_imgs, true);
        if ($images) {
            foreach ($images as $img) {
                $path = public_path('images/admin/gifts/product_detail/'.$img);
                if (file_exists($path)) unlink($path);
            }
        }
        $gift->detail_page_imgs = null;
        $gift->save();

        return response()->json(['success' => true]);
    }

}
