{{--
 * Results - OnlyList: Displays the list of the events, paginated and already ordered.
--}}

<div class="ajax-load-area" id="calendar_events" data-ajaxloadalso='["calendar_events", "calendar_box", "view-switchers"]'>
    <div class="section no-tp">

    {{--  Loop of events of the page the array is divided by single days --}}
    @foreach ($data['events'] as $date => $ids)

        {{--  Day events Title  --}}
        @if($data['result_set_params']['searching'] !== 'day' && ($data['module']::getConfig('view_for_date_recur') == true || $data['module']::getConfig('view_for_date_multi') ==  true))
            <h2 class="eventdate">
                <a href="{{ $data['module']::getDayLink($date,'d/m/Y') }}">
                    {{ $data['module']::getDate($date,'D d F, Y','d/m/Y') }}
                </a>
            </h2>
        @endif

        {{--  Loop for all event of the speicific day  --}}
        @foreach ($ids as $id => $event)

            {{--  Display single event information  --}}
            @if(!empty($event))
            {{-- to view all variable of $event {{ var_dump("event", $event) }} --}}
                @if(!empty($event['resultHTMLbefore']) && !empty($event['resultHTMLafter']))
                        {{$event['resultHTMLbefore']}}
                        {{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'d/m/Y H:i') }} -
                        {{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['enddate'],'d/m/Y H:i') }}
                        {{$event['resultHTMLafter']}}
                @else
                    <div class="event period-nostrict-{{urlencode($event['nostrict_period_type'])}}" id="event-list-{{ $data['module']::getDate($date,'Y-m-d','d/m/Y') }}-{{$id}}" data-contentid="{{$event['content_id']}}" data-eventtype="{{$event['event_type']}}">
                        <div class="eventtitle"><h3>
                                <a href="{{ isset($event['url']) ? $event['url'] : '?event_id='.$event['content_id'] }}{{ ($event['event_type'] != 'origin') ? (isset($event['url']) ? '?' : '&').'event_type='.$event['event_type'] : '' }}">{{ $event['name'] }}</a>

                            </h3>
                        </div>
                        <div class="description">
                            {{$event['short_desc']}}
                        </div>
                        <div class="eventinfo clearfix">

                            <dl>
                                <dt>
                                    Event Time
                                </dt>
                                <dd>
                                    {{--  Notes: the event_type shows if it is the original event or one of the recurring event --}}
                                    @if (empty($event['all_day']))
                                      {{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'H:i') }} -
                                      {{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['enddate'],'H:i') }}
                                    @else
                                       All Day
                                    @endif
                                </dd>
                            </dl>

                            <dl>
                                <dt>
                                    Venue
                                </dt>
                                <dd>

                                </dd>
                            </dl>

                            <dl>
                                <dt>
                                    Category
                                </dt>
                                <dd>
                                    {{ implode($event['categories'], ', ') }}
                                </dd>
                            </dl>

                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @endforeach

    {{--  Displays the pagination  --}}
    @if(!empty($data['events']))
        @if(!empty($data['pagination']))

                @if(is_array($data['pagination']))
                    <ul class="pagination ajax-load-link">
                    @foreach ($data['pagination'] as $page)
                        @if ($page['text'] == "<<")
                            <li><a href="{{$page['href']}}" class="first" title="First Page">{{$page['text']}}</a></li>
                        @elseif ($page['text'] == ">>")
                            <li><a href="{{$page['href']}}" class="last" title="Last Page">{{$page['text'] }}</a></li>
                        @elseif ($page['text'] == "<")
                            <li><a href="{{$page['href']}}" class="prev" title="Previous Page">{{$page['text']}}</a></li>
                        @elseif ($page['text'] == ">")
                            <li><a href="{{$page['href']}}" class="next" title="Next Page">{{$page['text'] }}</a></li>
                        @else
                            <li><a href="{{$page['href']}}" class="page" title="Page {{$page['text'] }}">{{$page['text'] }}</a></li>
                        @endif
                    @endforeach
                    </ul>
                @else
                    <div class="pagination">
                        {{ $data['pagination'] }}
                    </div>
                @endif

        @endif
    @endif

    {{--  Message if no events was found  --}}
    @if(empty($data['events']))
        <div class="no-found">
            <p>There are currently no events for this period.</p>
        </div>
    @endif
    </div>
</div>
