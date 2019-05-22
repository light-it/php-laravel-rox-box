<?php

namespace App\Utilites\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface Repository
 * @package App\Utilites\Repositories\Contracts
 */
interface Repository
{
    /**
     * @param array $criterias
     * @return mixed
     */
    public function findBy(array $criterias);

    /**
     * @param array $criterias
     * @return Model|null
     */
    public function findSingleBy(array $criterias): ?Model;

    /**
     * @param array $criterias
     * @param int $perPage
     * @return mixed
     */
    public function findPaginated(array $criterias, int $perPage);

    /**
     * @return Model
     */
    public function getModelInstance(): Model;

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model;

    /**
     * @param Model $model
     * @return mixed
     */
    public function delete(Model $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function restore(Model $model);

    /**
     * @param Model $model
     * @return Model
     */
    public function save(Model $model): Model;

    /**
     * @return mixed
     */
    public function all();
}
