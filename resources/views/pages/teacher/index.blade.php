@extends('layouts.skarla')

@section('js')

<script type="text/javascript">
    $(document).ready(function () {
        $('.action-delete-teacher').click(function () {

            let username = $(this).data('username');

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this teacher account!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {

                if (isConfirm) {
                    $.ajax({
                        url: baseURL + '/teachers/' + username,
                        type: 'DELETE',
                        success: function () {
                            window.location.reload();
                        }
                    }).fail(xhr => {
                        swal('Error', xhr.responseText, 'error');
                    });
                }
            });
        });
    });
</script>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> 

            <div class="panel panel-default b-a-0 shadow-box b-b-success">
                <div class="panel-heading">
                    Registered Teachers
                    <span class="pull-right">
                        <a href="{{route('teachers.create')}}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Create new Teacher Account
                        </a>
                        <div class="clearfix"></div>
                    </span>
                </div>
                <div class="panel-body">
                    @foreach($teachers as $teacher)
                    <div class="v-a-m">
                        <div class="media media-auto">
                            <div class="media-left">
                                <div class="avatar avatar-image">
                                    <img class="media-object img-circle" src="" alt="Avatar">                           
                                </div>
                            </div>
                            <div class="media-body">
                                <span class="media-heading text-gray-darker">{{$teacher->user_account->display_name}}</span>                                
                                <span class="media-body">
                                    <p>Username: {{$teacher->user_account_username}}</p>
                                    <p>About: {{$teacher->about}}</p>

                                    <a href="javascript:;" class="action-delete-teacher" data-username="{{$teacher->user_account_username}}">
                                        <i class="fa fa-remove"></i> Delete
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
