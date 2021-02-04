<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Syncitgroup\Sgform\Controller\Adminhtml;

abstract class Sgform extends \Magento\Backend\App\Action
{

    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu("Syncitgroup_Sgform::syncitgroup_sgform_sgform")
            ->addBreadcrumb(__('Syncitgroup'), __('Syncitgroup'))
            ->addBreadcrumb(__('Custom form'), __('Custom form'));
        return $resultPage;
    }
}

