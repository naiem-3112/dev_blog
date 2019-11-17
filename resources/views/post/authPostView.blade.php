@extends('layouts.backend.master')
@section('base.title', 'AdminPostView')
@section('master.content')

    <div class="row">
        <div class="offset-md-2">


            <div class="col-lg-8">
                <hr>
                <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">

                <!-- Post Content Column -->
                <div class="col-lg-12">
                    <h1 class="mt-4">{{ $post->title }}</h1>
                    <p class="lead">by {{ $post->user->name }}</p>
                    <hr>
                    <p>Posted on {{ $post->created_at->format('M j, Y') }}</p>
                    <hr>
                    <p class="lead">
                        {{ $post->body }}
                    </p>
                    <hr>

                    <!-- Comments Form -->
                    @if($post->status == 1)
                        <div class="card my-4">
                            <h5 class="card-header">Leave a Comment:</h5>
                            <div class="card-body">
                                <form action="{{ route('post.comment', $post->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" name="comment"></textarea>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    @if($post->comments()->get()->count() > 0)
                    <!-- Single Comment -->
                        <h3 class="mt-0"> All Comments </h3>
                        @foreach($post->comments()->get() as $comment)
                            <div class="media mb-4">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                <div class="media-body">
                                    {{ $comment->comment }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @if(Auth::id() == 1 && $post->status == 0)
                <a class="btn btn-sm btn-warning" href="{{ route('post.approve', $post->id) }}">Approve</a>
            @endif
        </div>
    </div>
@endsection
