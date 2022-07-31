@extends('layouts.base')

@section('title', trans('messages.home'))

@section('app')
    <header style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') center / cover no-repeat">
        <div class="container text-center py-5">
            <div class="row gy-3 align-items-center justify-content-center">
                <div class="col-md-6">
                    <h1 class="mb-0 text-uppercase">{{ theme_config('title') }}</h1>

                    <h2 class="text-uppercase">{{ theme_config('subtitle') }}</h2>

                    <p>{{ theme_config('description') }}</p>

                    @auth
                        <a class="btn btn-success home-btn" href="{{ route('profile.index') }}">
                            {{ trans('messages.nav.profile') }}
                        </a>
                    @else
                        <a class="btn btn-success home-btn" href="{{ route('login') }}">
                            {{ trans('auth.login') }}
                        </a>

                        @if(Route::has('register'))
                            <a class="btn btn-danger home-btn" href="{{ route('register') }}">
                                {{ trans('auth.register') }}
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="offset-md-2  offset-lg-3 col-lg-3 col-md-4">
                    <img src="{{ site_logo() }}" alt="{{ site_name() }}" class="img-fluid mt-0 mt-md-4">
                </div>
            </div>
        </div>
    </header>

    <div class="content container text-center">
        @include('elements.session-alerts')

        @if($message)
            <div class="card mb-5">
                <div class="card-body">
                    {{ $message }}
                </div>
            </div>
        @endif

        @if(! $servers->isEmpty())
            <h3 class="text-uppercase">{{ trans('messages.servers') }}</h3>

            <hr>

            <div class="row gy-3 justify-content-center mb-5">
                @foreach($servers as $server)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h3 class="card-title">
                                    {{ $server->name }}
                                </h3>

                                @if($server->isOnline())
                                    <div class="progress mb-1">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $server->getPlayersPercents() }}%">
                                        </div>
                                    </div>

                                    <p class="mb-1">
                                        {{ trans_choice('messages.server.total', $server->getOnlinePlayers(), [
                                            'max' => $server->getMaxPlayers(),
                                        ]) }}
                                    </p>
                                @else
                                    <p>
                                        <span class="badge bg-danger text-white">
                                            {{ trans('messages.server.offline') }}
                                        </span>
                                    </p>
                                @endif

                                @if($server->joinUrl())
                                    <a href="{{ $server->joinUrl() }}" class="btn btn-primary">
                                        {{ trans('messages.server.join') }}
                                    </a>
                                @else
                                    <p class="card-text">{{ $server->fullAddress() }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <h3 class="text-uppercase">{{ trans('theme::universe.news') }}</h3>

        <hr>

        <div class="row gy-3">
            @foreach($posts as $post)
                <div class="col-md-4">
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
@endsection
