@extends('layouts.app')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Users</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">Add User</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Add User</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                        <div class="row gy-4">
                                           <div class="col-xxl-12 col-md-12">
                                            <div id="profile-container">
                                                <img class="" id="profileImage" src="" alt="Upload Image" data-holder-rendered="true" max-height="10px;" max-width="100px;" style="height:100px;width:100px;">
                                            </div>
                                            <br>
                                            <input id="imageUpload" type="file" name="image" placeholder="Photo" capture="" value="">
                                            @error('image')
                                            <div class="mt-1">
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" required class="form-control" id="name" name="name" value="{{old('name')}}">
                                                @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" required class="form-control" id="email" name="email" value="{{old('email')}}">
                                                @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" required class="form-control" id="password" name="password">
                                                @error('password')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                                <input type="password" required class="form-control" id="confirm_password" name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="role" class="form-label">Role</label>
                                                <select class="form-control form-select  mb-3" id="role" name="role" >
                                                    <option value="0" selected>User</option>
                                                    <option value="1">Admin</option>
                                                </select>
                                                @error('role')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-control form-select  mb-3"  name="status" >
                                                    <option value="0" selected>Active</option>
                                                    <option value="1">Inactive</option>
                                                </select>
                                                @error('role')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <button class="btn btn-primary">Publish</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                        </div>
                                      
                                    </div>
                                   
                                    <!--end row-->
                                </form>
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

@endsection