<div id="jumptoform"  data-ajaxloadalso='["calendar_events", "calendar_box", "view_period_switchers", "view-switchers","calendar_page","hidden_form","searchoptions-dates"]'>
    <form method="get" action="{{$data['all_event_url']}}">
        <fieldset class="panel">
            <legend></legend>
            <label for="month">Go To:</label>
            <select name="month">
                @foreach($data['months'] as $month_data)
                    @if($month_data['selected'])
                        <option selected value="{{ $month_data['value'] }}">{{ $month_data['label'] }}</option>
                    @else
                        <option value="{{ $month_data['value'] }}">{{ $month_data['label'] }}</option>
                    @endif
                @endforeach
            </select>
            <select name="year">
                @foreach($data['years'] as $year_data)
                    @if($year_data['selected'])
                        <option selected value="{{ $year_data['value'] }}">{{ $year_data['label'] }}</option>
                    @else
                        <option value="{{ $year_data['value'] }}">{{ $year_data['label'] }}</option>
                    @endif
                @endforeach
            </select>
            <div id="jumpto_hidden_form">
                <input type="hidden"
                       @if($data['keywords'])
                       value="{{ $data['keywords'] }}"
                       @endif
                       name="keywords" id="keywords"/>
                <input type="hidden"
                       value="month"
                       name="search" id="search"/>
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
            </div>
            <input type="submit" class="button calendar-button small" value="Go">
        </fieldset>
    </form>
</div>
