<?php

    // $data['categories']  = (array) $data['categories'];
    //   if(isset($category_list)) {
    //   usort($data['categories'], function ($a, $b) use ($category_list) {
    //     $pos_a = array_search($a['name'], $category_list);
    //     $pos_b = array_search($b['name'], $category_list);

    //     $result = null;
    //     if ($pos_a !== false && $pos_b === false) {
    //         $result = -1;
    //     } else if ($pos_b !== false && $pos_a === false) {
    //         $result = 1;
    //     } else if ($pos_b === false && $pos_a === false) {
    //         $result = strcmp($a['name'], $b['name']);
    //     } else {
    //         $result = $pos_a - $pos_b;
    //     }
    //     return $result;
    // });
    // }
    ?>

<?php $cat_counter = 1;

?>

<div id="searchoptions" class="ajax-load-area" data-ajaxloadalso='["calendar_events", "calendar_box", "view_period_switchers", "view-switchers","calendar_page","jumpto_hidden_form","past_events"]'>
    <form method="get" action="{{$data['all_event_url']}}">
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


            <label>Show categories:</label>


            <div id="hidden_form">
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
                                               value="{{$second_level_cats['link']}}"/>
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
            <div id="hidden-inputs">
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
                <input type="hidden" id="past"
                     @if($data['past'] == 1)
                      value="{{ $data['past'] }}"
                      @endif
                      name="past"
                      value="1" />
                </div>
                <noscript>
                  <input type="submit" class="button calendar-button small" value="Submit" name="submit">
                </noscript>
        </fieldset>
    </form>
</div>

