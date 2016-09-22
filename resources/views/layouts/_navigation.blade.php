<ul class="nav navbar-nav navbar-left">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">
            <img src="{!! URL::asset('images/Dota2.png') !!}"
                 style="height: 20px; vertical-align: middle"><span> @lang('pages.dota2')</span>
            <span class="caret"></span></a>
        <ul class="dropdown-menu" aria-labelledby="themes">
            <li>
                <a href="{!! \URL::route('dota2.fixture.index') !!}">
                    <i class="fa fa-calendar fa-fw" aria-hidden="true"></i> @lang('pages.fixtures')</a>
            </li>
            <li>
                <a href="{!! URL::route('dota2.fixture.results') !!}">
                    <i class="fa fa-list-ol fa-fw" aria-hidden="true"></i> @lang('pages.results')</a>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i class="fa fa-trophy fa-fw" aria-hidden="true"></i> @lang('pages.achievements')</a>
                </a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">
            <img src="{!! URL::asset('images/league.png') !!}"
                 style="height: 20px; vertical-align: middle"><span> @lang('pages.league_of_legends')</span>
            <span class="caret"></span></a>
        <ul class="dropdown-menu" aria-labelledby="themes">
            <li>
                <a href="#">
                    <i class="fa fa-ellipsis-h fa-fw" aria-hidden="true"></i> Coming soon</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
            <i class="fa fa-video-camera fa-fw"></i> <span>@lang('pages.streaming')</span>
            <span class="caret"></span></a>
        <ul class="dropdown-menu" aria-labelledby="themes">
            <li>
                <a href="https://gaming.youtube.com/c/NextGenDOTA2VN" target="_blank">
                    <i class="fa fa-youtube-play fa-fw"
                       aria-hidden="true"></i> @lang('pages.dota2_stream')</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
            <i class="fa fa-heart-o fa-fw"></i> <span>@lang('pages.support_us')</span>
            <span class="caret"></span></a>
        <ul class="dropdown-menu" aria-labelledby="themes">
            <li>
                <a href="{!! route('pages.community_club') !!}">
                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Next Gen Community Club</a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i class="fa fa-money" aria-hidden="true"></i> Donation</a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i> Buy gifts</a>
            </li>
        </ul>
    </li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li>
        <select class="selectpicker" data-width="fit">
            @foreach (config('settings.locales') as $locale=>$details)
                <option data-content='<span class="flag-icon flag-icon-{{ $details['icon'] }}"></span> {{ $details['title'] }}'
                        value="{{ $locale }}"></option>
            @endforeach
        </select>
    </li>
</ul>
