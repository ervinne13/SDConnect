<?php

namespace App\Services;

use App\Modules\System\User\UserAccount;

interface JWTAuthService
{

    public function login($username, $password);

    public function registerUser(UserAccount $user);

    public function verifyUserCode($verificationCode);

    public function recover($username);
}
