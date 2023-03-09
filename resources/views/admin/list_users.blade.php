@extends('admin.layouts.app')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Users list</h1>
</div>

<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users list</h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Is admin</th>
                                <th>Date creation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->is_admin == 1)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                        <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <div class="btn-group btn-group" role="group" aria-label="Basic example">
                                            <a href="#" class="btn btn-primary edit-user" id="{{ $user->id }}" title="Edit"><span class="fas fa-fw fa-edit"></span></a>
                                            <a href="#" class="btn btn-warning reset-pwd" id="{{ $user->id }}" title="Reset password"><span class="fas fa-fw fa-redo"></span></a>
                                            <a type="#" class="btn btn-danger delete-user" id="{{ $user->id }}" title="Delete"><span class="fas fa-fw fa-trash"></span></a>
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
    <div class="col-lg-1"></div>
</div>

<!-- User update Modal-->
<div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/user/update') }}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="username">Name</label>
                        <input type="text" class="form-control" name="name" id="username" required>
                        <input type="text" class="form-control" name="id" id="id" hidden>
                    </div>
                    <div class="form-group mb-4">
                        <label for="email_address">Email address</label>
                        <input type="email" class="form-control" name="email" id="email_address" required>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-6 col-sm-offset-3">
                            <label for="myField" class="control-label mr-3">Is Admin:</label>

                            <label class="radio-inline mr-3">
                                <input type="radio" class="is_admin" name="is_admin" id="is_admin_yes" value="1" /> Yes
                            </label>

                            <label class="radio-inline">
                                <input type="radio" class="is_admin" name="is_admin" id="is_admin_no" value="0" checked /> No
                            </label>
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary" type="submit"><span class="fas fa-fw fa-save"></span>  Update</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- User reset password Modal-->
<div class="modal fade" id="reset-password-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset user password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/user/resetPassword') }}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="username">Name</label>
                        <input type="text" class="form-control" name="name" id="username" required readonly>
                        <input type="text" class="form-control" name="id" id="id" hidden>
                    </div>
                    <div class="form-group mb-4">
                        <label for="user_pwd">Password</label>
                        <input type="password" class="form-control" name="password" id="user_pwd" value="PnatAgeos2022!" readonly required>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary" type="submit"><span class="fas fa-fw fa-save"></span>  Reset password</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-user', function() {
                var modal = $('#edit-user-modal');
                $.ajax({
                    url: "{{ url('/admin/user/show') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {id:this.id},
                    success: function(data) {
                        console.log(data.is_admin)
                        // document.location.reload(true);
                        modal.find('.modal-body #id').val(data.id);
                        modal.find('.modal-body #username').val(data.name);
                        modal.find('.modal-body #email_address').val(data.email);
                        if (data.is_admin == false) {
                            modal.find('.modal-body #is_admin_no').prop('checked',true);
                        } else {
                            modal.find('.modal-body #is_admin_yes').prop('checked',true);
                        }

                        modal.modal('show');
                    }
                });
            })

            $(document).on('click', '.reset-pwd', function() {
                var modal = $('#reset-password-user-modal');
                $.ajax({
                    url: "{{ url('/admin/user/show') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {id:this.id},
                    success: function(data) {
                        console.log(data.is_admin)
                        // document.location.reload(true);
                        modal.find('.modal-body #id').val(data.id);
                        modal.find('.modal-body #username').val(data.name);

                        modal.modal('show');
                    }
                });
            })
        })
    </script>
@endsection
