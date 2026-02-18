@extends('admin.layouts.app')

@section('title', 'Add Journal')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Edit Blessing</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.blessings.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <form action="{{ route('admin.blessings.update', $blessing->id) }}" method="POST" enctype="multipart/form-data" id="vlessingForm">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label">Blessing Of</label><span class="text-danger">*</span>
                <select id="blessing_of" name="blessing_of[]" multiple class="form-control">
                    <option value="">-- Select Blessing Of --</option>
                    @foreach(config('global_values.blessing_of') as $key => $label)
                        <option value="{{ $key }}" {{ old('blessing_of', $blessing->blessing_of ?? '') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('blessing_of') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Title</label><span class="text-danger">*</span>
                <input type="text" name="title" class="form-control" value="{{ old('title', $blessing->title ?? '') }}">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Sub Title</label><span class="text-danger">*</span>
                <input type="text" name="sub_title" class="form-control" value="{{ old('sub_title', $blessing->sub_title ?? '') }}">
                @error('sub_title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Description</label><span class="text-danger">*</span>
                <textarea name="description" id="description" class="form-control">{{ old('description', $blessing->description ?? '') }}</textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Image</label><span class="text-danger">*</span>
                <input type="file" name="image" class="form-control">
                @if(isset($blessing->image))
                    <img src="{{ asset('public/images/admin/blessing/images/'.$blessing->image) }}" width="100">
                @endif
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- <div class="col-md-6">
                <label class="form-label">Audio File</label><span class="text-danger">*</span>
                <input type="file" name="audio_file" class="form-control">
                @if(isset($blessing->audio_file))
                    <audio controls>
                        <source src="{{ asset('public/images/admin/blessing/audios/'.$blessing->audio_file) }}" type="audio/mpeg">
                    </audio>
                @endif
                @error('audio_file') <span class="text-danger">{{ $message }}</span> @enderror
            </div> --}}
            <div class="col-md-12">
                <label class="form-label">Audio Content</label><span class="text-danger">*</span>
                <textarea name="audio_content" id="audio_content" class="form-control" rows="10">{{ old('audio_content', $blessing->audio_content ?? '') }}</textarea>
                @error('audio_content') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Save Blessing</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('custom_scripts')
<script src="{{ asset('public/js/admin/blessing.js') }} " defer></script>
<script> 

$(document).ready(function() {
    $('#description').summernote({
        placeholder: 'Enter Description here...',
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
    });
});
</script>

@endpush