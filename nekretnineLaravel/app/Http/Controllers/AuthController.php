<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>'kupac'
        ]);

        return response()->json(['message' => 'Registration successful'], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['message' => 'Login successful', 'token' => $token,'user'=>$user ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }


    public function user(Request $request)
    { 
        return  $request->user();
    }



    public function handleOAuthCallback(Request $request)
    {
        // Dobijanje authorization code-a iz URL-a
        $authorizationCode = $request->query('code');

        // Razmena authorization code-a za access token
        $client = new Client();
        $response = $client->post('https://api.instagram.com/oauth/access_token', [
            'form_params' => [
                'client_id' => env('INSTAGRAM_CLIENT_ID'),
                'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),
                'grant_type' => 'authorization_code',
                'redirect_uri' => env('INSTAGRAM_REDIRECT_URI'),
                'code' => $authorizationCode,
            ],
        ]);

        // Obrada odgovora
        $data = json_decode($response->getBody()->getContents(), true);

        // Sada možete sačuvati access token u bazu podataka ili ga koristiti za dohvatanje dodatnih podataka

        return response()->json($data);
    }
}
