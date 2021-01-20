<?php
/*
 * Download - Ical: Ical version of the event - NO Recurring events are included
 */
/* PLEASE ENSURE TO NOT INDENT THIS FILE. INDENTION CAUSES AN INVALID ICAL FILE */

if(!headers_sent()) {
    header('Content-type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$data['module']::getConfig('calendar_title').'.ics');
}
// if it is just a single element or multiple one
if(!$data['single']) :
?>
BEGIN:VCALENDAR
VERSION:2.0
X-WR-CALNAME:{{ $data['module']::getConfig('calendar_title') }}
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
@if (!empty($data['events']))
@foreach ($data['events'] as $date => $ids)
@foreach ($ids as $id => $event)
@if(!empty($event))
@foreach ($event['event_type'] as $type)
BEGIN:VEVENT
CATEGORIES:{{ str_replace($data['module']::getConfig('contextual_seperator'), ',', implode($event['categories'], ',')) }}
DESCRIPTION:{{ $data['module']::getiCalDesc($event['main_desc']) }}
DTSTAMP:{{ $data['module']::getDate('now','Ymd\THis') }}
DTSTART:{{ $data['module']::getDate($event['multi_dates'][$type]['startdate'],'Ymd\THi').'00' }}
DTEND:{{ $data['module']::getDate($event['multi_dates'][$type]['enddate'],'Ymd\THi').'00' }}
LOCATION:{{ $event['location'] }}
SUMMARY;LANGUAGE=en-us:{{ $event['name'] }}
UID:{{ $data['module']::getUid() }}
END:VEVENT
@endforeach
@endif
@endforeach
@endforeach
@endif
END:VCALENDAR
<?php
else:
$event = $data;
?>
BEGIN:VCALENDAR
VERSION:2.0
X-WR-CALNAME:{{ $data['module']::getConfig('calendar_title') }}
@if(!empty($data))
@foreach ($event['multi_dates'] as $date)
BEGIN:VEVENT
CATEGORIES:{{ str_replace($data['module']::getConfig('contextual_seperator'), ',', implode($event['categories'], ',')) }}
DESCRIPTION:{{ $data['module']::getiCalDesc($event['main_desc']) }}
DTSTAMP:{{ $data['module']::getDate('now','Ymd\THis') }}
DTSTART:{{ $data['module']::getDate($date['startdate'],'Ymd\THi').'00' }}
DTEND:{{ $data['module']::getDate($date['startdate'],'Ymd\THi').'00' }}
LOCATION:{{ $event['location'] }}
SUMMARY;LANGUAGE=en-us:{{ $event['name'] }}
UID:{{ $data['module']::getUid() }}
END:VEVENT
@endforeach
@endif
END:VCALENDAR
<?php
endif;
?>
