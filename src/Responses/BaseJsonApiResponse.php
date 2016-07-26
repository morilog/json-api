<?php
namespace Morilog\JsonApi\Responses;

/**
 * Class BaseJsonApiResponse
 * @package Morilog\JsonApi\Responses
 */
abstract class BaseJsonApiResponse
{
    /**
     * @param string $dataKey
     * @param string|array $data
     * @param null $pagination
     * @param null $extraData
     */
    abstract public function prepare($dataKey = null, $data = null, $pagination = null, $extraData = null);
}