<div class="c-form citySelect">
  <label class="c-RD-profile__input-name " for="city">
    شهر:
  </label>
  <div class="c-ui-input">
    <select class="c-ui-select--common c-ui-select--small js-select-origin select2-hidden-accessible"
     name="city" data-name="city"  data-id="{{ $type }}" data-value="customer_address" aria-hidden="true">
      <option value="">انتخاب شهر</option>
      @foreach($cities as $city)
        <option value="{{ $city->id }}">{{ $city->name }}</option>
      @endforeach
    </select>
  </div>
</div>
