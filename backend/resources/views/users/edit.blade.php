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
                                <li class="breadcrumb-item active">Edit User</li>
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
                            <h4 class="card-title mb-0 flex-grow-1">Edit User</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{url('user/update/'.$user->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row gy-4">
                                            <div class="col-xxl-12 col-md-12">
                                                <div id="profile-container">
                                                <img class="" id="profileImage" src="{{asset('assets/images/users/'.$user->image)}}" alt="Upload Image" data-holder-rendered="true" max-height="10px;" max-width="100px;" style="height:100px;width:100px;">
                                            </div>
                                            <br>
                                            <input id="imageUpload" type="file" name="image" placeholder="Photo" capture="" value="">
                                                @error('image')
                                                <div class="mt-1">
                                                <span class="text-danger">{{$message}}</span>
                                                </div>
                                                @enderror
                                            </div>
                                                <div class="col-xxl-12 col-md-12">
                                                    <div>
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" required class="form-control" id="name" name="name" value="{{$user->name}}">
                                                        @error('name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-xxl-12 col-md-12">
                                                    <div>
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" required class="form-control" readonly id="email" name="email" value="{{$user->email}}">
                                                        @error('email')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row gy-4">
                                                @if(Auth::user()->id != $user->id)
                                                <div class="col-xxl-12 col-md-12">
                                                    <div class="mt-4">
                                                        <label for="role" class="form-label">Role</label>
                                                        <select class="form-control form-select " id="role" name="role">
                                                            <option value="0" @if($user->is_admin == '0') selected @endif>User</option>
                                                            <option value="1" @if($user->is_admin == '1') selected @endif>Admin</option>
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
                                                        <select class="form-control form-select " name="status">
                                                            <option value="0" @if($user->status == '0') selected @endif>Active</option>
                                                            <option value="1" @if($user->status == '1') selected @endif>Inactive</option>
                                                        </select>
                                                        @error('role')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                @endif
                                                <div class="col-xxl-12 col-md-12">
                                                    <div class="mt-3">
                                                        <button class="btn btn-primary">Update</button>
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
                <div class="col-lg-6">
                    <div class="chat-box card">
                        @if(Auth::user()->id == $user->id)
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Change Password</h4>
                        </div><!-- end card header -->
                        @else
                        <div class="chat-header">
                            <div class="chat-head-inner">
                                <img src="{{asset('assets/images/users/'.$user->image)}}" />
                                <h3>{{$user->name}}</h3>
                            </div>

                        </div>
                        @endif
                        @if(Auth::user()->id == $user->id)
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{url('user/change-password')}}" method="post">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="row gy-4">
                                               
                                                <div class="col-xxl-12 col-md-12">
                                                    <div>
                                                        <label for="current_password" class="form-label">Current Password</label>
                                                        <input type="password" required class="form-control" id="current_password" name="current_password">
                                                        @error('current_password')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                        @if(session('error'))
                                                        <span class="text-danger">{{session('error')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-xxl-12 col-md-12">
                                                    <div>
                                                        <label for="password" class="form-label">New Password</label>
                                                        <input type="password" required class="form-control" id="password" name="password">
                                                        @error('password')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-xxl-12 col-md-12">
                                                    <div>
                                                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                                                        <input type="password" required class="form-control" id="confirm_password" name="password_confirmation">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-12 col-md-12">
                                                    <div>
                                                        <button class="btn btn-primary">Change</button>
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
                        @else
                        <div class="chat-body">
                        </div>
                        <div class="chat-footer">
                            <form class="chat-form" method="POST" action="{{url('message/store/'.$friendship->id)}}">
                                @csrf
                                <input type="hidden" name="type" value="friendship">
                                <div class="send-message-box">
                                    <textarea name="body" required rows="1" class="message-body form-control"></textarea>
                                    <!-- <input type="text" name="body" required class="message-body form-control"> -->
                                    <button class="btn btn-success send-msg-btn">
                                        Send
                                    </button>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                <!--end col-->
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
@if(Auth::user()->id != $user->id)
<script>
    function getMessages() {
        setInterval(() => {
            $.ajax({
                url: "{{url('message/'.$friendship->id)}}",
                type: 'GET',
                data: {
                    type: 'friend'
                },
                success: function(res) {
                    $(".chat-body").empty()
                    $(".chat-body").append(
                        res
                    )
                }
            });
        }, 1000);
    }
    getMessages()

    $(".chat-form").submit(function(e) {
        e.preventDefault()
        $(".send-msg-btn").text('Loading...')
        $(".send-msg-btn").attr('disabled', true)
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                $(".message-body").val('');
                $(".send-msg-btn").text('Send')
                $(".send-msg-btn").attr('disabled', false)
            }
        });
    })
</script>
@endif
@endpush
@endsection