<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidInputException;
use App\Http\Controllers\Controller;
use App\Services\JWTAuthService;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use function response;
use function view;

class LoginController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     * @Override
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /* Show the application's login form.
     *
     * @override
     * @return Response
     */

    public function showLoginForm()
    {
        $viewData                               = $this->getDefaultViewData();
        $viewData["pageLayout"]                 = "sidebar-disabled navbar-disabled footer-disabled";
        $viewData["viewOptions"]["subTitleBar"] = false;
        return view('auth.login', $viewData);
    }

    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param  mixed  $user
     * @return mixed
     */
//    protected function authenticated(Request $request, $user) {
//        $moduleACLSrvc = new ModuleACLService();
//        $request->session()->put("currentUser.accessibleModuleOrder", $moduleACLSrvc->getAccessibleModules());
//    }

    protected function loginJWT(Request $request, JWTAuthService $JWTAuthService)
    {
        try {
            return $JWTAuthService->login($request->username, $request->password);
        } catch ( InvalidInputException $e ) {
            return response($e->getMessage(), 400);
        } catch ( Exception $e ) {
            return response($e->getMessage(), 500);
        }
    }

}
