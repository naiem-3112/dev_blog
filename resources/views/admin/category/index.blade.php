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
            <a class="btn btn-primary" href="{{ route('admin.category.create') }}">Add New Category</a>
        </div>
        <!-- /.card-header -->


        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a title="edit category" class="btn btn-sm btn-warning" href="{{ route('admin.category.edit', $category->id) }}"><i class="fa fa-pencil"></i></a>
                        <a title="delete category"  onclick="return confirm('Are you sure to delete this post')"   class="btn btn-sm btn-danger" href="{{ route('admin.category.delete', $category->id) }}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
       {{--     {{ $categories->links() }}--}}
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
