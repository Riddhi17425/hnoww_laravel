<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ProductTab, Product};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductTabController extends Controller
{
    public function index()
    {
        return view('admin.product-tab.index');
    }

    public function getProductTabs()
    {
        $products = Product::select('id', 'product_name')->withCount([
            'tabs as total_tabs'
        ])->whereHas('tabs');

        return DataTables::of($products)
            ->addColumn('total_tabs', function ($row) {
                return $row->total_tabs;
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.product-tabs.edit', $row->id);
                $deleteId = $row->id;

                return '
                    <a href="'.$editUrl.'" class="btn btn-sm btn-primary me-1">
                        <i class="icofont-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger delete-product-tabs" data-id="'.$deleteId.'">
                        <i class="icofont-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['total_tabs', 'action'])
            ->make(true);
    }

    public function create()
    {
        $data['products'] = Product::notDeleted()->isActive()->get();
        return view('admin.product-tab.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product'     => 'required|exists:products,id',
            'title'      => 'required|array|min:1',
            'title.*'    => 'required|string|max:1000',
            'details'      => 'required|array|min:1',
            'details.*'    => 'required|string',
        ], [
            // Product
            'product.required' => 'Please select a product.',
            'product.exists'   => 'The selected product does not exist.',
            // Tabs
            'title.required'     => 'At least one TAB title is required.',
            'title.array'        => 'TAB title must be in valid format.',
            'title.*.required'   => 'TAB title field cannot be empty.',
            'title.*.string'     => 'TAB title must be valid text.',
            'title.*.max'      => 'Tab title may not exceed 1000 characters.',
            'details.required'     => 'At least one TAB details is required.',
            'details.array'        => 'TAB details must be in valid format.',
            'details.*.required'   => 'TAB details field cannot be empty.',
            'details.*.string'     => 'TAB details must be valid text.',
            'details.*.max'      => 'Tab Details may not exceed 1000 characters.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors.');
        }

        if(isset($request->title) && is_countable($request->title) && count($request->title) > 0){
            foreach ($request->title as $index => $value) {
                ProductTab::create([
                    'product_id' => $request->product,
                    'title'   => $value,
                    'details'     => $request->details  [$index],
                    'is_active' => 0,
                ]);
            }
        }
            
        return redirect()->route('admin.product-tabs.index')->with('success', 'Product TABs added successfully');
    }

    public function edit(string $productId)
    {
        $product = Product::findOrFail($productId);
        $tabs = ProductTab::where('product_id', $productId)->get();

        return view('admin.product-tab.edit', compact('product', 'tabs'));
    }

    public function update(Request $request, string $productId)
    {
        $validator = Validator::make($request->all(), [
            'tab_id'        => 'nullable|array',
            'tab_id.*'      => [
                'nullable',
                'integer',
                Rule::exists('product_tabs', 'id')->where(function ($q) use ($productId) {
                    $q->where('product_id', $productId);
                }),
            ],
            'title'      => 'nullable|array|min:1',
            'title.*'    => 'nullable|string|max:255',
            'details'        => 'nullable|array|min:1',
            'details.*'      => 'nullable|string',
        ], [
            // TAB IDs
            'tab_id.array'        => 'Invalid TAB data submitted.',
            'tab_id.*.exists'     => 'One or more TABs do not belong to this product.',

            // titles
            //'title.required'   => 'At least one TAB title is required.',
            //'title.array'      => 'TAB titles must be in valid format.',
            //'title.*.required' => 'TAB title field cannot be empty.',
            'title.*.string'   => 'TAB title must be valid text.',
            'title.*.max'      => 'TAB title may not exceed 255 characters.',

            // details
            //'details.required'     => 'At least one TAB details is required.',
            //'details.array'        => 'TAB details must be in valid format.',
            //'details.*.required'   => 'TAB details field cannot be empty.',
            'details.*.string'     => 'TAB details must be valid text.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // PREVENT DELETING LAST FAQ
        $existingTabIds = ProductTab::where('product_id', $productId)
            ->pluck('id')
            ->toArray();
        $submittedTabIds = array_filter($request->tab_id ?? []);
        // TABs that user is trying to delete
        $deleteIds = array_diff($existingTabIds, $submittedTabIds);
        if (count($existingTabIds) === 1 && count($deleteIds) === 1) {
            //return redirect()->back()->with('error', 'At least one FAQ is required for a product.')->withInput();
        }

        DB::transaction(function () use ($request, $productId, $deleteIds) {

            // Delete removed TABs (only if allowed)
            if (!empty($deleteIds)) {
                ProductTab::whereIn('id', $deleteIds)->delete();
            }
            // Update / Create TABs
            foreach ($request->title as $index => $value) {
                if (!empty($request->tab_id[$index])) {
                    // Update existing TAB
                    ProductTab::where('id', $request->tab_id[$index])->update([
                        'title' => $value,
                        'details'   => $request->details[$index],
                    ]);
                } else {
                    // Create new TAB
                    ProductTab::create([
                        'product_id' => $productId,
                        'title'          => $value,
                        'details'        => $request->details[$index],
                    ]);
                }
            }
        });

        return redirect()->route('admin.product-tabs.index')->with('success', 'Product TABs updated successfully');
    }

    public function destroyByProduct($productId)
    {
        $count = ProductTab::where('product_id', $productId)->count();

        // if ($count <= 1) {
        //     return response()->json([
        //         'result' => false,
        //         'message' => 'At least one TAB is required for a product.'
        //     ]);
        // }

        ProductTab::where('product_id', $productId)->delete();

        return response()->json([
            'result' => true,
            'message' => 'Product TABs deleted successfully.'
        ]);
    }
}
