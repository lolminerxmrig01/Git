<div class="c-form districtSelect">
  @if(!is_null($districts) && count($districts))
  <label class="c-RD-profile__input-name " for="district">محله:</label>
  <div class="c-ui-input">
    <select class="c-ui-select--common c-ui-select--small js-select-origin select2-hidden-accessible"
     name="district" data-name="district" data-id="{{ $type }}" data-name="district"
      data-value="customer_address" aria-hidden="true">
      <option value="">انتخاب محله</option>
      @foreach($districts as $district)
      <option value="{{ $district->id }}">{{ $district->name }}</option>
      @endforeach
    </select>
  </div>
  @endif
</div>
