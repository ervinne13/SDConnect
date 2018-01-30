<?php

namespace App\Modules\System\Auth\Services;

use App\Modules\System\User\UserAccount;

interface JWTAuthService
{

    public function login($email, $password);

    public function registerUser(UserAccount $user);

    public function verifyUserCode($verificationCode);

    public function recover($email);

}