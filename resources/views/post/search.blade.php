@extends('layouts.frontend.master')

@section('title', 'Post')

@section('master.content')
    <section class="blog-area section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Title -->
                    @if($datas->count() > 0)
                    <h1 class="mt-4">Searching Posts</h1>
                    <hr>
                    <!-- Post Content -->

                    @foreach($datas as $data)

                        <a style="color: #000" href="{{ route('post.single.view', $data->id) }}"><h4 class="">{{ ucwords($data->title) }}</h4></a>
                            <p style="color: #6B6B6B"><b>{{ $data->user->name }} || {{ $data->created_at->format('M j, Y') }}</b></p>
                        <p class="">
                            {{ Str::limit(strip_tags($data->body), 150) }}
                            @if (strlen(strip_tags($data->body)) > 150)
                                ... <a href="{{ route('post.single.view', $data->id) }}">Read
                                    More</a>
                            @endif
                        </p>
                    @endforeach
                        @else
                        <div class="card offset-3" style="margin-top: 30%">
                            <div  class="card-header">
                               <h2 style=" color: red">no search related data found</h2>  <a class="btn btn-info" href="{{ route('fronthome') }}">Back</a>
                            </div>
                        </div>
                        @endif

                </div>
            </div><!-- row -->
        </div>
    </section>
@endsection

