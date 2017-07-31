<?php

namespace App\Modules\System\Role\Repository\Impl;

use App\Modules\Base\Impl\BasicBaseRepository;
use App\Modules\System\Role\Repository\RoleRepository;
use App\Modules\System\Role\Role;

class RoleRepositoryDefaultImpl extends BasicBaseRepository implements RoleRepository
{

    function __construct()
    {
        parent::__construct(Role::class);
    }

}
