<div id="results_next">
<h3>Next {{ $data['result_set_params']['custom_heading'] }} Box</h3>

<ul class="event" id="event-list-">
@foreach ($data['events'] as $id => $ids)
    @foreach ($ids as $event)

        @if(!empty($event))

            @if(isset($event['listingHTML']))
                {{$event['listingHTML']}}
            @else
                <li class="event" id="event-list-{{$id}}-event-id-{{$event['content_id']}}" data-contentid="{{$event['content_id']}}" data-eventtype="{{$event['event_type']}}">
                    <div class="eventtitle"><h4>

                            <a href="{{ (isset($event['url'])) ? $event['url'] : '?' }}{{ ($event['event_type'] != 'origin') ? 'event_type='.$event['event_type'] : '' }}{{ (!isset($event['url'])) ? 'event_id='.$event['event_id'] : '' }}">{{ $event['name'] }}</a>

                        </h4></div>
                    <div class="date">
                        <div class="event-date">
                            <a href="{{ $data['module']::getDayLink($event['startdate']) }}">
                                {{ $data['module']::getDate($event['startdate'],'D d F, Y') }}
                            </a>
                        </div>
                    </div>

                </li>
            @endif
        @endif
    @endforeach
@endforeach
</ul>

@if(empty($data['events']))
    <div class="no-found">
        <p>There are currently no events for this period.</p>
    </div>
@endif
</div>

