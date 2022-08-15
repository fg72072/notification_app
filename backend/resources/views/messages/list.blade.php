@extends('layouts.app')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Notifications</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Notifications</a></li>
                                <li class="breadcrumb-item active">All Notifications</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">All Notifications</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable ">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Group Name</th>
                                            <th>Body</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($messages as $message)
                                        <tr>
                                            <td>{{$message->id}}</td>
                                            <td>{{$message->user->name}}</td>
                                            <td>{{$message->user->email}}</td>
                                            <td>{{$message->type == '2' ? $message->group->title : '-'}}</td>
                                            <td>{{$message->body}}</td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <!-- <li><a href="{{url('user/edit/'.$message->id)}}" class="dropdown-item edit-item-btn"><i class="ri-eye-line align-bottom me-2 text-muted"></i>
                                                                View</a></li> -->
                                                        <li>
                                                            <form action="{{url('message/destroy/'.$message->id)}}" class="delete-form" method="POST">
                                                                @csrf
                                                                <button class="dropdown-item remove-item-btn">
                                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                    Delete
                                                                </button>
                                                            </form>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Pluton.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Pluton
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
@push('scripts')
<script src="{{asset('assets/js/datatable.js')}}"></script>
<script>
    $('.datatable').DataTable();
</script>
@endpush
@endsection