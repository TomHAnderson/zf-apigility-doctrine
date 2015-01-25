<?php

namespace ZF\Apigility\Doctrine\Server\Query\CreateFilter;

use ZF\Rest\ResourceEvent;
use ZF\ApiProblem\ApiProblem;

/**
 * Class DefaultCreateFilter
 *
 * @package ZF\Apigility\Doctrine\Server\Query\CreateFilter
 */
class DefaultCreateFilter extends AbstractCreateFilter
{
    /**
     * @param string $event
     * @param array  $entityClas
     * @param object $data
     *
     * @return object
     */
    public function filter(ResourceEvent $event, $entityClass, $data)
    {
        return $data;
    }
}
