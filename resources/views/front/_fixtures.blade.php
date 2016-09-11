@if (empty($matches) || count($matches) == 0)
    <tr><td colspan="6">@lang('contents.no-matches-found')</td></tr>
@else
    @foreach($matches as $match)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $match->date }}</td>
            <td>{{ $match->tournament->short }}</td>
            <td>@if ($match->opponent != null) {{ $match->opponent->name }}@endif</td>
            <td align="center">{{ $match->games }}</td>
            <td align="center">
                @if ($match->over) {{-- Recent --}}
                {{ $match->for }} - {{ $match->against }}
                @elseif ($match->is_past) {{-- Live --}}
                {{ $match->for }} - {{ $match->against }}
                @else {{-- Upcoming --}}
                @lang('contents.at') {{ $match->time }}
                @endif
            </td>
        </tr>
    @endforeach
@endif