<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Faq, FaqType};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index()
    {
        return view('admin.faq.index');
    }

    public function getFaqs()
    {
        $products = FaqType::select('id', 'name')->withCount([
            'faqs as total_faqs'
        ])->whereHas('faqs');

        return DataTables::of($products)
            ->addColumn('total_faqs', function ($row) {
                return $row->total_faqs;
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.faqs.edit', $row->id);
                $deleteId = $row->id;

                return '
                    <a href="'.$editUrl.'" class="btn btn-sm btn-primary me-1">
                        <i class="icofont-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger delete_faqs" data-id="'.$deleteId.'">
                        <i class="icofont-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['total_faqs', 'action'])
            ->make(true);
    }

    public function create()
    {
        $data['types'] = FaqType::where('is_active', 0)->whereNull('deleted_at')->get();
        return view('admin.faq.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'     => 'required|exists:faq_types,id',
            'question'    => 'required|array|min:1',
            'question.*'  => 'required|string|max:255',
            'answer'      => 'required|array|min:1',
            'answer.*'    => 'required|string',
        ], [
            // Type
            'type.required' => 'Please select a Type.',
            'type.exists'   => 'The selected type does not exist.',
            // Questions
            'question.required'   => 'At least one FAQ question is required.',
            'question.array'      => 'FAQ questions must be in valid format.',
            'question.*.required' => 'FAQ question field cannot be empty.',
            'question.*.string'   => 'FAQ question must be a valid text.',
            'question.*.max'      => 'FAQ question may not exceed 255 characters.',
            // Answers
            'answer.required'     => 'At least one FAQ answer is required.',
            'answer.array'        => 'FAQ answers must be in valid format.',
            'answer.*.required'   => 'FAQ answer field cannot be empty.',
            'answer.*.string'     => 'FAQ answer must be valid text.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors.');
        }

        foreach ($request->question as $index => $question) {
            Faq::create([
                'faq_type_id' => $request->type,
                'question'   => $question,
                'answer'     => $request->answer[$index],
                'is_active' => 0,
            ]);
        }

        return redirect()->route('admin.faqs.index')->with('success', 'FAQs added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editFaqs(string $typeId)
    {
        $data['types'] = FaqType::where('is_active', 0)->whereNull('deleted_at')->get();
        $type = FaqType::findOrFail($typeId);
        $faqs = Faq::where('faq_type_id', $typeId)->get();

        return view('admin.faq.edit', compact('type', 'faqs', 'data'));
    }

    public function updateFaqs(Request $request, string $productId)
    {
        $validator = Validator::make($request->all(), [
            'faq_id'        => 'nullable|array',
            'faq_id.*'      => [
                'nullable',
                'integer',
                Rule::exists('faqs', 'id')->where(function ($q) use ($productId) {
                    $q->where('faq_type_id', $productId);
                }),
            ],
            'question'      => 'required|array|min:1',
            'question.*'    => 'required|string|max:255',
            'answer'        => 'required|array|min:1',
            'answer.*'      => 'required|string',
        ], [
            'faq_id.array'        => 'Invalid FAQ data submitted.',
            'faq_id.*.exists'     => 'One or more FAQs do not belong to this product.',
            'question.required'   => 'At least one FAQ question is required.',
            'question.array'      => 'FAQ questions must be in valid format.',
            'question.*.required' => 'FAQ question field cannot be empty.',
            'question.*.string'   => 'FAQ question must be valid text.',
            'question.*.max'      => 'FAQ question may not exceed 255 characters.',

            'answer.required'     => 'At least one FAQ answer is required.',
            'answer.array'        => 'FAQ answers must be in valid format.',
            'answer.*.required'   => 'FAQ answer field cannot be empty.',
            'answer.*.string'     => 'FAQ answer must be valid text.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // PREVENT DELETING LAST FAQ
        $existingFaqIds = Faq::where('faq_type_id', $productId)
            ->pluck('id')
            ->toArray();

        $submittedFaqIds = array_filter($request->faq_id ?? []);

        // FAQs that user is trying to delete
        $deleteIds = array_diff($existingFaqIds, $submittedFaqIds);

        if (count($existingFaqIds) === 1 && count($deleteIds) === 1) {
            return redirect()->back()
                ->with('error', 'At least one FAQ is required for a Type.')
                ->withInput();
        }

        DB::transaction(function () use ($request, $productId, $deleteIds) {

            // Delete removed FAQs (only if allowed)
            if (!empty($deleteIds)) {
                Faq::whereIn('id', $deleteIds)->delete();
            }

            // Update / Create FAQs
            foreach ($request->question as $index => $question) {
                if (!empty($request->faq_id[$index])) {
                    // Update existing FAQ
                    Faq::where('id', $request->faq_id[$index])->update([
                        'is_active' => 0,
                        'faq_type_id' => $request->type_select,
                        'question' => $question,
                        'answer'   => $request->answer[$index],
                    ]);
                } else {
                    // Create new FAQ
                    Faq::create([
                        'is_active' => 0,
                        'faq_type_id' => $request->type_select,
                        'question'    => $question,
                        'answer'      => $request->answer[$index],
                    ]);
                }
            }
        });

        return redirect()->route('admin.faqs.index')->with('success', 'FAQs updated successfully');
    }

    public function destroyByType($productId)
    {
        $count = Faq::where('faq_type_id', $productId)->count();

        // if ($count <= 1) {
        //     return response()->json([
        //         'result' => false,
        //         'message' => 'At least one FAQ is required for a Type.'
        //     ]);
        // }

        Faq::where('faq_type_id', $productId)->delete();

        return response()->json([
            'result' => true,
            'message' => 'FAQs deleted successfully.'
        ]);
    }
}
