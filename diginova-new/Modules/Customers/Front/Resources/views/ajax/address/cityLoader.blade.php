<select class="c-ui-select js-ui-select-search js-dropdown-universal js-select-city js-address-city-id city-select" name="address[city_id]" value="" tabindex="-1">
  <option value="">انتخاب شهر</option>
  @foreach($cities  as $city)
  <option value="{{ $city->id }}">{{ $city->name }}</option>
  @endforeach
</select>

<script>
reloadScript();
</script>
