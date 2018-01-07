<?php

namespace App\Modules\System\Group;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupMember extends Pivot
{

    public $incrementing = false;
    public $timestamps   = false;
    protected $table     = 'group_member';

}
