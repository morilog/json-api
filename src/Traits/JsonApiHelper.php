<?php
namespace Morilog\JsonApi;

use Illuminate\JsonResponse;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\Paginator;
use Morilog\JsonApi\Responses\DestroyJsonApiResponse;
use Morilog\JsonApi\Responses\IndexJsonApiResponse;
use Morilog\JsonApi\Responses\PaginationJsonApiResponse;
use Morilog\JsonApi\Responses\StoreJsonApiResponse;
use Morilog\JsonApi\Responses\UpdateJsonApiResponse;

trait JsonApiHelper
{

    /**
     * @param $dataKey
     * @param $resource
     * @return JsonResponse
     */
    protected function storeResponse($dataKey, $resource)
    {
        return (new StoreJsonApiResponse($dataKey, $resource))
            ->getResponse();
    }

    /**
     * @param $dataKey
     * @param AbstractPaginator|Paginator $pagination
     * @return JsonResponse
     */
    protected function paginationResponse($dataKey, AbstractPaginator $pagination)
    {
        return (new PaginationJsonApiResponse(
            $dataKey,
            $pagination->getCollection(),
            $pagination->toArray())
        )->getResponse();
    }

    /**
     * @param $dataKey
     * @param $data
     * @return mixed
     */
    protected function indexResponse($dataKey, $data)
    {
        return (new IndexJsonApiResponse($dataKey, $data))->getResponse();
    }

    /**
     * @return JsonResponse
     */
    protected function destroyResponse()
    {
        return (new DestroyJsonApiResponse())->getResponse();
    }

    /**
     * @param null $dataKey
     * @param null $data
     * @return JsonResponse
     */
    protected function updateResponse($dataKey = null, $data = null)
    {
        return (new UpdateJsonApiResponse($dataKey, $data))->getResponse();
    }
}