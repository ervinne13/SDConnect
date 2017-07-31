<?php

namespace App\Modules\Base\Impl;

use App\Modules\Base\BaseRespository;
use App\Modules\Base\Enum\RepositoryFieldMappingImplementation;
use App\Modules\Base\Exceptions\ImplementationNotFoundException;

/**
 * Description of DefaultBaseRepository
 *
 * @author ervinne
 */
abstract class MappableColumnModelBaseRepository extends BasicBaseRepository implements BaseRespository
{

    protected $columnMapping         = [];
    protected $mappingImplementation = RepositoryFieldMappingImplementation::MANUAL;

    public function create(array $attributes)
    {
        parent::create($this->mapColumns($attributes));
    }

    public function update(array $attributes, $id)
    {
        parent::update($this->mapColumns($attributes), $id);
    }

    protected function mapColumns(array $attributes)
    {
        //  TODO: add dependency resolution for other implementations of column 
        //  mapping here
        switch ( $this->mappingImplementation ) {
            case RepositoryFieldMappingImplementation::MANUAL:
                return $this->mapAttributesUsingColumnMap($attributes);
            default:
                throw new ImplementationNotFoundException("Mapping implementation {$this->mappingImplementation} not found.");
        }
    }

    protected function mapAttributesUsingColumnMap(array $attributes)
    {
        foreach ( $this->columnMapping AS $databaseColumn => $modelProperty ) {
            $attributes[$databaseColumn] = $attributes[$modelProperty];
            unset($attributes[$modelProperty]);
        }
    }

}
