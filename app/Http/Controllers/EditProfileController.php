<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\EditProfileRequest;

class EditProfileController extends Controller
{
    public function show()
    {
        return view('template')->withContent('ProfileView');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        User::Where('id', Auth::user()->id)->update([
            'seller' => $data['seller'],
            'nip' => $data['nip'],
            'city' => $data['city'],
            'street' => $data['street'],
            'postcode' => $data['postcode'],
        ]);
        return response()->json(['success'=>'Zaktualizowano dane w profilu']);
    }
}
