<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Syncitgroup\Sgform\Model;

use Magento\Framework\Api\DataObjectHelper;
use Syncitgroup\Sgform\Api\Data\SgformInterface;
use Syncitgroup\Sgform\Api\Data\SgformInterfaceFactory;

class Sgform extends \Magento\Framework\Model\AbstractModel
{

    protected $sgformDataFactory;

    protected $_eventPrefix = 'syncitgroup_sgform_data';
    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param SgformInterfaceFactory $sgformDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Syncitgroup\Sgform\Model\ResourceModel\Sgform $resource
     * @param \Syncitgroup\Sgform\Model\ResourceModel\Sgform\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        SgformInterfaceFactory $sgformDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Syncitgroup\Sgform\Model\ResourceModel\Sgform $resource,
        \Syncitgroup\Sgform\Model\ResourceModel\Sgform\Collection $resourceCollection,
        array $data = []
    ) {
        $this->sgformDataFactory = $sgformDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve sgform model with sgform data
     * @return SgformInterface
     */
    public function getDataModel()
    {
        $sgformData = $this->getData();
        
        $sgformDataObject = $this->sgformDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $sgformDataObject,
            $sgformData,
            SgformInterface::class
        );
        
        return $sgformDataObject;
    }
}

