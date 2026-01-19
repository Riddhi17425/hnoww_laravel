<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ProductImage, Product};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductImageController extends Controller
{
    public function index()
    {
        return view('admin.product-image.index');
    }

    public function getProductImages()
    {
        $products = Product::select('id', 'product_name')->withCount([
            'images as total_images'
        ])->whereHas('images');

        return DataTables::of($products)
            ->addColumn('total_images', function ($row) {
                return $row->total_images;
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.product-images.edit', $row->id);
                $deleteId = $row->id;

                return '
                    <a href="'.$editUrl.'" class="btn btn-sm btn-primary me-1">
                        <i class="icofont-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger delete-product-imgs" data-id="'.$deleteId.'">
                        <i class="icofont-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['total_images', 'action'])
            ->make(true);
    }

    public function create()
    {
        $data['products'] = Product::notDeleted()->isActive()->get();
        return view('admin.product-image.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required|exists:products,id',
            'image.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'product.required' => 'Please select a product.',
            'product.exists'   => 'The selected product does not exist.',
            'image.*.required' => 'Please upload at least one product image.',
            'image.*.image'    => 'Each file must be a valid image.',
            'image.*.mimes'    => 'Only JPG, JPEG, PNG, or WEBP image formats are allowed.',
            'image.*.max'      => 'Each image size must not exceed 5 MB.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors.');
        }

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $key => $img) {
                $fileName = uniqid('Product_Image_'.$request->product.'_'.$key.'_') . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('images/admin/product_images'), $fileName);
                ProductImage::create([
                    'product_id' => $request->product,
                    'image'      => $fileName,
                    'is_active'  => 0,
                ]);
            }
        }

        return redirect()->route('admin.product-images.index')->with('success', 'High quality product images uploaded successfully');
    }

    public function edit(Request $request, $id)
    {
        // Get all active products for dropdown
        $data['products'] = Product::notDeleted()->isActive()->get();

        // Get the product being edited
        $product = Product::findOrFail($id);

        // Get existing images for this product
        $productImages = $product->images; // assumes Product hasMany ProductImage

        // Pass data to edit view
        return view('admin.product-image.edit', compact('data', 'product', 'productImages'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required|exists:products,id',
            'image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'product.required' => 'Please select a product.',
            'product.exists' => 'The selected product does not exist.',
            'image.*.image' => 'Each file must be a valid image.',
            'image.*.mimes' => 'Only JPG, JPEG, PNG, or WEBP image formats are allowed.',
            'image.*.max' => 'Each image size must not exceed 5 MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($id);

        // Handle removed images
        $existing_ids = $request->existing_image_ids ?? [];
        $currentImages = $product->images; // relationship Product hasMany ProductImage
        foreach ($currentImages as $img) {
            if (!in_array($img->id, $existing_ids)) {
                $path = public_path('images/admin/product_images/'.$img->image);
                if(file_exists($path)) unlink($path);
                $img->delete();
            }
        }

        // Handle newly uploaded images
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $key => $img) {
                if($img) {
                    $fileName = uniqid('Product_Image_'.$product->id.'_'.$key.'_') . '.' . $img->getClientOriginalExtension();
                    $img->move(public_path('images/admin/product_images'), $fileName);
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileName,
                        'is_active' => 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.product-images.index')->with('success','Product images updated successfully.');
    }

    public function destroyByProduct($productId)
    {
        $count = ProductImage::where('product_id', $productId)->count();

        // if ($count <= 1) {
        //     return response()->json([
        //         'result' => false,
        //         'message' => 'At least one Image is required for a product.'
        //     ]);
        // }

        ProductImage::where('product_id', $productId)->delete();

        return response()->json([
            'result' => true,
            'message' => 'Product Image deleted successfully.'
        ]);
    }

}