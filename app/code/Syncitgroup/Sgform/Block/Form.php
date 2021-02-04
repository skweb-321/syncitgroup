<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Syncitgroup\Sgform\Block;

use Magento\Framework\View\Element\Template;

/**
 * Custom form block
 */
class Form extends Template
{
    /**
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Returns action url for custom form
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('syncitgroup/sgform/post', ['_secure' => true]);
    }
}
