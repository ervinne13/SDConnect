<?php

namespace App\Modules\Base\Traits;

/**
 *
 * @author ervinne
 */
trait Activatable
{

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function setActive($isActive)
    {
        return $isActive !== false && $isActive !== 'false';
    }

}
