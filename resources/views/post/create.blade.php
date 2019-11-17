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
    {{-- @if ($errors->any())
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>
                         {{ $error }}
                     </li>
                 @endforeach
             </ul>

     @endif--}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">ADD NEW POST</h3>
                        </div>
                        <form action="{{ route('post.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tagName">Post Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Post title ">
                                    @if ($errors->has('title'))
                                        <span style="color: red">{{ $errors->first('title') }}</span><br>
                                    @endif

                                    <label for="tagName">Post Body</label>
                                    <textarea class="form-control" name="body" placeholder="Post Body"></textarea>
                                    @if ($errors->has('body'))
                                        <span style="color: red">{{ $errors->first('body') }}</span><br>
                                    @endif
                                    <label for="tagName">Post Category</label>
                                    <select class="form-control" name="category_id" id="">
                                        <option disabled selected>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span style="color: red">{{ $errors->first('category_id') }}</span><br>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('post.index') }}" class="btn btn-sm btn-danger">BACK</a>
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
