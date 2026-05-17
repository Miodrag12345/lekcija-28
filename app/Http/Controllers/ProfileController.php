<?php


namespace App\Http\Controllers;

use App\Http\Requests\NewAvatarRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    use ImageUploadTrait;

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function showChangeAvatar(Request $request): View
    {
        return view('profile.change-avatar', [
            'user' => $request->user(),
        ]);
    }

    public function changeAvatar(NewAvatarRequest $request): RedirectResponse
    {
        $avatar=Auth::user()->avatar;
        if($avatar !== null){
            File::delete("storage/images/avatars/$avatar");

        }

        $name=$this->uploadImage($request->file('profile_image'), 'images/avatars');

        Auth::user()->update(['avatar' => $name]);

        return Redirect::route('profile.changeAvatar.show')->with('status', 'avatar-updated');
    }

    public function updateImage(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $path = $request->file('image')->store('images', 'public');

        $request->user()->update(['avatar' => $path]);

        return Redirect::route('profile.edit')->with('status', 'image-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
