<?php

namespace App\Modules\System\Group\Transformers;

use App\Modules\Base\BaseTransformer;
use App\Modules\Base\Impl\BasicBaseTransformer;
use App\Modules\System\Group\Group;
use App\Modules\System\User\Transformers\UserAccountTransformer;
use function route;

/**
 * Description of GroupTransformerDefaultImpl
 * http://jsonapi.org/format/#fetching-resources
 * Dependencies:
 *  UserTransformer
 * 
 * Direct implementation, see later if this needs to be decoupled.
 * 
 * @author ervinne
 */
class GroupTransformer extends BasicBaseTransformer implements BaseTransformer
{

    protected $userAccountTransformer;

    public function __construct(UserAccountTransformer $userAccountTransformer)
    {
        parent::__construct(Group::class);
        $this->userAccountTransformer = $userAccountTransformer;
    }

    function getJsonRelationships()
    {
        return [
            'owner'
        ];
    }

    function transformToWrappedJson($group): array
    {
        return [
            'meta'  => [
                'composite_id' => ["owner_username", "code"]
            ],
            'data'  => [
                'type'          => 'groups',
                'id'            => [$group->getOwner()->getUsername(), $group->getCode()],
                'attributes'    => $this->transformToAttributes($group),
                'relationships' => [
                    'owner' => $this->userAccountTransformer->transformToWrappedJson($group->getOwner())
                ]
            ],
            'links' => [
                'self' => route('user.group.show', [$group->getOwner()->getUsername(), $group->getCode()])
            ]
        ];
    }

}
