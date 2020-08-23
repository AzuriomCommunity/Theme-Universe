@extends('layouts.app')

@section('title', trans('shop::messages.title'))

@push('footer-scripts')
    <script>
        document.querySelectorAll('[data-package-url]').forEach(function (el) {
            el.addEventListener('click', function (ev) {
                ev.preventDefault();
                axios.get(el.dataset['packageUrl'], {
                    headers: {
                        'X-PJAX': 'true'
                    }
                }).then(function (response) {
                    $('#itemModal').html(response.data).modal('show');
                }).catch(function (error) {
                    createAlert('danger', error, true);
                });
            });
        });
    </script>
@endpush

@section('content')
    <div class="jumbotron" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') center / cover no-repeat">
        <div class="container text-center">
            <h1>{{ site_name() }}</h1>
            <h2 class="h4">{{ trans('shop::messages.title') }}</h2>
        </div>
    </div>

    <div class="container content text-center">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="list-group mb-3">
                    @foreach($categories as $subCategory)
                        <a href="{{ route('shop.categories.show', $subCategory) }}" class="list-group-item @if($category->is($subCategory)) active @endif">{{ $subCategory->name }}</a>
                    @endforeach
                </div>

                @if($goal !== false)
                    <div class="mb-3">
                        <h4>{{ trans('shop::messages.month-goal') }}</h4>

                        <div class="progress mb-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $goal }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $goal }}%"></div>
                        </div>

                        <p class="text-center">{{ trans_choice('shop::messages.month-goal-current', $goal) }}</p>
                    </div>
                @endif

                @if(request()->secure())
                    <p class="text-center text-success">
                        <i class="fa fa-lock"></i> Cette page est sécurisée.
                    </p>
                @endif
            </div>

            <div class="col-md-8">
                <div class="p-4" style="background: #272333">
                    @guest
                        <h3>{{ trans('messages.welcome', ['name' => site_name()]) }}</h3>

                        <a class="btn btn-success home-btn" href="{{ route('login') }}">{{ trans('auth.login') }}</a>

                        @if(Route::has('register'))
                            <a class="btn btn-danger home-btn" href="{{ route('register') }}">{{ trans('auth.register') }}</a>
                        @endif
                    @else
                        <img src="{{ auth()->user()->getAvatar() }}" alt="{{ auth()->user()->name }}" class="rounded-circle mb-3" width="100">

                        <h3 class="mb-3">{{ auth()->user()->name }}</h3>

                        <a href="{{ route('shop.offers.select') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> {{ trans('shop::messages.cart.credit') }}
                        </a>
                    @endguest
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($category->packages as $package)
                <div class="col-md-4 shop-item mb-3">
                    <div class="shop-item-title py-2">
                        <h3 class="h4">{{ $package->name }}</h3>

                        <h5 class="mb-0">
                            @if($package->isDiscounted())
                                <del class="small">{{ $package->getOriginalPrice() }}</del>
                            @endif
                            {{ shop_format_amount($package->getPrice()) }}
                        </h5>
                    </div>

                    @if($package->image !== null)
                        <div class="shop-item-image px-2 py-3">
                            <img class="img-fluid" src="{{ $package->imageUrl() }}" alt="{{ $package->name }}">
                        </div>
                    @endif

                    <a href="#" class="btn shop-buy-btn" data-package-url="{{ route('shop.packages.show', $package) }}">
                        {{ trans('shop::messages.buy') }}
                    </a>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-warning" role="alert">
                        {{ trans('shop::messages.categories.empty') }}
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true"></div>
@endsection
