<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function register(RegisterRequest $request, UserService $userService)
	{
		try {
			$user = $userService->createUser($request->validated());
			$login = $userService->login($request->validated());
			return response()->json([
				'message' => 'Utilisateur enregistré et connecté',
				'loginData' => $login, 
			], 200);
		} catch (Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			],500);
		}
	}

	public function login(LoginRequest $request, UserService $userService)
	{
		try {
			$login = $userService->login($request->validated());
			if ($login) {
				return response()->json([
					'message' => 'Vous êtes connecté',
					'user' => $login,
				], 200);
			} else {
				return response()->json([
					'errors' => 'Utilisateur non identifié',
				], 403);
			}
		} catch (\Throwable $th) {
			return response()->json([
				'error' => $th->getMessage(),
			], 500);
		}
	}

	public function logout(Request $request)
	{
		/** @var \App\Models\User $user  */
		$user = auth()->user();
		$user->tokens()->delete();
		return response()->json([
			'message' => 'Utilisateur déconnecté',
		]);
	}
}
