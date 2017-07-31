<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\System\Group\Repository\Impl;

use App\Modules\Base\BaseTransformer;
use App\Modules\Base\Impl\BasicBaseRepository;
use App\Modules\System\Group\Group;
use App\Modules\System\Group\Repository\GroupRepository;
use App\Modules\System\User\UserAccount;
use Illuminate\Support\Facades\Auth;

/**
 * Description of GroupRepositoryDemoImpl
 *
 * @author ervinne
 */
class GroupRepositoryDemoImpl extends BasicBaseRepository implements GroupRepository
{

    public function __construct(BaseTransformer $transformer = null)
    {
        parent::__construct(Group::class, $transformer);
        $this->willTransformModel(false);
    }

    public function getTypes(): array
    {
        return [
            "Generic",
            "Faculty",
            "Class",
        ];
    }

    public function allByUserAccount(UserAccount $user)
    {
        $demoValueMatrix = [
            ['2017 CpE 301', 'Class/Section', 'Computer Engineering - 3rd Year, Section 1'],
            ['2017 IT 202', 'Class/Section', 'Information Technology 2nd Year, Section 2'],
            ['Faculty IT', 'Teachers Group', 'Information Technology Faculty'],
        ];

        $groupList = $this->matrixToGroupList($demoValueMatrix);

        if ( $this->willTransformModel ) {
            $transformedGroupList = [];
            foreach ( $groupList AS $group ) {
                array_push($transformedGroupList, $this->transformer->transformToWrappedJson($group));
            }

            return $groupList;
        } else {
            return $groupList;
        }
    }

    private function matrixToGroupList(array $valueMatrix)
    {
        $list = [];
        foreach ( $valueMatrix AS $valueMatrixRow ) {

            $group = new Group([
                "owner_username" => Auth::user()->getUsername(),
                "code"           => $valueMatrixRow[0],
                "is_active"      => true,
                "type"           => $valueMatrixRow[1],
                "display_name"   => $valueMatrixRow[2]
            ]);

            $group->setOwner(Auth::user());

            array_push($list, $group);
        }

        return $list;
    }

}
