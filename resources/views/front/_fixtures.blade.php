@if (empty($matches) || count($matches) == 0)
    <tr>
        <td colspan="7">@lang('messages.no-matches-found')</td>
    </tr>
@else
    @foreach($matches as $match)
        <tr>
            <td>{{ $loop->iteration }}</td>
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
                @if ($match->over) {{-- Recent --}}
                {{ $match->for }} - {{ $match->against }}
                @elseif ($match->is_past) {{-- Live --}}
                {{ $match->for }} - {{ $match->against }}
                @else {{-- Upcoming --}}
                @lang('messages.at') {{ $match->time }}
                @endif
            </td>
            <td align="center">
                @if ($match->over) {{-- Recent --}}
                @if (!empty($match->stream))
                    <a href="{{ $match->stream }}" target="_blank">
                        <span class="fa fa-play fa-lg"></span>
                    </a>
                @endif
                @else {{-- Live & upcoming --}}
                @if (!empty($match->stream))
                    <a href="{{ $match->stream }}" target="_blank">
                        <span class="fa fa-play-circle fa-lg"></span>
                    </a>
                @endif
                @endif
            </td>
        </tr>
    @endforeach
@endif