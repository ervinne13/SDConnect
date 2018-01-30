<?php

namespace App\Modules\System\Auth\Services\Impl;

use App\Exceptions\InvalidInputException;
use App\Modules\System\Auth\Services\JWTAuthService;
use App\Modules\System\User\UserAccount;
use DB;
use Exception;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use function str_random;

/**
 * Requires: https://github.com/tymondesigns/jwt-auth
 */
class JWTAuthServiceDefaultImpl implements JWTAuthService
{

    public function login($username, $password)
    {
        $invalidCredentialMessage = 'Invalid Credentials. Please make sure you entered the right information.';
        $user                     = UserAccount::username($username)->first();

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

        return [
            'display_name' => $user->display_name,
            'token'        => $token,
        ];
    }

    public function registerUser(UserAccount $user)
    {
        $verificationCode = str_random(30); //Generate verification code
        DB::transaction(function() use ($user, $verificationCode) {
            $user->save();

            UserVerification::create([
                'user_account_id' => $user->id,
                'token'           => $verificationCode
            ]);
        });

        //  TODO: put this in a job later
        $subject = 'Please verify your email address.';
        Mail::send('email.verify', ['name' => $user->name, 'verification_code' => $verificationCode], function($mail) use ($user, $subject) {
            $mail->from(getenv('FROM_EMAIL_ADDRESS'), 'jfc@nuworks.ph');
            $mail->to($user->email, $user->name);
            $mail->subject($subject);
        });

        return $user;
    }

    public function verifyUserCode($verificationCode)
    {
        $verificationEntry = UserVerification::token($verificationCode)->first();

        if ( !is_null($verificationEntry) ) {
            $user = UserAccount::find($verificationEntry->user_account_id);

            if ( $user->is_verified == 1 ) {
                throw new Exception('Account already verified..');
            }

            DB::transaction(function() use ($user, $verificationCode) {
                $user->update(['is_verified' => 1]);
                UserVerification::token($verificationCode)->delete();
            });

            return true;
        }

        return false;
    }

    public function recover($email)
    {
        $user = UserAccount::username($email)->first();

        if ( !$user ) {
            throw new InvalidInputException("User with email address {$email} is not registered");
        }

        //  TODO: put this in a job later
        Password::sendResetLink(['email' => $email], function (Message $message) {
            $message->subject('Your Password Reset Link');
        });
    }

}
