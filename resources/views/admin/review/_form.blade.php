<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Name</label><span class="text-danger">*</span>
        <input type="text" name="name" class="form-control" value="{{ old('name', $review->name ?? '') }}">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">City</label><span class="text-danger">*</span>
        <input type="text" name="city" class="form-control" value="{{ old('city', $review->city ?? '') }}">
        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    @php $isProductReview = (int) old('is_product_review', $review->is_product_review ?? 0); @endphp
    <div class="col-md-6">
        <label class="form-label">Review Type</label><span class="text-danger">*</span>
        <select name="is_product_review" id="is_product_review" class="form-control">
            <option value="0" {{ $isProductReview === 0 ? 'selected' : '' }}>Common Review (Home page)</option>
            <option value="1" {{ $isProductReview === 1 ? 'selected' : '' }}>Product Review (Product detail page)</option>
        </select>
        @error('is_product_review') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6" id="product_select_wrap" style="{{ $isProductReview ? '' : 'display:none;' }}">
        <label class="form-label">Product</label><span class="text-danger">*</span>
        <select name="product_id" class="form-control">
            <option value="">Select Product</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ (int) old('product_id', $review->product_id ?? 0) === $product->id ? 'selected' : '' }}>
                    {{ $product->product_name }}
                </option>
            @endforeach
        </select>
        @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Rating</label><span class="text-danger">*</span>
        <select name="rating" class="form-control">
            @for($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" {{ (int) old('rating', $review->rating ?? 5) === $i ? 'selected' : '' }}>
                    {{ $i }} {{ $i === 1 ? 'Star' : 'Stars' }}
                </option>
            @endfor
        </select>
        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Photo <small class="text-muted">(optional)</small></label>
        @if(!empty($review->photo))
            <div class="mb-2">
                <img src="{{ asset('public/images/admin/reviews/' . $review->photo) }}" width="80" height="80" style="object-fit:cover;border-radius:50%;" alt="review photo">
            </div>
        @endif
        <input type="file" name="photo" class="form-control" accept="image/*">
        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Description</label><span class="text-danger">*</span>
        <textarea name="description" rows="5" class="form-control">{{ old('description', $review->description ?? '') }}</textarea>
        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<script>
    document.getElementById('is_product_review').addEventListener('change', function () {
        document.getElementById('product_select_wrap').style.display = this.value === '1' ? '' : 'none';
    });
</script>
