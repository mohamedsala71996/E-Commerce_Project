
<div class="form-group">
    <x-forms.label for='name' value='Name' />
    <x-forms.input type='text' name='name' :value="$role->name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required/>
    <x-forms.errorMessage name='name' message='message' />
</div>

<fieldset>
    <legend>{{ __('Abilities') }}</legend>

    {{-- @foreach (\App\Facades\Abilities::abilities() as $ability_code => $ability_name) --}}
    @foreach (app('abilities') as $ability_code => $ability_name)
    <div class="row mb-2">
        <div class="col-md-6">
            {{  $ability_name }}
        </div>
            
        <div class="col-md-2">
            <input type="radio" name="abilities[{{ $ability_code }}]" value="allow" @checked(($roleAbility[$ability_code] ?? $allow)=="allow")>
            Allow
        </div>
        <div class="col-md-2">
            <input type="radio" name="abilities[{{ $ability_code }}]" value="deny" @checked(($roleAbility[$ability_code] ?? $allow) =="deny")>
            Deny
        </div>
        <div class="col-md-2">
            <input type="radio" name="abilities[{{ $ability_code }}]" value="inherit" @checked(($roleAbility[$ability_code] ?? $allow)  =="inherit") >
            Inherit
        </div>

    </div>
    <br>
    @endforeach

</fieldset>


<button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
