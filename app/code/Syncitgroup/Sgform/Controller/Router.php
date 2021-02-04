<?php
namespace Syncitgroup\Sgform\Controller;

/**
 * Controller Router
 */
class Router implements \Magento\Framework\App\RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * @var \Syncitgroup\Sgform\Model\Config
     */
    protected $_config;

    /**
     * Response
     *
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $_response;

    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Magento\Framework\App\ResponseInterface $response
     * @param \Syncitgroup\Sgform\Model\Config $config
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory, 
        \Magento\Framework\App\ResponseInterface $response,
        \Syncitgroup\Sgform\Model\Config $config
    )
    {
        $this->actionFactory = $actionFactory;
        $this->_response = $response;
        $this->_config = $config;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ActionInterface|void
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo() , '/');
        if ($identifier == 'syncit-group-form') {
            if($this->_config->isEnabled()) {
                $request->setModuleName('syncitgroup')
                    ->setControllerName('sgform')
                    ->setActionName('index');
                $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $identifier);
                return $this->actionFactory
                 ->create('Magento\Framework\App\Action\Forward', ['request' => $request]);
            } else {
                return;
            }
        } else {
            return;
        }
    }
}