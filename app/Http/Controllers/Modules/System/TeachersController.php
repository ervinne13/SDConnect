<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\User\RegisterTeacherRequest;
use App\Modules\System\User\Teacher;
use App\Modules\System\User\UserAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function redirect;
use function view;

class TeachersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $teachers = Teacher::with('user_account')->get();
        return view('pages.teacher.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $teacher = new Teacher();
        return view('pages.teacher.form', ['teacher' => $teacher]);
    }
    
    public function createPublic()
    {
        $teacher = new Teacher();
        return view('pages.teacher.public-form', ['teacher' => $teacher]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(RegisterTeacherRequest $request)
    {
        try {
            $this->saveTeacherFromRequest($request, null);
            return redirect()->back()->with('message', 'Successfully registered teacher account');
        } catch ( Exception $e ) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $username
     * @return Response
     */
    public function destroy($username)
    {
        try {
            $userAccount = UserAccount::find($username);
            $userAccount->delete();
        } catch ( Exception $e ) {
            return response($e->getMessage(), 500);
        }
    }

    protected function saveTeacherFromRequest(Request $request, $username)
    {
        if ( $username ) {
            $teacher     = Teacher::find($username);
            $userAccount = UserAccount::find($username);
        } else {
            $teacher     = new Teacher();
            $userAccount = new UserAccount();
        }

        $teacher->user_account_username = $request->user_account_username;
        $teacher->about                 = $request->about;

        $userAccount->username     = $request->user_account_username;
        $userAccount->display_name = $request->display_name;
        $userAccount->password     = Hash::make($request->password);

        DB::transaction(function() use ($userAccount, $teacher) {
            $userAccount->save();
            $userAccount->teacher()->save($teacher);
        });
    }

}
