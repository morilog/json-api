<?php
namespace Morilog\JsonApi;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Http\JsonResponse;
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
     * @param null $extraData
     * @return IndexJsonApiResponse
     */
    public static function indexResponse($dataKey, $data, $extraData = null)
    {
        return (new IndexJsonApiResponse($dataKey, $data, $extraData))->getResponse();
    }

    /**
     * @param MessageBag $errors
     * @param null $extraData
     * @return ValidationJsonApiResponse
     */
    public static function validationResponse(MessageBag $errors)
    {
        return (new ValidationJsonApiResponse($errors))->getResponse();
    }


    /**
     * @param $dataKey
     * @param $resource
     * @param null $extraData
     * @return JsonResponse
     */
    public static function storeResponse($dataKey, $resource, $extraData = null)
    {
        return (new StoreJsonApiResponse($dataKey, $resource, $extraData))
            ->getResponse();
    }

    /**
     * @param $dataKey
     * @param \Illuminate\Contracts\Pagination $pagination
     * @param null $extraData
     * @return JsonResponse
     */
    public static function paginationResponse($dataKey, $pagination, $extraData = null)
    {
        return (new PaginationJsonApiResponse(
            $dataKey,
            $pagination->getCollection(),
            $pagination->toArray(),
            $extraData)
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
     * @param null $extraData
     * @return JsonResponse
     */
    public static function updateResponse($dataKey = null, $data = null, $extraData = null)
    {
        return (new UpdateJsonApiResponse($dataKey, $data, $extraData))->getResponse();
    }
}