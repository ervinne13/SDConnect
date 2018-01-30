<?php

namespace App\Http\Controllers\Modules\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\JWTLoginRequest;
use App\Http\Requests\Auth\JWTRegisterRequest;
use App\Modules\System\Auth\Services\JWTAuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use function response;

class JWTAuthController extends Controller
{

    /**
     * Generates a new user token for the credentials passed via request parameters
     *
     * Requires:
     *     email, password
     * 
     * @param  JWTLoginRequest $request     
     * @param  JWTAuthService  $authService 
     * @return Response
     */
    public function login(JWTLoginRequest $request, JWTAuthService $authService)
    {
        try {
            $response = $authService->login($request->username, $request->password);
            return response()->json($response);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        } catch (Exception $e) {
            return exception_response($e);
        }
    }

    /**
     * Invalidates the token passed to this request via request parameters
     *
     * Requires:
     *     token
     *     
     * @param  Request $request
     * @return Response
     */
    public function logout(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'Failed to logout, please try again.'], 500);
        }
    }

    /**
     * Sends the email passed to this request a link to where the user may reset his password
     * 
     * @param  Request        $request     
     * @param  JWTAuthService $authService 
     * @return Response
     */
    public function recover(Request $request, JWTAuthService $authService)
    {
        try {
            $authService->recover($request->email);
            return response()->json(['message' => 'A reset email has been sent! Please check your email.']);
        } catch (\Exception $e) {
            return exception_response($e);
        }
    }

    /**
     * Creates a new user based on the request
     * 
     * @param  JWTRegisterRequest $request     
     * @param  JWTAuthService     $authService 
     * @return Response
     */
    public function register(JWTRegisterRequest $request, JWTAuthService $authService)
    {
        try {
            $authService->registerUser($request->getUser());
            return response()->json(['message' => 'Thanks for signing up! Please check your email to complete your registration.']);
        } catch (Exception $e) {
            return exception_response($e);
        }
    }

    /**
     * Sets the owner (user) of the passed verification code is_verified flag to true
     * @param  JWTAuthService $authService      
     * @param  string         $verificationCode 
     * @return Response
     */
    public function verifyUser(JWTAuthService $authService, $verificationCode)
    {

        try {
            $verified = $authService->verifyUserCode($verificationCode);
            if ($verified) {
                return response()->json(['message' => 'You have successfully verified your email address.']);
            } else {
                return response()->json(['error' => "Verification code is invalid."], 400);
            }
        } catch (Exception $e) {
            return exception_response($e);
        }
    }

}
