<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Syncitgroup\Sgform\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Syncitgroup\Sgform\Model\Config;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    
	/**
     * @var Magento\Framework\Translate\Inline\StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var Magento\Framework\Escaper
     */
    protected $escaper;

    /**
     * @var Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var \Syncitgroup\Sgform\Model\Config
     */
    protected $config;


    /**
     * @param Context $context
     * @param StateInterface $inlineTranslation
     * @param Escaper $escaper
     * @param TransportBuilder $transportBuilder
     * @param Config $config
     */
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        Config $config
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->config = $config;
        $this->logger = $context->getLogger();
    }

    public function sendEmail(array $variables)
    {
    	try {
            $this->inlineTranslation->suspend();
            $toEmail = $this->config->email();
            $sender = [
                'name' => $this->escaper->escapeHtml('Harper'),
                'email' => $this->escaper->escapeHtml('harper@123789.org'),
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('submitted_sgform')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars($variables)
                ->setFrom($sender)
                ->addTo($toEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}

