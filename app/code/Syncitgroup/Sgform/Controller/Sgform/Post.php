<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Syncitgroup\Sgform\Controller\Sgform;

use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Syncitgroup\Sgform\Model\MailInterface;
use Syncitgroup\Sgform\Model\SgformFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Syncitgroup\Sgform\Helper\Email;

class Post extends \Magento\Framework\App\Action\Action implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var Email
     */
    private $mail;

    /**
     * @var SgformFactory
     */
    private $sgformFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var RemoteAddress
     */
    private $remoteAddress;    

    /**
     * @param Context $context
     * @param MailInterface $mail
     * @param DataPersistorInterface $dataPersistor
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        Email $mail,
        SgformFactory $sgformFactory,
        DataPersistorInterface $dataPersistor,
        RemoteAddress $remoteAddress,
        LoggerInterface $logger = null
    ) {
        parent::__construct($context);
        $this->context = $context;
        $this->mail = $mail;
        $this->sgformFactory = $sgformFactory;
        $this->remoteAddress = $remoteAddress;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
    }

    /**
     * Post custom form data
     *
     * @return Redirect
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $postData = $this->validatedParams();
            $sgformModel = $this->sgformFactory->create();
            $sgformModel->addData([
                "firstname" => $postData['firstname'],
                "lastname" => $postData['lastname'],
                "email" => $postData['email'],
                "message" => $postData['message']
                ]);
            $saveFormData = $sgformModel->save();
            if($saveFormData) {
                $formId = $sgformModel->getId();
                $this->sendEmail($postData);
                $this->_eventManager->dispatch('syncit_group_form', ['ip_address' => $this->remoteAddress->getRemoteAddress(), 'form_id' => $formId]);
                $this->messageManager->addSuccessMessage(
                    __('Thank you for submitting to Syncit Group custom form!​')
                );
                $this->dataPersistor->clear('custom_form');
            } else {
                $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
                );
                $this->dataPersistor->set('custom_form', $this->getRequest()->getParams());    
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('custom_form', $this->getRequest()->getParams());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            $this->dataPersistor->set('custom_form', $this->getRequest()->getParams());
        }
        return $this->_redirect('syncit-group-form');
    }

    /**
     * @param array $post Post data from contact form
     * @return void
     */
    private function sendEmail($post)
    {
        $this->mail->sendEmail(['data' => new DataObject($post)]);
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function validatedParams()
    {
        $request = $this->getRequest();
        if (trim($request->getParam('firstname')) === '') {
            throw new LocalizedException(__('Enter the First Name and try again.'));
        }
        
        if (trim($request->getParam('lastname')) === '') {
            throw new LocalizedException(__('Enter the Last Name and try again.'));
        }

        if (trim($request->getParam('message')) === '') {
            throw new LocalizedException(__('Enter the message and try again.'));
        }

        if (false === \strpos($request->getParam('email'), '@')) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
        
        if (trim($request->getParam('hideit')) !== '') {
            throw new \Exception();
        }

        return $request->getParams();
    }
}
