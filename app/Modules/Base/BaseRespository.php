<?php

namespace App\Modules\Base;

use App\Modules\System\User\UserAccount;

/**
 *
 * TODO: Datatables
 * 
 * @author ervinne
 */
interface BaseRespository
{

    public function actingAs(UserAccount $userAccount);

    public function returnsQueryObject(bool $willReturnQueryObject = true);

    public function willTransformModel(bool $willTransformModel = true);

    public function eagerLoadsRelationships(array $relatedModels);

    public function create($attributesOrModel);

    public function update($attributesOrModel, $id);

    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');

    public function delete($id);

    public function find($id);

    public function findOrFail($id);

    public function getPaginatedRecords(int $pageSize = 15, string $orderBy = 'id', string $sortBy = 'desc');

    public function getPaginatedRecordsFromQuery($query, int $pageSize = 15, string $orderBy = 'id', string $sortBy = 'desc');
}
