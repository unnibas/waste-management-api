<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;


trait ApiResponser {

    public function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code'=>$code],$code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {  
        if ($collection->isEmpty()) {
            return $this->successResponse($collection, $code);
        }
        
        $transformer = $collection->first()->transformer;
        $collection = $this->filterData($collection, $transformer);
        $collection = $this->sortData($collection, $transformer);
        $collection = $this->paginate($collection);
        $collection = $this->transformData($collection, $transformer);
        $collection = $this->cacheResponse($collection);
        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = 200)
    {
        $transformer = $instance->first()->transformer;
        $instance = $this->transformData($instance, $transformer);
        return $this->successResponse($instance, $code);
    }

    protected function showMessage($message, $code=200)
    {
        return $this->successResponse(['message' => $message, 'code' => $code], $code);
    }

    /**
     * Data Filtering
     */
    protected function filterData(Collection $collection, $transformer)
    {
        foreach (request()->query() as $query => $value) {
            $attribute = $transformer::originalAttribute($query);
            if (isset($attribute, $value)) {
                $collection = $collection->where($attribute, $value);
            }
        }

        return $collection;   
    }

    /**
     * Sorting
     */
    protected function sortData(Collection $collection, $transformer)
    {
        if (request()->has('sort_by')) {
            $attribute = $transformer::originalAttribute(request()->sort_by);
            $collection = $collection->sortBy->{$attribute};
        }
        return $collection;
    }

    /**
     * Pagination
     */
    protected function paginate(Collection $collection)
    {
        $rules = [
            'per_page' => 'integer|min:2|max:50',
        ];

        Validator::validate(request()->all(), $rules);

        $page  = PaginationLengthAwarePaginator::resolveCurrentPage();

        $perPage = 15;

        if (request()->has('per_page')) {
            $perPage = (int) request()->per_page;
        }

        $results = $collection->slice(($page-1) * $perPage, $perPage)->values();

        $paginated = new PaginationLengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => PaginationLengthAwarePaginator::resolveCurrentPath(),
        ]);

        $paginated->appends(request()->all());

        return $paginated;

    }

    /**
     * Transformer
     */

     protected function transformData($data, $transformer)
     {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
     }

     /**
      * Caching
      */
      protected function cacheResponse($data)
      {
          $url = request()->url();
          $queryParams = request()->query();

          ksort($queryParams);

          $queryString = http_build_query($queryParams);

          $fullUrl = "{$url}?{$queryString}";

          return Cache::remember($fullUrl, 30/60, function () use($data) {
              return $data;
          });
      }
}
