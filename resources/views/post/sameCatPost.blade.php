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
            <!-- Post Content -->
            @if($sameCatPost->count() > 0)
            @foreach($sameCatPost as $sameCat)
                <hr>
                <a style="color: #000" href="{{ route('post.single.view', $sameCat->id) }}"><h4>{{ ucwords($sameCat->title) }}</h4></a>
                {{ $sameCat->user->name }} || {{ $sameCat->created_at->format('M j, Y') }}
                <p class="">
                    {{ Str::limit(strip_tags($sameCat->body), 150) }}
                    @if (strlen(strip_tags($sameCat->body)) > 150)
                        ... <a href="{{ route('post.single.view', $sameCat->id) }}">Read
                            More</a>
                    @endif
                </p>
            @endforeach
                @else
                <h2 style="color: #bdbdbd; text-align: center">***<b>This category has no post</b>*** </h2>
                @endif
        </div>

        <div class="col-md-4">
            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <form action="{{ url('search') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="searchData" placeholder="Search for...">
                            <span class="input-group-btn"><button class="btn btn-secondary" type="submit">Go!</button></span>
                        </div>
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
                                        <a href="{{ route('post.sameCat', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Widget -->

        </div>
    </div>
@endsection

@push('js')

@endpush
