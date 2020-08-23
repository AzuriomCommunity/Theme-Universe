@extends('layouts.app')

@section('title', trans('messages.home'))

@section('content')
    <header style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') center / cover no-repeat">
        <div class="container text-center py-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <h1 class="mb-0 text-uppercase">{{ theme_config('title') }}</h1>

                    <h2 class="text-uppercase">{{ theme_config('subtitle') }}</h2>

                    <p>{{ theme_config('description') }}</p>

                    @auth
                        <a class="btn btn-success home-btn" href="{{ route('profile.index') }}">{{ trans('messages.nav.profile') }}</a>
                    @else
                        <a class="btn btn-success home-btn" href="{{ route('login') }}">{{ trans('auth.login') }}</a>

                        @if(Route::has('register'))
                            <a class="btn btn-danger home-btn" href="{{ route('register') }}">{{ trans('auth.register') }}</a>
                        @endif
                    @endauth
                </div>

                <div class="offset-md-1 col-md-5">
                    <img src="{{ site_logo() }}" alt="{{ site_name() }}" class="img-fluid mt-0 mt-md-4">
                </div>
            </div>
        </div>
    </header>

    <div class="content">
        <div class="container text-center">
            <h3 class="text-uppercase">{{ trans('theme::universe.news') }}</h3>

            <hr>

            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('posts.show', $post) }}" class="text-white">
                            @if($post->hasImage())
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="img-fluid">
                            @endif

                            <div class="text-uppercase py-2" style="background: #272333">
                                <h3 class="mb-0">{{ $post->title }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
