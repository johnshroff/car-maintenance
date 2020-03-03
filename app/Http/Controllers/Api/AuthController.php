<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$data = $request->validate([
			'name'		=> 'required',
			'email'		=> 'email|required|unique:users',
			'password'	=> 'required|confirmed'
		]);
		$data['password'] = bcrypt($data['password']);
		$user = User::create($data);
		$token = $user->createToken('authToken')->accessToken;

		return response(['user' => $user, 'access_token' => $token]);
	}

	public function login(Request $request)
	{
		$data = $request->validate([
			'email'		=> 'email|required',
			'password'	=> 'required'
		]);

		if (!auth()->attempt($data)) {
			return response(['message'	=> 'Invalid credentials']);
		}

		$user = auth()->user();
		$token = $user->createToken('authToken')->accessToken;
		return response(['user' => $user, 'access_token'	=> $token]);
	}
}
