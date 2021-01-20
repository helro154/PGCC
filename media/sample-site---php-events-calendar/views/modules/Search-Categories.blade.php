{{--
 * Search - Categories: Displays the Categories List
--}}
<?php
$cat_counter = 1;
?>
<div id="searchoptions-categories" class="ajax-load-area"   data-ajaxloadalso='["calendar_events", "calendar_box", "view_period_switchers", "view-switchers","calendar_page","jumpto_hidden_form","past_events","hidden_form_generic"]'>
    <form method="get" action="{{$data['all_event_url']}}" class="panel event-search-widget">
        <fieldset>
            <legend>Show categories:</legend>
            {{-- Display the hidden element for the filter --}}
            <div id="hidden_form_categories">
                @foreach($data['options'] as $name => $val)
                    <input type="hidden" name="{{$name}}" value="{{$val}}"/>
                @endforeach
            </div>
            <ul class="category_form">
                @foreach ($data['categories'] as $parent_cat)

                    <li>
                        <input {{ (array_key_exists($parent_cat['link'], $data['selections'])) ? 'checked' : "" }} type="checkbox"
                               name="categories[]" id="category_{{ $cat_counter }}" value="{{ $parent_cat['link'] }}"/>
                        <label for="category_{{ $cat_counter++ }}">{{ $parent_cat['name'] }}</label>

                        <?php $subcat_counter = 1; ?>

                        @if(!empty($parent_cat['categories']))
                            <ul>
                                @foreach ($parent_cat['categories'] as $second_level_cats)
                                    <li>
                                        <input type="checkbox" id="category_{{ $cat_counter }}_{{ $subcat_counter }}"
                                               {{ (array_key_exists($second_level_cats['link'], $data['selections'])) ? 'checked' : "" }} name="categories[]"
                                               value="{{$second_level_cats['link']}}" aria-label="Check "/>
                                        <label for="category_{{ $cat_counter }}_{{ $subcat_counter++ }}">{{ $second_level_cats['name'] }}</label>

                                        @if(!empty($second_level_cats['categories']))
                                            <ul>
                                                @foreach ($second_level_cats['categories'] as $third_level_cats)
                                                    <li>
                                                        <input type="checkbox"
                                                               id="category_{{ $cat_counter }}_{{ $subcat_counter }}"
                                                               {{ (array_key_exists($third_level_cats['link'], $data['selections'])) ? 'checked' : "" }} name="categories[]"
                                                               value="{{$third_level_cats['link']}}"/>
                                                        <label for="category_{{ $cat_counter }}_{{ $subcat_counter++ }}">{{ $third_level_cats['name'] }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>

                                @endforeach
                            </ul>
                    </li>
                    @endif
                @endforeach

            </ul>
            <noscript>
              <input type="submit" class="button calendar-button small" value="Submit" name="submit">
            </noscript>
        </fieldset>
    </form>
</div>
