@extends('layouts.backend.master')

@section('base.title', 'Post')

@push('base.css')
    <link rel="stylesheet" href="{{asset('assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

@endpush

@section('master.content')
    @if(session()->has('message'))
        <div class="col-sm-4 offset-sm-2 alert">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a class="btn btn-outline-primary" href="{{ route('post.index') }}">Back</a>

        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="15%">Writer Name</th>
                    <th width="15%">Title</th>
                    <th width="35%">Post Content</th>
                    <th width="15%">Category</th>
                    <th width="20%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rejects as $reject)
                    <tr>
                        <td>{{ $reject->user->name }}</td>
                        <td>{{ $reject->title }}</td>
                        <td>
                            {{ Str::limit(strip_tags($reject->body), 100) }}
                        </td>
                        <td>{{ $reject->category->name }}</td>

                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('post.rejectedView', $reject->id) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-sm btn-warning" href="{{ route('post.rejectedEdit', $reject->id) }}"><i class="fa fa-pencil"></i></a>
                            <a onclick="return confirm('Are you sure to delete post permanently')" class="btn btn-sm btn-danger" href="{{ route('post.rejectedDelete', $reject->id) }}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th width="15%">Writer Name</th>
                    <th width="15%">Title</th>
                    <th width="35%">Post Content</th>
                    <th width="15%">Category</th>
                    <th width="20%">Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@push('base.js')
    <script src="{{asset('assets/backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endpush
