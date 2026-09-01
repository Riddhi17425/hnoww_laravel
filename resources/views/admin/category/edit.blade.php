@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between flex-wrap border-bottom">
                <h3 class="fw-bold mb-0">Edit Category</h3>
            </div>
        </div>
    </div> 

    <div class="row g-3 mb-3">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold">Basic information</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" id="categoryForm">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label class="form-label">Category Type</label><span class="text-danger">*</span>
                                <select name="category_type" class="form-control">
                                    <option value="">-- Select Type --</option>
                                    @foreach(config('global_values.category_type') as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('category_type', $category->category_type ?? '') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Category Name</label><span class="text-danger">*</span>
                                <input type="text" name="category_name" class="form-control" value="{{ old('category_name', $category->category_name) }}" id="category_name">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Category URL</label><span class="text-danger">*</span>
                                <div class="input-group mb-3">
                                    <input type="text" name="category_url" class="form-control" value="{{ old('category_url', $category->category_url) }}" id="category_url">
                                </div>
                                @error('category_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label d-block">Category Placement</label>
                                <div class="form-check form-switch mt-2">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        id="is_festive"
                                        name="is_festive"
                                        value="1"
                                        {{ old('is_festive', $category->is_festive) == 1 ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="is_festive">
                                        Display this category on Festive Page
                                    </label>
                                </div>
                                <small class="text-muted">
                                    When enabled, this category will be removed from the Collection menu.
                                </small>
                                @error('is_festive')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label d-block">Product Button Type</label>

                                <div class="form-check form-switch mt-2">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        id="is_inquiry"
                                        name="is_inquiry"
                                        value="1"
                                        {{ old('is_inquiry', $category->is_inquiry) ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="is_inquiry">
                                        Show "Inquire Now" button for all category products
                                    </label>
                                </div>

                                <small class="text-muted">
                                    When disabled, all category products will display the "View Detail" button.
                                </small>

                                @error('is_inquiry')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Category Title</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $category->title) }}" id="title">
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Category Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr class="mt-4">

                            <h5 class="fw-bold mb-3">Festive Section</h5>

                            {{-- FESTIVE SECTION FIELDS --}}

                            <div class="col-md-6">
                                <label class="form-label">Celebration Label</label>
                                <input type="text"
                                    name="celebration_label"
                                    class="form-control"
                                    value="{{ old('celebration_label', $category->celebration_label) }}">

                                @error('celebration_label')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Celebration Title</label>
                                <input type="text"
                                    name="celebration_title"
                                    class="form-control"
                                    value="{{ old('celebration_title', $category->celebration_title) }}">

                                @error('celebration_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Celebration Description</label>
                                <textarea name="celebration_description" id="celebration_description"
                                        class="form-control"
                                        rows="4">{{ old('celebration_description', $category->celebration_description) }}</textarea>

                                @error('celebration_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Celebration Image</label>
                                <input type="file"
                                    name="celebration_image"
                                    class="form-control">

                                @if($category->celebration_image)
                                    <div class="mt-2">
                                        <img src="{{ url('public/images/admin/category_celebration/' . $category->celebration_image) }}"
                                            width="150"
                                            alt="Celebration Image">
                                    </div>
                                @endif

                                @error('celebration_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            {{-- COLLECTION SECTION --}}

                            <div class="col-md-12 mt-3">
                                <h6 class="fw-bold">Collection Section</h6>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Collection Label</label>
                                <input type="text"
                                    name="collection_label"
                                    class="form-control"
                                    value="{{ old('collection_label', $category->collection_label) }}">

                                @error('collection_label')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Collection Title</label>
                                <input type="text"
                                    name="collection_title"
                                    class="form-control"
                                    value="{{ old('collection_title', $category->collection_title) }}">

                                @error('collection_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Collection Description</label>
                                <textarea name="collection_description" id="collection_description"
                                        class="form-control"
                                        rows="4">{{ old('collection_description', $category->collection_description) }}</textarea>

                                @error('collection_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            {{-- FAQ SECTION --}}

                            <div class="col-md-12 mt-3">
                                <h6 class="fw-bold">FAQs</h6>
                            </div>

                            <div class="col-md-12">
                                <div id="faq-wrapper">

                                    @php
                                        $faqs = old('faqs');

                                        if ($faqs === null)
                                        {
                                            $faqs = $category->faqs;
                                        }

                                        // If FAQs are still a JSON string, decode them
                                        if (is_string($faqs))
                                        {
                                            $faqs = json_decode($faqs, true);
                                        }

                                        // Safety check
                                        if (!is_array($faqs))
                                        {
                                            $faqs = [];
                                        }
                                    @endphp

                                    @if(!empty($faqs))
                                        @foreach($faqs as $index => $faq)
                                            <div class="faq-item border rounded p-3 mb-3">
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Question</label>

                                                        <input type="text"
                                                            name="faqs[{{ $index }}][question]"
                                                            class="form-control"
                                                            value="{{ $faq['question'] ?? '' }}"
                                                            placeholder="Enter FAQ question">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Answer</label>
                                                        <textarea name="faqs[{{ $index }}][answer]"
                                                                class="form-control"
                                                                rows="3"
                                                                placeholder="Enter FAQ answer">{{ $faq['answer'] ?? '' }}</textarea>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <button type="button"
                                                                class="btn btn-danger btn-sm remove-faq">
                                                            Remove FAQ
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="faq-item border rounded p-3 mb-3">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label class="form-label">Question</label>
                                                    <input type="text"
                                                        name="faqs[0][question]"
                                                        class="form-control"
                                                        placeholder="Enter FAQ question">
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label">Answer</label>
                                                    <textarea name="faqs[0][answer]"
                                                            class="form-control"
                                                            rows="3"
                                                            placeholder="Enter FAQ answer"></textarea>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="button"
                                                            class="btn btn-danger btn-sm remove-faq"
                                                            style="display:none;">
                                                        Remove FAQ
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <button type="button"
                                        id="add-faq"
                                        class="btn btn-secondary btn-sm">
                                    + Add FAQ
                                </button>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Meta Title</label><span class="text-danger">*</span>
                                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $category->meta_title) }}">
                                @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Meta Description</label><span class="text-danger">*</span>
                                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $category->meta_description) }}</textarea>
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Banner Image --}}
                            <div class="col-md-6">
                                <label class="form-label">Banner Image</label><span class="text-danger">*</span>
                                <input type="file" name="banner_image" class="form-control">
                                @error('banner_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @if($category->banner_image)
                                    <div class="mt-2">
                                        <img src="{{ url('public/images/admin/category_banner/'.$category->banner_image) }}" alt="Banner" width="250">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Button Text (Use for only Category Products)</label><span class="text-danger">*</span>
                                <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $category->button_text) }}">
                                @error('button_text')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr><h5>The World Section Fields</h5>
                            {{-- THE WORLD SECTION FIELDS --}}
                            <div class="col-md-6">
                                <label class="form-label">Heading First</label>
                                <input type="text" name="magic_heading_first" class="form-control" value="{{ old('magic_heading_first', $category->magic_heading_first) }}">
                                @error('magic_heading_first')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Heading Second</label>
                                <input type="text" name="magic_heading_second" class="form-control" value="{{ old('magic_heading_second', $category->magic_heading_second) }}">
                                @error('magic_heading_second')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="magic_title" class="form-control" value="{{ old('magic_title', $category->magic_title) }}">
                                @error('magic_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Image</label>
                                <input type="file" name="magic_image" class="form-control">
                                @error('magic_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if($category->magic_image)
                                    <div class="mt-2">
                                        <img src="{{ url('public/images/admin/category_magic/'.$category->magic_image) }}" alt="Magic Image" width="250">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="magic_description" class="form-control" rows="3">{{ old('magic_description', $category->magic_description) }}</textarea>
                                @error('magic_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_scripts')
<script>
$(document).ready(function() {
    const summernoteOptions = {
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ]
    };

    $('#description').summernote({
        ...summernoteOptions,
        placeholder: 'Enter Category Description here...'
    });

    $('#celebration_description').summernote({
        ...summernoteOptions,
        placeholder: 'Enter Celebration Description here...'
    });

    $('#collection_description').summernote({
        ...summernoteOptions,
        placeholder: 'Enter Collection Description here...'
    });

    // Slug auto-generate
    $('#category_name').on('input', function() {
        var name = $(this).val();
        var slug = name.toLowerCase()
                       .replace(/[^a-z0-9\s-]/g, '')
                       .replace(/\s+/g, '-')
                       .replace(/-+/g, '-');
        $('#category_url').val(slug);
    });

    let faqIndex = {{ count($faqs) > 0 ? count($faqs) : 1 }};

    $('#add-faq').on('click', function () {

        let faqHtml = `
            <div class="faq-item border rounded p-3 mb-3">

                <div class="row g-3">

                    <div class="col-md-12">
                        <label class="form-label">Question</label>

                        <input type="text"
                            name="faqs[${faqIndex}][question]"
                            class="form-control"
                            placeholder="Enter FAQ question">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Answer</label>

                        <textarea name="faqs[${faqIndex}][answer]"
                                class="form-control"
                                rows="3"
                                placeholder="Enter FAQ answer"></textarea>
                    </div>

                    <div class="col-md-12">
                        <button type="button"
                                class="btn btn-danger btn-sm remove-faq">
                            Remove FAQ
                        </button>
                    </div>

                </div>

            </div>
        `;

        $('#faq-wrapper').append(faqHtml);

        faqIndex++;
    });

    $(document).on('click', '.remove-faq', function () {
        $(this).closest('.faq-item').remove();
    });
    
});
</script>
@endpush
