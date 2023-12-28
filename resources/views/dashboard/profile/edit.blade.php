@extends('layouts.dashboard')

@section('styles')
@endsection

@section('title', 'profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">{{ $user->profile ? 'Edit' : 'Add'  }} Profile</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- User ID (Hidden) -->
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <!-- First Name -->
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $user->profile->first_name )  }}">
                            </div>

                            <!-- Last Name -->
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $user->profile->last_name ) }}">
                            </div>

                            <!-- Birthday -->
                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" name="birthday" id="birthday" class="form-control" value="{{ old('birthday', $user->profile->birthday ) }}">
                            </div>

                            <!-- Gender -->
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="male" {{ old('gender', $user->profile->gender ) === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $user->profile->gender ) === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <!-- Street Address -->
                            <div class="form-group">
                                <label for="street_address">Street Address</label>
                                <input type="text" name="street_address" id="street_address" class="form-control" value="{{ old('street_address', $user->profile->street_address ) }}">
                            </div>

                            <!-- City -->
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $user->profile->city ) }}">
                            </div>

                            <!-- State -->
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $user->profile->state ) }}">
                            </div>

                            <!-- Postal Code -->
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code', $user->profile->postal_code ) }}">
                            </div>

                            <!-- Country -->
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select name="country" id="country" class="form-control">
                                    @foreach ($countries as $key => $value )
                                    <option value="{{ $key }}" {{ old('country', $user->profile->country ) === $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Locale -->
                            <div class="form-group">
                                <label for="locale">locale</label>
                                <select name="locale" id="locale" class="form-control">
                                    @foreach ($locales as $key => $value )
                                    <option value="{{ $key }}" {{ old('locale', $user->profile->locale ) === $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>                       
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->profile->phone_number ) }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
