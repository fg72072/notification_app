@extends('layouts.app')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Groups</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Groups</a></li>
                                <li class="breadcrumb-item active">Add Group</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Add Group</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{route('group.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
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
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                                                @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" rows="3" name="description">{{old('description')}}</textarea>
                                                @error('description')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="status" class="form-label">Participant</label>
                                                <select class="form-control form-select  mb-3 js-example-basic-multiple" name="participant[]" multiple="multiple">
                                                    <option value="all">All</option>

                                                    @foreach($users as $user)
                                                    <option value="{{$user->id.','.$user->name}}">{{$user->name .' ('.$user->email.')'}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <button class="btn btn-primary">Create</button>
                                            </div>
                                        </div>
                                        <!--end col-->
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