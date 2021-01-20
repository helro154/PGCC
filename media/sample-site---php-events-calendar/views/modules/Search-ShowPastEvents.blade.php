<div id="past_events" class="ajax-load-area" data-ajaxloadalso='["calendar_events", "calendar_box", "view_period_switchers", "view-switchers","calendar_page","jumpto_hidden_form"]'>
    <form method="get" action="{{$data['all_event_url']}}" class="panel event-search-widget">
        <fieldset>
            <legend>Show Past Event</legend>
              @if($data['module']::getConfig('default_past') == false)
               <input type="checkbox" id="past"
                     @if($data['past'] == 1)
                      checked
                      @endif
                      name="past"
                      value="1" />
              <label for="past">Show Past Events</label>
              @endif
              @if($data['module']::getConfig('default_past') == true)
               <input type="checkbox" id="past"
                     @if($data['past'] == 0)
                      checked
                      @endif
                      name="past"
                      value="0" />

              <label for="past">Hide Past Events</label>
              @endif

              <input type="hidden"
                       @if($data['search'])
                       value="{{ $data['search'] }}"
                       @endif
                       name="search" id="search_search"/>
                <input type="hidden"
                       @if($data['search_day'])
                       value="{{ $data['search_day'] }}"
                       @endif
                       name="day" id="search_day"/>
                <input type="hidden"
                       @if($data['search_month'])
                       value="{{ $data['search_month'] }}"
                       @endif
                       name="month" id="search_month"/>
                <input type="hidden"
                       @if($data['search_year'])
                       value="{{ $data['search_year'] }}"
                       @endif
                       name="year" id="search_year"/>
                <input type="hidden"
                       @if($data['keywords'])
                       value="{{ $data['keywords'] }}"
                       @endif
                       name="keywords" />
                @foreach ($data['categories'] as $parent_cat)
                    @if (array_key_exists($parent_cat['link'], $data['selections']))
                        <input type="hidden" name="categories[]" value="{{ $parent_cat['link'] }}"/>
                    @endif
                    <?php $subcat_counter = 1; ?>
                    @if(!empty($parent_cat['categories']))
                        @foreach ($parent_cat['categories'] as $second_level_cats)
                            @if (array_key_exists($second_level_cats['link'], $data['selections']))
                                <input type="hidden" name="categories[]" value="{{ $second_level_cats['link'] }}"/>
                            @endif

                            @if(!empty($second_level_cats['categories']))
                                    @foreach ($second_level_cats['categories'] as $third_level_cats)
                                        @if (array_key_exists($third_level_cats['link'], $data['selections']))
                                            <input type="hidden" name="categories[]" value="{{ $third_level_cats['link'] }}"/>
                                        @endif
                                    @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
                <noscript>
                  <input type="submit" class="button calendar-button small" value="Submit" name="submit">
                </noscript>
        </fieldset>
    </form>
</div>
