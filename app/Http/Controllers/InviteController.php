<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Laravel\Jetstream\Jetstream;

class InviteController extends Controller
{
    public function invite()
    {
        return view('invite');
    }

    public function process(Request $request)
    {
        $invite = Invite::whereToken($request->token)->NotExpired()->first();

        $this->validateInvite($invite);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password, 'confirmed'],
            'token' => Rule::in($invite->token),
            'customer_id' => ['nullable', Rule::in($invite->customer_id)],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        if ($validated['customer_id']) $user->update(['customer_id' => $validated['customer_id']]);

        if ($user->email === $invite->email)
            $user->markEmailAsVerified();
        else
            $user->sendEmailVerificationNotification();

        $user->assignRole('user');
        $invite->delete();
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

    private function validateInvite($invite)
    {
        if (!$invite) abort(403, "Invitation is not found or no longer valid");
    }

    public function accept($token)
    {
        $invite = Invite::whereToken($token)->NotExpired()->first();

        $this->validateInvite($invite);

        return view('auth.accept-invitation', ['invite' => $invite]);
    }
}

