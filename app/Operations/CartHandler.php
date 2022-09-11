<?php

namespace App\Operations;

use App\Services\CartServiceInterface;
use App\Services\RedisCartService;
use App\Services\SessionCartService;

class CartHandler
{
    public static function handler() : CartServiceInterface
    {
        return auth()->check() ? new RedisCartService() : new SessionCartService();
    }
}
