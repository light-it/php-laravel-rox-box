<?php

namespace App\Http\Transformers;

use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{

    const PARAM_AVAILABLE_INCLUDES = 'available_includes';

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
    ];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
    ];

    /**
     * Getter for defaultIncludes.
     *
     * @return array
     */
    public function getDefaultIncludes()
    {
        switch (true) {
            case !env('APP_DEBUG'):
            case !request()->has(self::PARAM_AVAILABLE_INCLUDES):

                return parent::getDefaultIncludes();
            default:

                return array_merge(
                    parent::getDefaultIncludes(),
                    [self::PARAM_AVAILABLE_INCLUDES]
                );
        }
    }

    /**
     * Includes array of available includes.
     *
     * @return Primitive
     */
    public function includeAvailableIncludes()
    {
        return (new Primitive())->setData($this->getAvailableIncludes());
    }
}
