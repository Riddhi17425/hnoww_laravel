@extends('admin.layouts.app')

@section('title', 'Orders List')

@section('content')
<div class="container-xxl">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h3 class="mb-1">Orders List</h3>
                    <p class="text-muted mb-0">Review customer orders and payment totals.</p>
                </div>
                @if(isset($users) && is_countable($users) && count($users) > 0)
                <div style="min-width: 220px;">
                    <label for="user_id" class="form-label mb-1">Filter by user</label>
                    <select id="user_id" class="form-control input-default">
                        <option value="">-- Select User --</option>
                        @foreach($users as $key => $val)
                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            <div class="table-responsive">
                <table id="orderTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>User Details</th>
                            <th>Order Status</th>
                            <th>Sub Total (AED)</th>
                            <th>Shipping (AED)</th>
                            <th>Order Total (AED)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
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