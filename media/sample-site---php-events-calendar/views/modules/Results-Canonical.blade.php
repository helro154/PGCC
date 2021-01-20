{{--
 * Results - Canonical: Displays the prev, next and canonical link
--}}

{{--  Searching for the pagination array --}}
{{--  Note: Remember to update the domain URL --}}
@if(!empty($data['events']))
    @if(!empty($data['pagination']))
            @if(is_array($data['pagination']))
                @foreach ($data['pagination'] as $page)
                    @if ($page['text'] == "›" || $page['text'] == htmlentities ("›"))
                        <link rel="next" href="http://www.samplesite.it{{$data['all_event_url']}}{{$page['href']}}">
                    @elseif ($page['text'] == "‹" || $page['text'] == htmlentities("‹"))
                        <link rel="prev" href="http://www.samplesite.it{{$data['all_event_url']}}{{$page['href']}}">
                    @elseif ($page['text'] == $data['param_page'])
                        <link rel="canonical" href="http://www.samplesite.it{{$data['all_event_url']}}{{$page['href']}}">
                    @endif
                @endforeach
            @endif
    @else
        <link rel="canonical" href="http://www.samplesite.it{{$data['all_event_url']}}{{$data['canonical_params']}}">
    @endif
@else
        <link rel="canonical" href="http://www.samplesite.it{{$data['all_event_url']}}{{$data['canonical_params']}}">
@endif
