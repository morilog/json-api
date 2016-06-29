<?php
namespace Morilog\JsonApi;

use Illuminate\Contracts\Support\MessageBag;
use Morilog\JsonApi\Responses\DestroyJsonApiResponse;
use Morilog\JsonApi\Responses\IndexJsonApiResponse;
use Morilog\JsonApi\Responses\PaginationJsonApiResponse;
use Morilog\JsonApi\Responses\StoreJsonApiResponse;
use Morilog\JsonApi\Responses\UpdateJsonApiResponse;
use Morilog\JsonApi\Responses\ValidationJsonApiResponse;

/**
 * Class JsonApi
 * @package Morilog\JsonApi
 */
class JsonApi
{
    /**
     * @param $dataKey
     * @param $data
     * @return IndexJsonApiResponse
     */
    public static function indexResponse($dataKey, $data)
    {
        return (new IndexJsonApiResponse($dataKey, $data))->getResponse();
    }

    /**
     * @param MessageBag $errors
     * @return ValidationJsonApiResponse
     */
    public static function validationResponse(MessageBag $errors)
    {
        return (new ValidationJsonApiResponse($errors))->getResponse();
    }


    /**
     * @param $dataKey
     * @param $resource
     * @return JsonResponse
     */
    public static function storeResponse($dataKey, $resource)
    {
        return (new StoreJsonApiResponse($dataKey, $resource))
            ->getResponse();
    }

    /**
     * @param $dataKey
     * @param AbstractPaginator|Paginator $pagination
     * @return JsonResponse
     */
    public static function paginationResponse($dataKey, AbstractPaginator $pagination)
    {
        return (new PaginationJsonApiResponse(
            $dataKey,
            $pagination->getCollection(),
            $pagination->toArray())
        )->getResponse();
    }


    /**
     * @return JsonResponse
     */
    public static function destroyResponse()
    {
        return (new DestroyJsonApiResponse())->getResponse();
    }

    /**
     * @param null $dataKey
     * @param null $data
     * @return JsonResponse
     */
    public static function updateResponse($dataKey = null, $data = null)
    {
        return (new UpdateJsonApiResponse($dataKey, $data))->getResponse();
    }
}