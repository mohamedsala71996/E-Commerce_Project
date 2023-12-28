<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;


class ProfileController extends Controller
{


    public function edit()
    {
        \Locale::setDefault('en');
        $user=User::findOrFail(auth()->user()->id);
        $countries = Countries::getNames();
        $locales = Locales::getNames();

        return view('dashboard.profile.edit', compact('user','countries','locales'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
      
        // $validated = $request->validated();
        // if ( isset($user->profile->user_id) ) {
        //     $user->profile()->update($validated);
        // }else{
        //     $user->profile()->create($validated);

        // }
        $user->profile()->updateOrCreate([], $request->validated());

        return redirect()->route('profile.edit')->with('success', 'Data saved successfully');
    }
}
