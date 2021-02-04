<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Syncitgroup\Sgform\Model;

/**
 * Custom form configuration
 */
interface ConfigInterface
{
    /**
     * Sender email config path
     */
    const EMAIL = 'syncit/options/sgform_extension_email';

    /**
     * Enabled config path
     */
    const EXTENSION_STATUS = 'syncit/options/sgform_extension_status';

    /**
     * Check if module is enabled
     */
    public function isEnabled();

    /**
     * Return email address
     */
    public function email();
}
