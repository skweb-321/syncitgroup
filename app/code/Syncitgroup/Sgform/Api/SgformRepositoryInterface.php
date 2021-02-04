<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Syncitgroup\Sgform\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SgformRepositoryInterface
{

    /**
     * Save Sgform
     * @param \Syncitgroup\Sgform\Api\Data\SgformInterface $sgform
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Syncitgroup\Sgform\Api\Data\SgformInterface $sgform
    );

    /**
     * Retrieve Sgform
     * @param string $sgformId
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($sgformId);

    /**
     * Retrieve Sgform matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Syncitgroup\Sgform\Api\Data\SgformSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Sgform
     * @param \Syncitgroup\Sgform\Api\Data\SgformInterface $sgform
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Syncitgroup\Sgform\Api\Data\SgformInterface $sgform
    );

    /**
     * Delete Sgform by ID
     * @param string $sgformId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($sgformId);
}

