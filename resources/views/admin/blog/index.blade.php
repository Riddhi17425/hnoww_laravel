    @extends('admin.layouts.app')

    @section('content')
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Blogs</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <a href="{{ route('admin.blogs.create') }}">
                                    <button type="button" class="btn btn-primary btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i>Add Blogs</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="row clearfix g-3">
                    <div class="col-sm-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <table id="blogs_table" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Front Image</th>
                                            <th>Status</th>
                                            <th>Actions</th>  
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
            </div>
        </div>

<script>
    window.APP_URLS = {
        getBlogsData: "{{ route('admin.blogs.fetch') }}",
        deleteblogs:"{{ route('admin.blogs.delete' , [':id']) }}",
        updateStatus:"{{ route('admin.blogs.update.status') }}",
        csrfToken: "{{ csrf_token() }}",
        image_path: "{{ asset('/') }}"
    };
</script>
<script src="{{ asset('public/js/admin/blog.js') }}" defer></script>
@endsection
        

        