@extends('admin.layouts.app')


@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New data</h1>
    </div>

    <div class="row">

        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upload new data</h6>
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

                    <form action="{{ url('admin/data/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="filename">Data name</label>
                            <input type="text" class="form-control" name="filename" id="filename" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="database_name">Database name</label>
                            <input type="text" class="form-control" name="database_name" id="database_name" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="data_color">Data color</label>
                            <input type="text" class="form-control" name="data_color" id="data_color" value="#0000FF" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="file_to_upload">Data color</label>
                            <input type="file" class="form-control" name="file_to_upload" id="file_to_upload" required>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-primary" type="submit"><span class="fas fa-fw fa-upload"></span>  Upload file</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-3"></div>

    </div>


@endsection

@section('scripts')
    <script>

        var elem = $('#data_color')[0];
        var hueb = new Huebee( elem, {
            notation: 'hex',
            saturations: 2
        });
    </script>
@endsection
