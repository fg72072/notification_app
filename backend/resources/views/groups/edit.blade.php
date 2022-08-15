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
                                <li class="breadcrumb-item active">View Group</li>
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
                            <h4 class="card-title mb-0 flex-grow-1">Edit Group</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{url('group/update/'.$group->slug)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row gy-4">
                                    <div class="col-xxl-12 col-md-12">
                                        <div id="profile-container">
                                        <img class="" id="profileImage" src="{{asset('assets/images/groups/'.$group->image)}}" alt="Upload Image" data-holder-rendered="true" max-height="10px;" max-width="100px;" style="height:100px;width:100px;">
                                    </div>
                                    <br>
                                    <input id="imageUpload" type="file" name="image" placeholder="Photo" capture="" value="">
                                        @error('image')
                                        <div class="mt-1">
                                        <span class="text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="title" value="{{$group->title ?? old('title')}}" name="title">
                                                @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" rows="5" name="description">{!! $group->description ?? old('description') !!}</textarea>
                                                @error('description')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <button class="btn btn-primary">Update</button>
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
                <div class="col-lg-6">
                    <div class="chat-box card">
                        <div class="chat-header">
                            <div class="chat-head-inner">
                                <img src="{{asset('assets/images/groups/'.$group->image)}}" />
                                <h3>{{$group->title}}</h3>
                            </div>
                        </div>
                        <div class="chat-body">

                        </div>
                        <div class="chat-footer">
                            <form class="chat-form" method="POST" action="{{url('message/store/'.$group->id)}}">
                                @csrf
                                <input type="hidden" name="type" value="group">
                                <div class="send-message-box">
                                    <textarea name="body" required rows="1" class="message-body form-control"></textarea>
                                    <!-- <input type="text" name="body" required class="message-body form-control"> -->
                                    <button class="btn btn-success send-msg-btn">
                                        Send
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Members</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Participant</button>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable ">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($group->members as $member)
                                        <tr>
                                            <td>{{$member->id}}</td>
                                            <td>{{$member->user->name}}</td>
                                            <td>{{$member->user->email}}</td>
                                            <td>
                                                @if(Auth::user()->id != $member->user->id)
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <form action="{{url('participant/destroy/'.$member->id)}}" class="delete-form" method="POST">
                                                            @csrf
                                                            <button class="dropdown-item remove-item-btn">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                Delete
                                                            </button>
                                                        </form>

                                                        </li>
                                                    </ul>
                                                </div>
                                                @else
                                                -
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Participant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{route('member.store')}}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <div class="form-group">
                            <label for="title" class="form-label">Group Name</label>
                            <input type="text" class="form-control" id="title" readonly value="{{$group->title}}">
                        </div>
                        <div class="form-group">
                            <label for="participant" class="form-label">Participants</label>
                            <select class="form-control form-select  mb-3 multiple-select" id="participant" name="participant[]" multiple="multiple">
                                @foreach($users as $user)
                                <option value="{{$user->id.','.$user->name}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{asset('assets/js/datatable.js')}}"></script>
<script>
    $('.datatable').DataTable();
    $(".multiple-select").select2({
        dropdownParent: $('#exampleModal')
    });

    function getMessages() {
        setInterval(() => {
            $.ajax({
                url: "{{url('message/'.$group->id)}}",
                type: 'GET',
                data:{type:'group'},
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
        $(".send-msg-btn").attr('disabled',true)
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                $(".message-body").val('');
                $(".send-msg-btn").text('Send')
                $(".send-msg-btn").attr('disabled',false)
            }
        });
    })
   
</script>
@endpush
@endsection