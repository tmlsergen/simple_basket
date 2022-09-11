<?php

namespace App\Business;

use App\Models\User;
use App\Operations\CartHandler;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;

class AuthManager
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $credentials): bool
    {
        $status = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ], $credentials['remember_token']);


        if (!$status) {
            return false;
        }

        $cart = session('cart');

        if ($cart !== null) {
            $cartService = CartHandler::handler();

            $cartService->cartBulkInsert($cart);
            session()->forget('cart');
        }

        return true;
    }

    /**
     * @param array $inputs
     * @return User
     */
    public function register(array $inputs): User
    {
        $inputs['password'] = bcrypt($inputs['password']);

        return $this->userRepository->create($inputs);
    }

    public function logout()
    {
        Auth::logout();
    }
}
