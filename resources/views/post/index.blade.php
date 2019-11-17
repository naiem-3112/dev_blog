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
            <a class="btn btn-primary" href="{{ route('post.create') }}">Add New Post</a>
            @if(Auth::user()->role->id == 2)
                <a class="btn btn-dark" href="{{ route('post.rejected') }}">Rejected Post</a>
            @endif
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
                @foreach($posts as $post)
                    @if(Auth::id()== 1 || Auth::id() == $post->user_id)
                        <tr>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                {{ Str::limit(strip_tags($post->body), 100) }}
                            </td>
                            <td>{{ $post->category->name }}</td>
                            @if(Auth::user()->role->id != 1 && $post->status == 0)
                                <td>
                                    <a title="pending post" class="btn btn-sm btn-info"><i class="fa fa-lock"></i></a>
                                    <a title="view post" class="btn btn-sm btn-primary" href="{{ route('post.authView', $post->id) }}"><i
                                            class="fa fa-eye"></i></a>

                                </td>
                            @elseif(Auth::user()->role->id ==1 && $post->status == 0)
                                <td>
                                    <a title="approve post" onclick="return confirm('Are you sure to approve this post')"
                                       class="btn btn-sm btn-success" href="{{ route('post.approve', $post->id) }}"><i
                                            class="fa fa-check"></i></a>
                                    <a title="delete post" onclick="return confirm('Are you sure to delete this post')"
                                       class="btn btn-sm btn-danger" href="{{ route('post.delete', $post->id) }}"><i
                                            class="fa fa-trash"></i></a>
                                    <a title="view post" class="btn btn-sm btn-primary" href="{{ route('post.authView', $post->id) }}"><i
                                            class="fa fa-eye"></i></a>
                                </td>
                            @elseif($post->status == 1)
                                <td>
                                    <a title="edit post" class="btn btn-sm btn-warning" href="{{ route('post.edit', $post->id) }}"><i
                                            class="fa fa-pencil"></i></a>
                                    <a title="delete post" onclick="return confirm('Are you sure to delete this post')"
                                       class="btn btn-sm btn-danger" href="{{ route('post.rejectedDelete', $post->id) }}"><i
                                            class="fa fa-trash"></i></a>
                                    <a title="view post" class="btn btn-sm btn-primary" href="{{ route('post.authView', $post->id) }}"><i
                                            class="fa fa-eye"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endif

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
