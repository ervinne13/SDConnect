<?php

namespace App\Modules\System\Badge;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{

    public $timestamps  = false;
    protected $table    = 'badge';
    protected $fillable = ['display_name'];

}
