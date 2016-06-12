<?php
namespace Morilog\JsonApi\Responses;

use Illuminate\Http\JsonResponse;

/**
 * Interface JsonApiResponseInterface
 * @package Morilog\JsonApi\Responses
 */
interface JsonApiResponseInterface
{
    /**
     * @return JsonResponse
     */
    public function getResponse();
}