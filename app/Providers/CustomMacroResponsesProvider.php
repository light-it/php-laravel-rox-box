<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class CustomMacroResponsesProvider extends ServiceProvider
{
    /**
     * Fractal Manager Instance
     *
     * @var FractalManager
     */
    protected $fractal_manager;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $fractal_manager = App::make('FractalManager');
        
        /**
         * Empty response macros
         */
        Response::macro('empty', function($status_code = 201) {
            return response()->make(null, $status_code);
        });
        
        /**
         * Success response macros
         */
        Response::macro('success', function($data = ['status' => 'success'], $status_code = 201) {
            if (is_int($data)) {
                $data = [
                    'status'  => 'success',
                    'message' => trans('api.' . $data),
                ];
            }
            return response()->make($data, $status_code);
        });
        
        /**
         * Responser with error
         */
        Response::macro('error', function ($error, $status_code = 422, $errors = null) {
            return response()->make([
                'status_code' => $status_code,
                'message'     => trans('api.' . $error),
                'errors'      => ($errors) ? $errors : [],
            ], $status_code);
        });
        
        /**
         * Responser with error
         */
        Response::macro('error_text', function($error_text, $status_code = 422, $errors = null) {
            return response()->make([
                    'status_code' => $status_code,
                    'message'     => $error_text,
                    'errors'      => ( $errors ) ? $errors : []
                ],
                $status_code
            );
        });

        /**
         * Responser with api error
         */
        Response::macro('exception_error', function ($e, $error = null) {
            return response()->make([
                    'status_code' => $e->getStatusCode(),
                    'message'     => $error,
                ],
                $e->getStatusCode()
            );
        });

        /**
         * Fractal single item response
         *
         * @return \Illuminate\Http\Response json
         */
        Response::macro('item', function (
            $item,
            TransformerAbstract $transformer,
            $status = 200,
            array $headers = []
        ) use ($fractal_manager) {
            $resource = new Item($item, $transformer);

            return response()->json(
                $fractal_manager->createData($resource)->toArray(),
                $status,
                $headers
            );
        });

        /**
         * Fractal multiple items response
         *
         * @return \Illuminate\Http\Response json
         */
        Response::macro('collection', function (
            $collection,
            TransformerAbstract $transformer,
            $status = 200,
            array $headers = []
        ) use ($fractal_manager) {
            $resource = new Collection($collection, $transformer);

            return response()->json(
                $fractal_manager->createData($resource)->toArray(),
                $status,
                $headers
            );
        });

        /**
         * Fractal multiple items with pagination
         *
         * @return \Illuminate\Http\Response json
         */
        Response::macro('pagination', function (
            $paginator,
            TransformerAbstract $transformer,
            $status = 200,
            array $headers = []
        ) use ($fractal_manager) {
            $collection = $paginator->getCollection();
            $resource   = new Collection($collection, $transformer);
            $resource   = $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

            return response()->json(
                $fractal_manager->createData($resource)->toArray(),
                $status,
                $headers
            );
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
