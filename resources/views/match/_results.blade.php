@if (empty($matches) || count($matches) == 0)
    <tr>
        <td colspan="7">@lang('messages.no-matches-found')</td>
    </tr>
@else
    @foreach($matches as $match)
        <tr>
            <td>{{ $loop->iteration + $offset }}</td>
            <td>
                {{ $match->date }}
            </td>
            <td>
                @if (!empty($match->tournament->bracket))
                    <a href="{{ $match->tournament->bracket }}" title="bracket"
                       target="_blank">{{ $match->tournament->short }}</a>
                @else
                    {{ $match->tournament->short }}
                @endif
                {{ (!empty($match->round) ? ' - ' . $match->round : '') }}
            </td>
            <td>
                @if ($match->opponent != null)
                    <span title="{{ $match->opponent->country_name }}"
                          class="flag-icon flag-icon-{{ strtolower($match->opponent->country) }}"></span> {{ $match->opponent->name }}
                @endif
            </td>
            <td align="center">{{ $match->games }}</td>
            <td align="center">
                {{ $match->for }} - {{ $match->against }}
            </td>
            <td align="center">
                @if (!empty($match->stream))
                    <?php $streams = explode(';', $match->stream) ?>
                    @if (count($streams) == 1)
                        <a href="{{ $match->stream }}" target="_blank">
                            <span class="fa fa-play-circle fa-lg"></span>
                        </a>
                    @else
                        <div class="dropdown" >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="fa fa-play-circle fa-lg"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu" style="min-width: 0;">
                                @foreach ($streams as $stream)
                                    <li class="pull-right">
                                        <a href="{{ $stream }}" target="_blank">Game {{$loop->index+1}} <span class="fa fa-play-circle"></span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
            </td>
        </tr>
    @endforeach
@endif
