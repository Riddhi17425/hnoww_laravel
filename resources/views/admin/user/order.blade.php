@extends('admin.layouts.app')

@section('title', 'Orders List')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Orders List</h3>
        </div>
    </div>
    <div class="col-md-2">   
        @if(isset($users) && is_countable($users) && count($users) > 0)       
            <select id="user_id" class="form-control input-default">
                <option value=""> -- Select User -- </option>
                @foreach($users as $key => $val)     
                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                @endforeach
            </select>
        @endif
    </div>
     <table id="orderTable" class="table table-hover align-middle mb-0" style="width: 100%;">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>User Details</th>
                <th>Order Status</th>
                <th>Sub Total</th>
                <th>Order Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
@endsection

@push('custom_scripts')
<script>
window.APP_URLS = {
            getOrders: "{{ route('admin.users.orders.fetch') }}",
            csrfToken: "{{ csrf_token() }}"
        };

</script>
<script src="{{ asset('public/js/admin/users.js') }} " defer></script>
@endpush