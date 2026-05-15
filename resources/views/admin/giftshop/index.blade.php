@extends('admin.layouts.app')

@section('title', 'Products List')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Gift List</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.giftshops.create') }}" class="btn btn-primary">Add Gift</a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-2">                      
            <select id="status" class="form-control input-default">
                <option value=""> -- Select Status -- </option>
                <option value="0">Active</option>
                <option value="1">In-active</option>
            </select>
        </div> 
        <div class="col-md-3">                      
            <select id="gift_for" class="form-control input-default">
                <option value=""> -- Select Gift For -- </option>
                @foreach(config('global_values.gift_for') as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">                      
            <select id="to_celebrate" class="form-control input-default">
                <option value=""> -- Select To Celebrate -- </option>
                @foreach(config('global_values.to_celebrate') as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

    </div>
    

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="giftTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gift For</th>
                        <th>To Celebrate</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Short Description</th>
                        <th>Product Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('custom_scripts')
<script>
window.APP_URLS = {
            getGiftS: "{{ route('admin.giftshop.fetch') }}",
            updateStatus:"{{ route('admin.giftshop.update.status') }}",
            deleteGift: "{{ route('admin.giftshops.destroy', ['giftshop' => '__ID__']) }}",
            csrfToken: "{{ csrf_token() }}"
        };

</script>
<script src="{{ asset('public/js/admin/gift.js') }} " defer></script>
@endpush