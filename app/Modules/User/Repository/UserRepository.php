<?php

namespace App\Modules\User\Repository;

/**
 *
 * @author ervinne
 */
interface UserRepository
{

    // <editor-fold defaultstate="collapsed" desc="CRUD">

    function createUser(array $userAssoc): User;

    function updateUser(array $userAssoc) : User;        
    
    // </editor-fold>
}
