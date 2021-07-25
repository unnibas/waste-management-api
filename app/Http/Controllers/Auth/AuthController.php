<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    use ApiResponser;
    /**
     * Grant token for user
     */
    public function getToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user['token'] = $user->createToken($request->email)->plainTextToken;
        return $this->showOne($user);
    }

    /**
     * Revoke all token of a user
     */
    public function revokeToken(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return $this->showMessage('The token revoked successfully', 200);
    }
}
