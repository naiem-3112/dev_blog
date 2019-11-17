@extends('layouts.backend.master')

@section('base.title', 'Post')

@push('base.css')

@endpush

@section('master.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">ADD NEW CATEGORY</h3>
                        </div>
                        <form action="{{ route('admin.category.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tagName">Category Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="category name ">
                                    @if ($errors->has('name'))
                                        <span style="color: red">{{ $errors->first('name') }}</span><br>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-danger">BACK</a>
                                <button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection

@push('base.js')

@endpush
