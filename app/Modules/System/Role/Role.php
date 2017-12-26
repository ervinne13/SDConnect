<?php

namespace App\Modules\System\Role;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public $timestamps    = false;
    public $incrementing  = false;
    protected $table      = "role";
    protected $primaryKey = "code";
    protected $fillable   = [
        "code", "display_name"
    ];

}
