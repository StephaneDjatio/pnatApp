@extends('admin.layouts.app')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">List of data uploaded</h1>
</div>

<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of data uploaded</h6>
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
                                <th>User</th>
                                <th>Data name</th>
                                <th>Data table name</th>
                                <th>Data color</th>
                                <th>Url data</th>
                                <th>Date of upload</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->user->name  }}</td>
                                    <td>{{ $data->filename }}</td>
                                    <td>{{ $data->database_name }}</td>
                                    <td style="background-color: {{ $data->data_color }};"> {{ $data->data_color }} </td>
                                    <td>{{ $data->link_uploaded_file }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group btn-group" role="group" aria-label="Basic example">
                                            <a href="#" class="btn btn-primary edit-data" id="{{ $data->id }}" title="Edit"><span class="fas fa-fw fa-edit"></span></a>
                                            <a href="#" class="btn btn-warning update-file-data" id="{{ $data->id }}" title="Change file"><span class="fas fa-fw fa-upload"></span></a>
                                            <a type="#" class="btn btn-danger delete-data" id="{{ $data->id }}" title="Delete"><span class="fas fa-fw fa-trash"></span></a>
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


<!-- Data update Modal-->
<div class="modal fade" id="edit-data-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/data/update') }}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="filename">Data name</label>
                        <input type="text" class="form-control" name="filename" id="filename" required>
                        <input type="text" class="form-control" name="id" id="id" hidden>
                    </div>
                    <div class="form-group mb-4">
                        <label for="database_name">Database name</label>
                        <input type="text" class="form-control" name="database_name" id="database_name" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="data_color">Data color</label>
                        <input type="text" class="form-control" name="data_color" id="data_color" required>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary" type="submit"><span class="fas fa-fw fa-edit"></span>  Update</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Data update file Modal-->
<div class="modal fade" id="update-file-data-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload new Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/data/upload-new-file') }}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="file_to_upload">Data color</label>
                        <input type="file" class="form-control" name="file_to_upload" id="file_to_upload" required>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary" type="submit"><span class="fas fa-fw fa-upload"></span>  Update file</button>
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

            var elem = $('#data_color')[0];
            var hueb = new Huebee( elem, {
                notation: 'hex',
                saturations: 2
            });

            $(document).on('click', '.edit-data', function() {
                var modal = $('#edit-data-modal');
                $.ajax({
                    url: "{{ url('/admin/data/show') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {id:this.id},
                    success: function(data) {
                        // console.log(data)
                        // document.location.reload(true);
                        modal.find('.modal-body #id').val(data.id);
                        modal.find('.modal-body #filename').val(data.filename);
                        modal.find('.modal-body #database_name').val(data.database_name);
                        modal.find('.modal-body #data_color').val(data.data_color);

                        modal.modal('show');
                    }
                });
            })

            $(document).on('click', '.update-file-data', function() {
                var modal = $('#update-file-data-modal');
                modal.modal('show');
            })
        })
    </script>
@endsection
