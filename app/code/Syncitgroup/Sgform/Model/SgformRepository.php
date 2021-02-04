<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Syncitgroup\Sgform\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Syncitgroup\Sgform\Api\Data\SgformInterfaceFactory;
use Syncitgroup\Sgform\Api\Data\SgformSearchResultsInterfaceFactory;
use Syncitgroup\Sgform\Api\SgformRepositoryInterface;
use Syncitgroup\Sgform\Model\ResourceModel\Sgform as ResourceSgform;
use Syncitgroup\Sgform\Model\ResourceModel\Sgform\CollectionFactory as SgformCollectionFactory;

class SgformRepository implements SgformRepositoryInterface
{

    private $storeManager;

    protected $dataObjectProcessor;

    private $collectionProcessor;

    protected $sgformCollectionFactory;

    protected $extensibleDataObjectConverter;
    protected $dataSgformFactory;

    protected $sgformFactory;

    protected $searchResultsFactory;

    protected $extensionAttributesJoinProcessor;

    protected $resource;

    protected $dataObjectHelper;


    /**
     * @param ResourceSgform $resource
     * @param SgformFactory $sgformFactory
     * @param SgformInterfaceFactory $dataSgformFactory
     * @param SgformCollectionFactory $sgformCollectionFactory
     * @param SgformSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceSgform $resource,
        SgformFactory $sgformFactory,
        SgformInterfaceFactory $dataSgformFactory,
        SgformCollectionFactory $sgformCollectionFactory,
        SgformSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->sgformFactory = $sgformFactory;
        $this->sgformCollectionFactory = $sgformCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSgformFactory = $dataSgformFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Syncitgroup\Sgform\Api\Data\SgformInterface $sgform
    ) {
        /* if (empty($sgform->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $sgform->setStoreId($storeId);
        } */
        
        $sgformData = $this->extensibleDataObjectConverter->toNestedArray(
            $sgform,
            [],
            \Syncitgroup\Sgform\Api\Data\SgformInterface::class
        );
        
        $sgformModel = $this->sgformFactory->create()->setData($sgformData);
        
        try {
            $this->resource->save($sgformModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sgform: %1',
                $exception->getMessage()
            ));
        }
        return $sgformModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($sgformId)
    {
        $sgform = $this->sgformFactory->create();
        $this->resource->load($sgform, $sgformId);
        if (!$sgform->getId()) {
            throw new NoSuchEntityException(__('Sgform with id "%1" does not exist.', $sgformId));
        }
        return $sgform->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sgformCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Syncitgroup\Sgform\Api\Data\SgformInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Syncitgroup\Sgform\Api\Data\SgformInterface $sgform
    ) {
        try {
            $sgformModel = $this->sgformFactory->create();
            $this->resource->load($sgformModel, $sgform->getSgformId());
            $this->resource->delete($sgformModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Sgform: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($sgformId)
    {
        return $this->delete($this->get($sgformId));
    }
}

