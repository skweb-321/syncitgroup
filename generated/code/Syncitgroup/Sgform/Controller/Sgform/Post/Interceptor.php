<?php
namespace Syncitgroup\Sgform\Controller\Sgform\Post;

/**
 * Interceptor class for @see \Syncitgroup\Sgform\Controller\Sgform\Post
 */
class Interceptor extends \Syncitgroup\Sgform\Controller\Sgform\Post implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Syncitgroup\Sgform\Helper\Email $mail, \Syncitgroup\Sgform\Model\SgformFactory $sgformFactory, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress, ?\Psr\Log\LoggerInterface $logger = null)
    {
        $this->___init();
        parent::__construct($context, $mail, $sgformFactory, $dataPersistor, $remoteAddress, $logger);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
