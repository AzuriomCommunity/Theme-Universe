<footer class="footer">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <a href="{{ route('home') }}">
                    <img src="{{ site_logo() }}" alt="" {{ site_name() }} class="img-fluid mb-3">
                </a>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="widget-title mb-3">
                    <h3>{{ trans('theme::universe.links') }}</h3>
                </div>

                <ul class="footer-links list-unstyled">
                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <li>
                            <a href="{{ $link['value'] }}">{{ $link['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="widget-title">
                    <h3 class="mb-2">{{ trans('theme::universe.socials') }}</h3>
                    <p>{{ trans('theme::universe.socials_info') }}</p>
                </div>

                <div class="footer-right">
                    @foreach(['twitter', 'youtube', 'discord', 'steam', 'teamspeak', 'instagram'] as $social)
                        @if($socialLink = theme_config("footer_social_{$social}"))
                            <a href="{{ $socialLink }}" target="_blank" rel="noreferrer noopener" class="btn btn-primary btn-block">
                                <i class="fab fa-{{ $social }}"></i>
                                {{ trans('theme::universe.social.'.$social) }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <p class="copyright mt-3 text-center">
            {{ setting('copyright') }} @lang('messages.copyright') @lang('theme::universe.copyright')
        </p>
    </div>
</footer>
