<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengguna;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email_or_username', 'password');

        // Determine if email_or_username is an email or username
        if (filter_var($credentials['email_or_username'], FILTER_VALIDATE_EMAIL)) {
            // User input is an email
            $credentials = [
                'email' => $credentials['email_or_username'],
                'password' => $credentials['password']
            ];
        } else {
            // User input is a username
            $credentials = [
                'username' => $credentials['email_or_username'],
                'password' => $credentials['password']
            ];
        }

        if ($token = Auth::attempt($credentials)) {
            return redirect()->route('katalog.barang')->withCookie(cookie('token', $token, 60));
        }

        return redirect()->back()->withInput()->withErrors(['email_or_username' => 'Invalid login credentials']);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = Pengguna::where('api_token', session('token'))->first();
        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        //
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()*60,
        ]);
    }
}