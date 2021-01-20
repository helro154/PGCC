<div id="results_next">
<h3>Next {{ $data['result_set_params']['custom_heading'] }} Box</h3>

<ul class="event" id="event-list-">
@foreach ($data['events'] as $id => $ids)
    @foreach ($ids as $id => $event)

        @if(!empty($event))

            @if(isset($event['listingHTML']))
                {{$event['listingHTML']}}
            @else
                <li class="event" id="event-list-{{$id}} event-id-{{$event['content_id']}}">
                    <div class="eventtitle"><h4>

                            <a href="{{ (isset($event['url'])) ? $event['url'] : '?' }}{{ ($event['event_type'] != 'origin') ? 'event_type='.$event['event_type'] : '' }}{{ (!isset($event['url'])) ? 'event_id='.$event['event_id'] : '' }}">{{ $event['name'] }}</a>

                        </h4></div>
                    <div class="date2">
                        <div class="eventdate2">
                            <a href="{{ $data['module']::getDayLink($event['multi_dates'][$event['event_type']]['startdate']) }}">
                              	{{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'D d F, Y') }}
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



