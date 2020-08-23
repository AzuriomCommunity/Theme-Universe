@extends('layouts.app')

@section('title', trans('messages.profile.title'))

@section('content')
    <div class="container content">
        <div class="row">
            <div class="col-md-3 text-center pt-md-5">
                <h1>{{ $user->name }}</h1>
                <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}" height="100px" class="rounded-circle mb-3">

                <ul class="list-group mb-3">
                    <li class="list-group-item">
                        {{ trans('messages.profile.info.role', ['role' => $user->role->name]) }}
                    </li>
                    <li class="list-group-item ">
                        {{ trans('messages.profile.info.register', ['date' => format_date($user->created_at, true)]) }}
                    </li>
                    <li class="list-group-item">
                        {{ trans('messages.profile.info.money', ['money' => format_money($user->money)]) }}
                    </li>
                    <li class="list-group-item">
                        {{ trans('messages.profile.info.2fa', ['2fa' => trans_bool($user->hasTwoFactorAuth())]) }}
                    </li>
                </ul>

                @if($user->hasTwoFactorAuth())
                    <form action="{{ route('profile.2fa.disable') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-danger">
                            {{ trans('messages.profile.2fa.disable') }}
                        </button>
                    </form>
                @else
                    <a class="btn btn-primary" href="{{ route('profile.2fa.index') }}">
                        {{ trans('messages.profile.2fa.enable') }}
                    </a>
                @endif
            </div>

            <div class="col-md-9 text-center">
                <img src="{{ site_logo() }}" alt="{{ site_name() }}" class="img-circle mb-4" height="125">

                <div class="card mb-4">
                    <div class="card-header">{{ trans('messages.profile.change-password') }}</div>
                    <div class="card-body">
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="passwordConfirmPassInput">{{ trans('auth.current-password') }}</label>
                                <input type="password" class="form-control @error('password_confirm_pass') is-invalid @enderror" id="passwordConfirmPassInput" name="password_confirm_pass" required>

                                @error('password_confirm_pass')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="passwordInput">{{ trans('auth.password') }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" name="password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="confirmPasswordInput">{{ trans('auth.confirm-password') }}</label>
                                <input type="password" class="form-control" id="confirmPasswordInput" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ trans('messages.actions.update') }}
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header">{{ trans('messages.profile.change-email') }}</div>
                    <div class="card-body">
                        <form action="{{ route('profile.email') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="emailInput">{{ trans('auth.email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" name="email" value="{{ old('email', $user->email) }}" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="emailConfirmPassInput">{{ trans('auth.current-password') }}</label>
                                <input type="password" class="form-control @error('email_confirm_pass') is-invalid @enderror" id="emailConfirmPassInput" name="email_confirm_pass" required>

                                @error('email_confirm_pass')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ trans('messages.actions.update') }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
