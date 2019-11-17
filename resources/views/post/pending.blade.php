@extends('layouts.backend.master')

@section('base.title', 'Post')

@push('base.css')
    <link rel="stylesheet" href="{{asset('assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

@endpush

@section('master.content')
    <div style="text-align: center; background-color: darkgrey; color: lightgrey" class="card-header">
        <b> Pending Post </b>
    </div>
    @if(session()->has('message'))
        <div class="col-sm-4 offset-sm-2 alert">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card">
       {{-- <div class="card-header">
            <a class="btn btn-primary" href="{{ route('post.create') }}">Add New Post</a>
        </div>--}}
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="10%">Writer Name</th>
                    <th width="15%">Title</th>
                    <th width="40%">Post Content</th>
                    <th width="15%">Category</th>
                    <th width="20%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pendings as $pending)
                    <tr>
                        <td>{{ $pending->user->name }}</td>
                        <td>{{ $pending->title }}</td>
                        <td>
                            {{ Str::limit(strip_tags($pending->body), 100) }}
                       {{-- @if(strlen($post->body) > 100)
                                <a href="{{ route('post.single.view', $post->id) }}"
                                   class="btn btn-info btn-sm">Read More</a>
                            @endif--}}
                        </td>
                        <td>{{ $pending->category->name }}</td>
                        <td>
                            <a title="approve post" onclick="return confirm('Are you sure to approve this post')" class="btn btn-sm btn-success" href="{{ route('post.approve', $pending->id) }}"><i class="fa fa-check"></i></a>
                            <a title="delete post"  onclick="return confirm('Are you sure to delete this post')"  class="btn btn-sm btn-danger" href="{{ route('post.delete', $pending->id) }}"><i class="fa fa-trash"></i></a>
                           {{-- <a class="btn btn-sm btn-primary" href="{{ route('post.single.view', $pending->id) }}">View</a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th width="10%">Writer Name</th>
                    <th width="15%">Title</th>
                    <th width="40%">Post Content</th>
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
