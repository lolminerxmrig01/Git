<div class="o-box__header">
  <span class="o-box__title">نشانی‌ها</span>
</div>

@foreach($customer->addresses as $address)
  <div class="c-profile-address__item js-user-address-container">
    <div class="c-profile-address__item-top">
      <div class="c-profile-address__item-title">
        {{ $address->address }}
      </div>
      <div class="c-ui-more">
        <div class="o-btn o-btn--icon-gray-md o-btn--l-more js-ui-see-more"></div>
        <div class="c-ui-more__options js-ui-more-options">
          <div class="c-ui-more__option c-ui-more__option--red js-remove-address-btn" data-id="{{ $address->id }}" data-token="">
            حذف
          </div>
        </div>
      </div>
    </div>
    <div class="c-profile-address__content">
      <ul class="c-profile-address__info">
        <li>
          <div class="c-profile-address__info-item location">
            {{--                {{ fullZone($address->state->id, ' ', ' ', ' ') }}--}}
            {{ getState($address->state->id)->name . '، ' . $address->state->name }}
          </div>
        </li>
        @if(!is_null($address->postal_code))
          <li>
            <div class="c-profile-address__info-item postal-code">{{ persianNum($address->postal_code) }}</div>
          </li>
        @endif
        @if(!is_null($customer->mobile))
          <li>
            <div class="c-profile-address__info-item phone">{{ persianNum(0 . $customer->mobile) }}</div>
          </li>
        @endif
        <li>
          <div class="c-profile-address__info-item name">{{ $customer->first_name . ' ' . $customer->last_name }}</div>
        </li>
        {{--            <li class="location-link">--}}
        {{--              <div class="o-link o-link--has-arrow o-link--sm js-edit-address-btn">ویرایش نشانی</div>--}}
        {{--            </li>--}}
      </ul>
    </div>
  </div>
@endforeach
