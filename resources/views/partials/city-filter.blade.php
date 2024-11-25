<hr />
<label for="city">Ciudades:</label>
<select class="selectpicker show-tick" data-style="btn-primary" data-live-search="true" id="city" name="city">
    <option value="" selected="selected">Todas</option>
    <option data-divider="true"></option>
    @foreach($cities as $city)
        <option value='{{ $city->id }}'>{{ $city->name }}</option>
    @endforeach
</select>
<hr />