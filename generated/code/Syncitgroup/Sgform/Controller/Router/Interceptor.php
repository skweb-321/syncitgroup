<?php
namespace Syncitgroup\Sgform\Controller\Router;

/**
 * Interceptor class for @see \Syncitgroup\Sgform\Controller\Router
 */
class Interceptor extends \Syncitgroup\Sgform\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory, \Magento\Framework\App\ResponseInterface $response, \Syncitgroup\Sgform\Model\Config $config)
    {
        $this->___init();
        parent::__construct($actionFactory, $response, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }
}
