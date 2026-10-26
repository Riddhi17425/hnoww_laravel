<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;

class ReviewController extends Controller
{
    private $photoDir = 'images/admin/reviews/';

    public function index()
    {
        return view('admin.review.index');
    }

    public function getReviews(Request $request)
    {
        $query = Review::query();

        if (isset($request->status) && $request->status != '') {
            $query = $query->where('is_active', (int) $request->status);
        }

        return Datatables::of($query)
            ->editColumn('photo', function ($result) {
                if ($result->photo) {
                    return '<img src="' . asset('public/' . $this->photoDir . $result->photo) . '" width="60" height="60" style="object-fit:cover;border-radius:50%;">';
                }
                return '-';
            })
            ->editColumn('rating', function ($result) {
                return str_repeat('★', (int) $result->rating) . str_repeat('☆', 5 - (int) $result->rating);
            })
            ->editColumn('description', function ($result) {
                return e(Str::limit($result->description, 120));
            })
            ->editColumn('name', function ($result) {
                return e($result->name);
            })
            ->editColumn('city', function ($result) {
                return e($result->city);
            })
            ->addColumn('status', function ($result) {
                if ($result->is_active == 1) {
                    return '<div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked onclick="updateStatus(0,' . $result->id . ');">
                                <label class="form-check-label">Active</label>
                            </div>';
                }
                return '<div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" onclick="updateStatus(1,' . $result->id . ');">
                            <label class="form-check-label">In-Active</label>
                        </div>';
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.reviews.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-edit"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-review" data-id="' . $row->id . '">
                        <i class="icofont-ui-delete"></i>
                    </button>
                ';
            })
            ->rawColumns(['photo', 'description', 'name', 'city', 'status', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.review.create');
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $review = new Review();
        $review->name = $request->name;
        $review->city = $request->city;
        $review->description = $request->description;
        $review->rating = (int) $request->rating;
        $review->is_active = 1;
        if ($request->hasFile('photo')) {
            $review->photo = $this->uploadPhoto($request->file('photo'));
        }
        $review->save();

        return redirect()->route('admin.reviews.index')->with('success', 'Review added successfully!');
    }

    public function edit(Review $review)
    {
        return view('admin.review.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $validator = $this->validator($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $review->name = $request->name;
        $review->city = $request->city;
        $review->description = $request->description;
        $review->rating = (int) $request->rating;
        if ($request->hasFile('photo')) {
            $this->deletePhoto($review->photo);
            $review->photo = $this->uploadPhoto($request->file('photo'));
        }
        $review->save();

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully!');
    }

    public function updateStatus(Request $request)
    {
        $review = Review::find($request->id);
        if (!$review) {
            return response()->json(['success' => false, 'message' => 'Review not found']);
        }

        $review->is_active = (int) $request->status;
        $review->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    public function destroy(Review $review)
    {
        $this->deletePhoto($review->photo);
        $review->delete();

        return response()->json(['result' => true, 'message' => 'Review deleted successfully']);
    }

    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'rating'      => 'required|integer|min:1|max:5',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
    }

    private function uploadPhoto($file)
    {
        $name = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '', $file->getClientOriginalName());
        $file->move(public_path($this->photoDir), $name);
        return $name;
    }

    private function deletePhoto($photo)
    {
        if ($photo && file_exists(public_path($this->photoDir . $photo))) {
            @unlink(public_path($this->photoDir . $photo));
        }
    }
}
