<?php

namespace App\Http\Requests\Auth;

use Hash;
use Illuminate\Foundation\Http\FormRequest;
use Nestle\App\User;

class JWTRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function getUser()
    {
        $user = new User();
        $user->name = $this->input('name');
        $user->email = $this->input('email');
        $user->password = Hash::make($this->input('password'));

        return $user;
    }
}