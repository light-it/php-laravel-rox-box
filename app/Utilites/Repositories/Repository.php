<?php

namespace App\Utilites\Repositories;

use App\Utilites\Repositories\Contracts\Repository as RepositoryInterface;
use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use App\Utilites\Repositories\Criterias\CriteriaFactory;
use App\Utilites\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var CriteriaFactory
     */
    private $criteriaFactory;

    /**
     * @var Builder
     */
    private $queryBuilder;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Criteria[]
     */
    private $criterias;

    /**
     * RepositoryV2 constructor.
     * @param CriteriaFactory $factory
     * @param Model $model
     * @throws RepositoryException
     */
    public function __construct(CriteriaFactory $factory, Model $model)
    {
        if (!$this->isSatisfy($model)) {
            throw new RepositoryException(
                sprintf("Given model (%s) is not satisfy repository (%s)", get_class($$model), get_class($this))
            );
        }

        $this->criteriaFactory = $factory;
        $this->queryBuilder = $model->newQuery();
        $this->model = $model;
    }

    /**
     * @param Model $model
     * @return bool
     */
    abstract protected function isSatisfy(Model $model): bool;

    /**
     * @param array $criterias
     * @return Builder[]|Collection
     * @throws Criterias\Exceptions\CriteriaBuildException
     */
    public function findBy(array $criterias)
    {
        $this->refreshBuilder();
        $this->pushCriteris($criterias);
        $this->applyCriterias();

        return $this->queryBuilder->get();
    }

    /**
     *
     */
    private function refreshBuilder()
    {
        $this->queryBuilder = $this->model->newQuery();
        $this->criterias = [];
    }

    /**
     * @param array $criterias
     * @throws Criterias\Exceptions\CriteriaBuildException
     */
    private function pushCriteris(array $criterias)
    {
        foreach ($criterias as $criteria => $value) {
            $this->criterias[] = $this->buildCriteria($criteria, $value);
        }
    }

    private function applyCriterias(): void
    {
        foreach ($this->criterias as $criteria) {
            $this->queryBuilder = $criteria->apply($this->queryBuilder);
        }
    }

    /**
     * @param string $criteria
     * @param $value
     * @return Criteria
     * @throws Criterias\Exceptions\CriteriaBuildException
     */
    private function buildCriteria(string $criteria, $value): Criteria
    {
        return $this->criteriaFactory->buildCriteria($criteria, $value);
    }

    /**
     * @param array $criterias
     * @return mixed
     * @throws Criterias\Exceptions\CriteriaBuildException
     */
    public function findSingleBy(array $criterias): Model
    {
        $results = $this->findBy($criterias);

        return $this->getFirstResult($results);
    }

    /**
     * @param array $criterias
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws Criterias\Exceptions\CriteriaBuildException
     */
    public function findPaginated(array $criterias, int $perPage)
    {
        $this->refreshBuilder();
        $this->pushCriteris($criterias);
        $this->applyCriterias();

        return $this->queryBuilder->paginate($perPage)->appends(request()->query());
    }


    /**
     * @param $results
     * @return Model
     */
    private function getFirstResult(Collection $results): Model
    {
        if ($results->isEmpty()) {
            throw new ModelNotFoundException();
        }

        return $results->first();
    }

    /**
     * @return Model
     */
    public function getModelInstance(): Model
    {
        return $this->model->newInstance();
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function create(array $data): Model
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        $model->fresh();

        return $model;
    }

    /**
     * @param Model $model
     * @throws \Exception
     */
    public function delete(Model $model)
    {
        $model->delete();
    }

    public function restore(Model $model)
    {
        $model->restore();
    }


    /**
     * @param Model $model
     * @return Model
     */
    public function save(Model $model): Model
    {
        $model->save();

        return $model;
    }

    /**
     * @return Builder[]|Collection|mixed
     */
    public function all()
    {
        return $this->model->newQuery()->get();
    }


}
