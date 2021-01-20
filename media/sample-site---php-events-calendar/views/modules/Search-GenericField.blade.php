{{--
 * Search - GenericField: Displays the keywords search text
--}}
<div id="searchoptions-generic" class="ajax-load-area"   data-ajaxloadalso='["calendar_events", "calendar_box", "view_period_switchers", "view-switchers","calendar_page","jumpto_hidden_form","hidden_form_categories","past_events"]'>
    <form method="get" action="{{$data['all_event_url']}}" class="panel event-search-widget" >
        <fieldset>
            <legend>Search:</legend>

            <div id="search_field">
                <label for="keywords">Search:</label>
                <input type="text"
                       @if($data['keywords'])
                       value="{{ $data['keywords'] }}"
                       @endif
                       name="keywords" id="keywords" placeholder="Search by Keyword"/>
            </div>

            {{-- Display the hidden element for the filter--}}
            <div id="hidden_form_generic">
                @foreach($data['options'] as $name => $val)
                    <input type="hidden" name="{{$name}}" value="{{$val}}"/>
                @endforeach
            </div>

            <noscript>
              <input type="submit" class="button calendar-button small" value="Submit" name="submit">
            </noscript>
        </fieldset>
    </form>
</div>
