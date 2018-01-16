<?php

namespace App\Services\Impl;

use App\Exceptions\InvalidInputException;
use App\Modules\System\User\UserAccount;
use App\Services\JWTAuthService;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Requires: https://github.com/tymondesigns/jwt-auth
 */
class JWTAuthServiceDefaultImpl implements JWTAuthService
{

    public function login($username, $password)
    {
        $invalidCredentialMessage = 'Invalid Credentials. Please make sure you entered the right information.';

        $user = UserAccount::username($username)->first();

        if ( !$user ) {
            throw new InvalidInputException($invalidCredentialMessage);
        }

        $credentials = [
            'username' => $username,
            'password' => $password,
//            'is_verified' => $user->is_verified
        ];

        // attempt to verify the credentials and create a token for the user
        if ( !$token = JWTAuth::attempt($credentials) ) {
            throw new InvalidInputException($invalidCredentialMessage);
        }

        // all good so return the token
        return $token;
    }

    public function registerUser(UserAccount $user)
    {
        
    }

    public function verifyUserCode($verificationCode)
    {
        
    }

    public function recover($username)
    {
        
    }

}
