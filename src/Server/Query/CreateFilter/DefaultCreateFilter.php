<?php

namespace ZF\Apigility\Doctrine\Server\Query\CreateFilter;

use ZF\Apigility\Doctrine\Server\Query\CreateFilter\QueryCreateFilterInterface;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\ResourceEvent;

/**
 * Class DefaultCreateFilter
 *
 * @package ZF\Apigility\Doctrine\Server\Query\CreateFilter
 */
class DefaultCreateFilter implements ObjectManagerAwareInterface, QueryCreateFilterInterface
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }

    /**
     * @param string $entityClass
     * @param array  $data
     *
     * @return array
     */
    public function filter(ResourceEvent $event, $entityClass, $data)
    {
        return $data;
    }

    /**
     * Validate an OAuth2 request
     *
     * @param scope
     * @return ApiProblem | bool
     */
    public function validateOAuth2($scope = null)
    {
        $server = $this->getServiceLocator()->getServiceLocator()->get('ZF\OAuth2\Service\OAuth2Server');
        if ( ! $server->verifyResourceRequest(OAuth2Request::createFromGlobals(), $response = null, $scope = $scope)) {
            $error = $server->getResponse();
            $parameters = $error->getParameters();
            $detail = isset($parameters['error_description']) ? $parameters['error_description']: $error->getStatusText();

            return new ApiProblem($error->getStatusCode(), $detail);
        }

        return true;
    }
}
