<select name="attr_unit" class="uk-input uk-input--select js-select-origin select2-hidden-accessible"
 tabindex="-1" aria-hidden="true" aria-invalid="false">
    @if(isset($units) && count($units))
        @foreach($units as $unit)
        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
        @endforeach
    @endif
</select>
