<?php
use Carbon\Carbon as Carbon;
use Calendar\Core\Config as Config;

$prev_check = true;
$next_check = true;
if(preg_match("/custom-(.+)(day|days|week|weeks|month|months|year|years)$/iU", $data['param_search']) && (!empty($data['searched_period']['startdate']) && !empty($data['searched _period']['enddate']))) {
    $searched_startdate = Carbon::createFromFormat(Config::get('default_date_format'), $data['searched_period']['startdate'])->timezone(Config::get('timezone'));
    $searched_enddate = Carbon::createFromFormat(Config::get('default_date_format'), $data['searched_period']['enddate'])->timezone(Config::get('timezone'));
    $prev_check = (!empty($data['previous_month_link']) ? $searched_startdate->diffInSeconds($data['previous_month_link']['date'],false) >= 0 : true);
    $next_check = (!empty($data['next_month_link']) ? $data['next_month_link']['date']->diffInSeconds($searched_enddate,false) >= 0 : true);
}

?>

<div class="pcb-large-cal ajax-load-area" id="calendar_page" data-ajaxloadalso='["calendar_box", "view-switchers","hidden_form","jumpto_hidden_form","past_events"]""'>
    <table class="cal-table">
        <thead>
            <tr class="calendar-box-header ajax-load-link"  id="cal_headers">
                <th id="event_cal_previous_month">
                    @if(!empty($data['previous_month_link']) && $prev_check)
                    <a href="{{ $data['previous_month_link']['href'] }}" ><span class="fa fa-chevron-left"></span><span class="wai hidden">Prev</span></a>
                    @endif
                </th>
                <th id="event_cal_current_month" colspan="5">{{ $data['calendar']['heading'] }}</th>
                <th id="event_cal_next_month">
                    @if(!empty($data['next_month_link']) && $next_check)
                    <a href="{{ $data['next_month_link']['href'] }}" ><span class="wai hidden">Next</span><span class="fa fa-chevron-right"></span></a>
                    @endif
                </th>
            </tr>
            <tr class="calendar-dayhead"  id="cal_week_days">
                <?php $week = 1; ?>
                @foreach ($data['day_headings'] as $heading)
                    <th id="weekday_{{ $week }}"><span>{{ $heading }}</span></th>
                <?php $week++; ?>
                @endforeach
            </tr>
        </thead>


        <tbody>
       <?php $dd=0; ?>
@foreach ($data['dates'] as $row_dates)
            <tr class="calendar-dayrow">
                @foreach($row_dates as $date_data)
                    <td class="{{{ $date_data['class'] }}}">
                        @if((!isset($date_data['searched_href'])) || $date_data['searched_href'] == false)
                            <span>{{ $date_data['date'] }}</span>
                        @else
                            <a href="{{$data['all_event_url']}}{{ $date_data['searched_href'] }}" class="hasEvents"><span>{{{ $date_data['date'] }}}</span></a>
                                <?php $i = -1; ?>
                                @foreach($date_data["searched"] as $event)
                                    <?php
                                        $i++;
                                        if ($i>3) {
                                            continue;
                                        }
                                        if ($i==3) {
                                            ?>
                                            <a href="{{$data['all_event_url']}}{{ $date_data['searched_href'] }}" class="hasMoreEvents"><span>...</span></a>
                                            <?php
                                            continue;
                                        }
                                        $start_date = Carbon::createFromFormat(Config::get('default_date_format'), $event['startdate'])->timezone(Config::get('timezone'));
                                        $end_date = Carbon::createFromFormat(Config::get('default_date_format'), $event['enddate'])->timezone(Config::get('timezone'));
                                         ?>
                                    <div class="event" id="pcb-calevent-{{$event["content_id"]}}">
                                        @if (isset($event["url"]) && !empty($event["url"]))
                                            <a href="{{ $event['url'] }}{{ ($event['event_type'] != 'origin') ? '?event_type='.$event['event_type'] : '' }}" title="{{$event["name"]}}" data-tooltipcal="pcb-tooltip-{{ $date_data['date'] }}-{{$event["content_id"]}}">
                                        @else
                                            <a href="?event={{urlencode($event['name'])}}&event_id={{$event['content_id']}}" title="{{$event["name"]}}" data-tooltip="pcb-tooltip-{{ $date_data['date'] }}-{{$event["content_id"]}}">
                                        @endif
                                        {{$start_date->format('H:i')}} {{$event["name"]}}
                                        @if (isset($event["url"]) && !empty($event["url"]))
                                            </a>
                                        @else
                                            </a>
                                        @endif
                                    </div>
                                    <div class="tooltip-info" id="pcb-tooltip-{{ $date_data['date'] }}-{{$event["content_id"]}}">
                                        @if (isset($event["tooltipHTML"]) && !empty($event["tooltipHTML"]))
                                            {{$event["tooltipHTML"]}}
                                        @else
                                            <h2>{{$event["name"]}}</h2>
                                            <div class="info">
                                                <p><strong>Start time</strong>: {{$start_date->format('d/M/Y H:i')}}</p>
                                                <p><strong>End time</strong>: {{$end_date->format('d/M/Y H:i')}}</p>

                                                @if (isset($event["location"]) && !empty($event["location"]))
                                                    <p><strong>Venue</strong>: {{ $event['location'] }}</p>
                                                @endif
                                            </div>
                                            <div class="short-desc">
                                                {{$event['short_desc']}}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
