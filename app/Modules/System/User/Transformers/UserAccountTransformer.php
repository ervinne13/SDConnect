<?php

namespace App\Modules\System\User\Transformers;

use App\Modules\Base\BaseTransformer;
use App\Modules\Base\Impl\BasicBaseTransformer;
use App\Modules\System\User\UserAccount;

/**
 *
 * @author ervinne
 */
class UserAccountTransformer extends BasicBaseTransformer implements BaseTransformer
{

    public function __construct()
    {
        parent::__construct(UserAccount::class);
    }

    public function getJsonRelationships()
    {
        return [];
    }

    public function transformToWrappedJson($userAccount): array
    {
        return [
            'meta'  => [
                'id'             => 'username',
                'composite_keys' => null
            ],
            'data'  => [
                'type'          => 'user accounts',
                'id'            => $userAccount->getUsername(),
                'attributes'    => $this->transformToAttributes($userAccount),
                'relationships' => []
            ],
            'links' => [
                'self' => route('user.show', $userAccount->getUsername())
            ]
        ];
    }

}
