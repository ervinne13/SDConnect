<?php

namespace App\Modules\System\User;

use Illuminate\Database\Eloquent\Model;

class UserAccountRole extends Model
{

    public $timestamps  = false;
    protected $table    = "user_account_role";
    protected $fillable = [
        "user_account_username",
        "role_code"
    ];

}
