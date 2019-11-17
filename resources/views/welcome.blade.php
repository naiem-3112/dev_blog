@extends('layouts.frontend.master')

@section('title', 'Welcome')

@push('css')

@endpush

@section('master.content')
    {{-- <style>

         .card-img-top {
             width: 100%;
             height: 10vw;
             object-fit: cover;
         }
     </style>
     <section class="blog-area section">
         <div class="container-fluid">
             <div class="row">
                 @foreach($posts as $post)
                     <div class="col-sm-12 col-lg-6">
                         <div class="card">
                            --}}{{-- <img class="card-img-top" src="{{ asset('assets/frontend/images/default2.png') }}" alt="user img">--}}{{--

                             <div class="card-body" style="background-color: #fff">
                                 <h4 class="card-header">{{ $post->title }}
                                     <br>{{ $post->user->name }} || {{ $post->created_at->format('M j, Y') }}</h4>

                                 <p class="card-text">
                                     {{ Str::limit(strip_tags($post->body), 150) }}
                                     @if (strlen(strip_tags($post->body)) > 150)
                                         ... <a href="{{ route('post.single.view', $post->id) }}" class="btn btn-info btn-sm">Read More</a>
                                     @endif
                                 </p>

                                 <div class="card-footer">
                                     <ul class="post-footer">
                                         <li><a href="" class="card-link"><i
                                                     class="ion-ios-chatbubble"></i><strong>{{ $post->comments()->get()->count() }}</strong></a></li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div><!-- row -->


         </div>
     </section>--}}
    <div class="row">
        <div class="col-lg-8">
            <!-- Title -->
            <h1 class="mt-4">Posts</h1>
            <hr>

            <!-- Post Content -->
            @foreach($posts as $post)
                <a style="color: #000" href="{{ route('post.single.view', $post->id) }}" class=""><h4 class="">{{ ucwords($post->title) }}</h4></a>
                <h6 style="color: #bdbdbd" class="float-right "><i class="fa fa-star"></i> ( {{$post->comments()->get()->count() }} )</h6>
                <p style="color: #6B6B6B"><b>{{ $post->user->name }} ||  {{ $post->created_at->format('M j, Y') }}</b></p>
           {{-- @if($post->created_at == $post->updated_at)
                    {{ $post->created_at->format('M j, Y') }}
                @else
                    {{ $post->updated_at->format('M j, Y') }}
                @endif--}}
                <p class="">
                    {{ Str::limit(strip_tags($post->body), 150) }}
                    @if (strlen(strip_tags($post->body)) > 150)
                        ... <a href="{{ route('post.single.view', $post->id) }}" class="">Read
                            More</a>
                    @endif
                </p>
            @endforeach
        </div>
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <form action="{{ route('search') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="searchData" placeholder="Search for...">
                            <span class="input-group-btn"><button class="btn btn-secondary" type="submit">Go!</button></span>
                        </div>
                        @if ($errors->has('searchData'))
                            <span style="color: red">{{ $errors->first('searchData') }}</span><br>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            @foreach($categories as $category)

                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="{{ route('post.sameCat', $category->id) }}">{{ $category->name }} </a>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $posts->links() }}
@endsection

@push('js')

@endpush
