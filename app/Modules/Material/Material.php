<?php

namespace App\Modules\Material;

use App\Modules\System\Group\Group;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    const PRIVACY_PRIVATE = 'private';
    const PRIVACY_GROUP = 'group';
    const PRIVACY_PUBLIC = 'public';

    protected $table = 'material';

    protected $fillable = [
        'owner_username',
        'display_name',
        'privacy',
        'file_type',
        'file_relative_url'
    ];    

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_material');
    }
}
