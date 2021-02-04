<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Syncitgroup\Sgform\Api\Data;

interface SgformSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Sgform list.
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface[]
     */
    public function getItems();

    /**
     * Set firstname list.
     * @param \Syncitgroup\Sgform\Api\Data\SgformInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

