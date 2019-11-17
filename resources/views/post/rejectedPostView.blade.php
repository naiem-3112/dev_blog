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
                    <h1 class="mt-4">{{ $rejectView->title }}</h1>
                    <p class="lead">by {{ $rejectView->user->name }}</p>
                    <hr>
                    <p>Posted on {{ $rejectView->created_at->format('M j, Y') }}</p>
                    <hr>
                    <p class="lead">
                        {{ $rejectView->body }}
                    </p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
