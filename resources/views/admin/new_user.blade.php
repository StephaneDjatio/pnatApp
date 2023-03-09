@extends('admin.layouts.app')


@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New user</h1>
    </div>

    <div class="row">

        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create new user</h6>
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

                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="username">Name</label>
                            <input type="text" class="form-control" name="name" id="username" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="email_address">Email address</label>
                            <input type="email" class="form-control" name="email" id="email_address" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="user_pwd">Password</label>
                            <input type="password" class="form-control" name="password" id="user_pwd" value="PnatAgeos2022!" readonly required>
                        </div>
                        <div class="form-group mb-4">
                            <div class="col-sm-6 col-sm-offset-3">
                                <label for="myField" class="control-label mr-5">Is Admin:</label>

                                <label class="radio-inline mr-5">
                                    <input type="radio" name="is_admin" value="1" /> Yes
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="is_admin" value="0" checked /> No
                                </label>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-primary" type="submit"><span class="fas fa-fw fa-save"></span>  Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-3"></div>

    </div>


@endsection
