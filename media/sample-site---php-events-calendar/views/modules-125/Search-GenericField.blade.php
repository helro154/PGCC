{{--
 * Search - GenericField: Displays the keywords search text
--}}
<div id="searchoptions-generic" class="ajax-load-area"   data-ajaxloadalso='["calendar_events", "calendar_box", "view_period_switchers", "view-switchers","calendar_page","jumpto_hidden_form","hidden_form_categories","past_events"]'>
    <form method="get" action="{{$data['all_event_url']}}" >
        <fieldset class="panel">
            <legend> </legend>

            <div id="search_field">
                <label class="block" for="keywords">Search:</label>
                <input type="text"
                       @if($data['keywords'])
                       value="{{ $data['keywords'] }}"
                       @endif
                       name="keywords" id="keywords"/>
            </div>

            {{-- Display the hidden element for the filter--}}
            <div id="hidden_form_generic">
                @foreach($data['options'] as $name => $val)
                    <input type="hidden" name="{{$name}}" value="{{$val}}"/>
                @endforeach
            </div>


            <input type="submit" class="button calendar-button small" value="Submit" name="submit">
        </fieldset>
    </form>
</div>
