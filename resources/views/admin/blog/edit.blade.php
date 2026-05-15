@extends('admin.layouts.app')

@section('content')

<style>
    .required-star {
        color: red;
    }
</style>

<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">

        {{-- Page Header --}}
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div
                    class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Edit Blogs</h3>

                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary btn-set-task">
                        Back
                    </a>
                </div>
            </div>
        </div>

        {{-- Form Section --}}
        <div class="row clearfix g-3">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">

                        <form action="{{ route('admin.blogs.update', $blog->id) }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="card mb-4 border">
                                <div class="card-header bg-light">
                                    <strong>Blogs Information</strong>
                                </div>

                                <div class="card-body row">

                                    {{-- Title --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Title <span class="required-star">*</span>
                                        </label>

                                        <input type="text"
                                            name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title', $blog->title) }}"
                                            placeholder="Enter Title">

                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- URL --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Url <span class="required-star">*</span>
                                        </label>

                                        <input type="text"
                                            name="url"
                                            class="form-control @error('url') is-invalid @enderror"
                                            value="{{ old('url', $blog->url) }}"
                                            placeholder="Enter url">

                                        @error('url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Front Image --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Front Image <span class="required-star">*</span>
                                        </label>

                                        <input type="file"
                                            name="front_image"
                                            id="blogs_front_image"
                                            class="form-control @error('front_image') is-invalid @enderror"
                                            onchange="validateAndPreviewFrontImage()">

                                        @if($blog->front_image)
                                            <img src="{{ asset('/' . $blog->front_image) }}"
                                                id="preview_front_image"
                                                class="mt-2"
                                                style="max-width: 100px; height:100px;">
                                        @endif

                                        @error('front_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Front Image Alt --}}
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Front Image Alt Text
                                            <span class="required-star">*</span>
                                        </label>

                                        <input type="text"
                                            name="front_image_alt"
                                            class="form-control @error('front_image_alt') is-invalid @enderror"
                                            value="{{ old('front_image_alt', $blog->front_image_alt) }}"
                                            placeholder="Enter Front Image Alt Text">

                                        @error('front_image_alt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Banner Image --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Banner Image <span class="required-star">*</span>
                                        </label>

                                        <input type="file"
                                            name="detail_image"
                                            id="blogs_detail_image"
                                            class="form-control @error('detail_image') is-invalid @enderror"
                                            onchange="validateAndPreviewBannerImage()">

                                        @if($blog->detail_image)
                                            <img id="preview_blogs_image"
                                                src="{{ asset('/' . $blog->detail_image) }}"
                                                class="mt-2"
                                                style="max-width:100px; height:100px;">
                                        @endif

                                        @error('detail_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Banner Image Alt --}}
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Banner Image Alt Text
                                            <span class="required-star">*</span>
                                        </label>

                                        <input type="text"
                                            name="banner_image_alt"
                                            class="form-control @error('banner_image_alt') is-invalid @enderror"
                                            value="{{ old('banner_image_alt', $blog->detail_image_alt) }}"
                                            placeholder="Enter Banner Image Alt Text">

                                        @error('banner_image_alt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- CTA Image --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Cta Image</label>

                                        <input type="file"
                                            name="cta_image"
                                            id="cta_image"
                                            class="form-control @error('cta_image') is-invalid @enderror"
                                            onchange="validateAndPreviewCTAImage()">

                                        @if($blog->cta_image)
                                            <img id="preview_cta_image"
                                                src="{{ asset('/' . $blog->cta_image) }}"
                                                class="mt-2"
                                                style="max-width:100px; height:100px;">
                                        @endif

                                        @error('cta_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- CTA Image Alt --}}
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Cta Image Alt Text
                                            <span class="required-star">*</span>
                                        </label>

                                        <input type="text"
                                            name="cta_image_alt"
                                            class="form-control @error('cta_image_alt') is-invalid @enderror"
                                            value="{{ old('cta_image_alt', $blog->cta_image_alt) }}"
                                            placeholder="Enter Cta Image Alt Text">

                                        @error('cta_image_alt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- OG Image --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">OG Image</label>

                                        <input type="file"
                                            name="og_image"
                                            id="og_image"
                                            class="form-control @error('og_image') is-invalid @enderror"
                                            onchange="validateAndPreviewOGImage()">

                                        @if($blog->og_image)
                                            <img id="preview_og_image"
                                                src="{{ asset('/' . $blog->og_image) }}"
                                                class="mt-2"
                                                style="max-width:100px; height:100px;">
                                        @endif

                                        @error('og_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- OG Image Alt --}}
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            OG Image Alt Text
                                            <span class="required-star">*</span>
                                        </label>

                                        <input type="text"
                                            name="og_image_alt"
                                            class="form-control @error('og_image_alt') is-invalid @enderror"
                                            value="{{ old('og_image_alt', $blog->og_image_alt) }}"
                                            placeholder="Enter OG Image Alt Text">

                                        @error('og_image_alt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Date --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Date <span class="required-star">*</span>
                                        </label>

                                        <input type="date"
                                            id="date"
                                            value="{{ old('date', $blog->date) }}"
                                            name="date"
                                            class="form-control">
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Status <span class="required-star">*</span>
                                        </label>

                                        <select name="status"
                                            class="form-control @error('status') is-invalid @enderror">

                                            <option value="Active"
                                                {{ old('status', $blog->status) == 'Active' ? 'selected' : '' }}>
                                                Active
                                            </option>

                                            <option value="In-Active"
                                                {{ old('status', $blog->status) == 'In-Active' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- CTA Content --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">CTA Content</label>

                                        <textarea name="cta_content"
                                            id="cta_content"
                                            class="form-control">{{ old('cta_content', $blog->cta_content) }}</textarea>

                                        @error('cta_content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Short Description --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">
                                            Short Description
                                            <span class="required-star">*</span>
                                        </label>

                                        <textarea name="short_description"
                                            id="short_description"
                                            class="form-control">{{ old('short_description', $blog->short_description) }}</textarea>

                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Detail Description --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">
                                            Detail Description
                                            <span class="required-star">*</span>
                                        </label>

                                        <textarea name="detail_description"
                                            id="detail_description"
                                            rows="4"
                                            class="form-control">{{ old('detail_description', $blog->detail_description) }}</textarea>

                                        @error('detail_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Conclusion --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">
                                            Conclusion
                                            <span class="required-star">*</span>
                                        </label>

                                        <textarea name="conclusion"
                                            id="conclusion"
                                            rows="4"
                                            class="form-control">{{ old('conclusion', $blog->conclusion) }}</textarea>

                                        @error('conclusion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Meta Title --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Title</label>

                                        <input type="text"
                                            id="meta_title"
                                            name="meta_title"
                                            value="{{ old('meta_title', $blog->meta_title) }}"
                                            class="form-control">
                                    </div>

                                    {{-- Meta Description --}}
                                    <div class="col-md-12">
                                        <label class="form-label">Meta Description</label>

                                        <textarea id="meta_description"
                                            name="meta_description"
                                            class="form-control">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                    </div>

                                    {{-- Blogs Schema --}}
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">Blogs Schema</label>

                                        <textarea id="blogs_schema"
                                            name="blogs_schema"
                                            class="form-control">{{ old('blogs_schema', $blog->blog_schema) }}</textarea>
                                    </div>

                                </div>
                            </div>

                            {{-- FAQ SECTION --}}
                            @php
                                $faqBlocks = is_array($blog->blog_faq)
                                    ? $blog->blog_faq
                                    : json_decode($blog->blog_faq, true);

                                $faqBlocks = $faqBlocks ?? [];
                            @endphp

                            <div class="card mb-4 border">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <strong>FAQ Title & Description</strong>

                                    <button type="button"
                                        id="addFaqBlock"
                                        class="btn btn-sm btn-success">
                                        + Add More
                                    </button>
                                </div>

                                <div class="card-body" id="faqRepeater">

                                    @forelse ($faqBlocks as $block)

                                        <div class="faqGroup border rounded p-3 mb-3">

                                            <div class="mb-3">
                                                <label class="form-label">Title</label>

                                                <input type="text"
                                                    name="faq_title[]"
                                                    class="form-control"
                                                    value="{{ $block['faq_title'] ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Description</label>

                                                <textarea name="faq_description[]"
                                                    class="form-control summernote"
                                                    rows="4">{{ $block['faq_description'] ?? '' }}</textarea>
                                            </div>

                                            <div class="text-end">
                                                <button type="button"
                                                    class="btn btn-danger removeFaq">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>

                                    @empty

                                        <div class="faqGroup border rounded p-3 mb-3">

                                            <div class="mb-3">
                                                <label class="form-label">Title</label>

                                                <input type="text"
                                                    name="faq_title[]"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Description</label>

                                                <textarea name="faq_description[]"
                                                    class="form-control summernote"
                                                    rows="4"></textarea>
                                            </div>

                                            <div class="text-end">
                                                <button type="button"
                                                    class="btn btn-danger removeFaq">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>

                                    @endforelse

                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Blogs
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection


@push('custom_scripts')

<script src="{{ asset('public/js/admin/blog.js') }}" defer></script>

<script>

    $(document).ready(function () {

        $('#detail_description').summernote({
            placeholder: 'Enter Description here...',
            height: 300,
        });

        $('#short_description').summernote({
            placeholder: 'Enter Description here...',
            height: 300,
        });

        $('#conclusion').summernote({
            placeholder: 'Enter Conclusion here...',
            height: 300,
        });

        $('#meta_description').summernote({
            placeholder: 'Enter Meta Description here...',
            height: 300,
        });

        $('#cta_content').summernote({
            placeholder: 'Enter CTA Content here...',
            height: 300,
        });

        $('#blogs_schema').summernote({
            placeholder: 'Enter Blogs Schema here...',
            height: 300,
        });

        $('.summernote').summernote({
            height: 200,
            placeholder: 'Enter Description here...'
        });

        $('#addFaqBlock').click(function () {

            let block = `
                <div class="faqGroup border rounded p-3 mb-3">

                    <div class="mb-3">
                        <label class="form-label">Title</label>

                        <input type="text"
                            name="faq_title[]"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>

                        <textarea name="faq_description[]"
                            class="form-control summernote"
                            rows="4"></textarea>
                    </div>

                    <div class="text-end">
                        <button type="button"
                            class="btn btn-danger removeFaq">
                            Remove
                        </button>
                    </div>

                </div>
            `;

            $('#faqRepeater').append(block);

            $('.summernote').summernote({
                height: 200,
                placeholder: 'Enter Description here...'
            });

        });

        $(document).on('click', '.removeFaq', function () {
            $(this).closest('.faqGroup').remove();
        });

    });

</script>

@endpush