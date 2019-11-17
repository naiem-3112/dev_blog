@extends('layouts.frontend.master')

@section('title', 'Post')

@section('master.content')
    {{--<section class="blog-area section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header" style="background-color: lightgoldenrodyellow">
                            <h4>{{ $post->title }}
                                <br>{{ $post->user->name }} || {{ $post->created_at->format('M j, Y') }}</h4>
                        </div>
                        <div class="card-body" style="background-color: darkkhaki">
                            <p class="card-text">{{ $post->body }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">

                        <div class="card-body">
                            <form action="{{ route('post.comment', $post->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="comment" placeholder="leave a Comment here"></textarea>

                                    <button class="btn btn-primary form-control" type="submit">Post Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
   --}}{{-- <style>
        .card-img-top {
            width: 100%;
            height: 10vw;
            object-fit: cover;
        }
    </style>--}}{{--
    <section class="blog-area section">
        <div class="container-fluid">
            <div class="row">
                @foreach($sameCats as $cat)
                    @if($post->id != $cat->id)
                        <div class="col-sm-12 col-lg-6">
                            <div class="card">
                                --}}{{--<img class="card-img-top" src="{{ asset('assets/frontend/images/default2.png') }}"
                                     alt="user img">--}}{{--

                                <div class="card-body" style="background-color: #fff">

                                    <h4 class="card-header">{{ $cat->title }}</h4>
                                        <p class="card-text">
                                            {{ Str::limit(strip_tags($cat->body), 150) }}
                                            @if (strlen(strip_tags($cat->body)) > 150)
                                                ... <a href="{{ route('post.single.view', $cat->id) }}"
                                                       class="btn btn-info btn-sm">Read More</a>
                                            @endif
                                        </p>

                                        <div class="card-footer">
                                            <ul class="post-footer">
                                                <li><a href="" class="card-link"><i
                                                            class="ion-ios-chatbubble"></i><strong></strong></a></li>
                                            </ul>
                                        </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div><!-- row -->


        </div>
    </section>--}}
    <hr>
    <a class="btn btn-info" href="{{ route('fronthome') }}">Back</a>

    <div class="row">
        <div class="col-lg-8">
            <hr>
            <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">

            <!-- Post Content Column -->
            <div class="col-lg-12">
                <h1 class="mt-4">{{ ucwords($post->title) }}</h1>
                <p class="lead">by {{ $post->user->name }}</p>
                <hr>
                <p >Posted on {{ $post->created_at->format('M j, Y') }}</p>
                <hr>
                <p class="lead">
                    {{ $post->body }}
                </p>
                <hr>

                <!-- Comments Form -->
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form action="{{ route('post.comment', $post->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="comment"></textarea>
                                @if ($errors->has('comment'))
                                    <span style="color: red">{{ $errors->first('comment') }}</span><br>
                                @endif
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>

                <!-- Single Comment -->
                @if($post->comments()->get()->count() > 0)
                    <h3 class="mt-0"> All Comments </h3>

                    @foreach($post->comments()->get() as $comment)
                        <div class="media mb-4">
                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                            <div class="media-body">
                                {{ $comment->comment }} <p style="float: right; color: #bdbdbd"><i class="fa fa-calendar"></i>{{ $comment->created_at->format('M j, Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{--   Related Post--}}

            <div class="col-md-4">
                <div class="card my-4">
                    <h5 class="card-header">Related Posts</h5>
                    <div class="card-body">
                        @if($sameCats->count() == 0)
                            <h2 style="color: #bdbdbd; text-align: center">No related post</h2>
                            @endif
                        <div class="col-lg-12">
                            @foreach($sameCats as $cat)
                               {{-- @if($post->id != $cat->id)--}}
                                    <a style="color: #000" href="{{ route('post.single.view', $cat->id) }}">
                                        <h4>{{ ucwords($cat->title) }}</h4></a>
                                    <p style="color: #6B6B6B"><b>{{ $post->user->name }} || {{ $post->created_at->format('M j, Y') }}</b></p>
                                    <p class="">
                                        {{ Str::limit(strip_tags($cat->body), 50) }}
                                        @if (strlen(strip_tags($cat->body)) > 50)
                                            ... <a href="{{ route('post.single.view', $cat->id) }}">Read More</a>
                                        @endif
                                    </p>
                               {{-- @endif--}}
                            @endforeach
                        </div>
                        {{ $sameCats->links() }}
                    </div>
                </div>
            </div>
    </div>


@endsection


