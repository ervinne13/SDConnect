<?php

namespace App\Http\Requests\System\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterTeacherRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_account_username' => 'required|string|max:30|unique:teacher',
            'display_name'          => 'required|string|max:100',
            'password'              => 'required|string|min:6|confirmed',
        ];
    }

}
