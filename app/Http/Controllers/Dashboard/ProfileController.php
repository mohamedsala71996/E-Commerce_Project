<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;


class ProfileController extends Controller
{
    public function edit()
    {
        $this->authorize('view',Profile::class);
        \Locale::setDefault('en');
        $user=User::findOrFail(auth()->user()->id);
        $countries = Countries::getNames();
        $locales = Locales::getNames();
        return view('dashboard.profile.edit', compact('user','countries','locales'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $this->authorize('update',Profile::findOrFail($user->id));
        $user->profile()->updateOrCreate([], $request->validated());
        return redirect()->route('profile.edit')->with('success', 'Data saved successfully');
    }
}
