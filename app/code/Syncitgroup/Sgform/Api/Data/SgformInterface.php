<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Syncitgroup\Sgform\Api\Data;

interface SgformInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ID = 'id';
    const FIRSTNAME = 'firstname';
    const LASTNAME = 'lastname';
    const EMAIL = 'email';
    const MESSAGE = 'message';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setId($id);

    /**
     * Get firstname
     * @return string|null
     */
    public function getFirstname();

    /**
     * Set firstname
     * @param string $firstname
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setFirstname($firstname);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Syncitgroup\Sgform\Api\Data\SgformExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Syncitgroup\Sgform\Api\Data\SgformExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Syncitgroup\Sgform\Api\Data\SgformExtensionInterface $extensionAttributes
    );

    /**
     * Get lastname
     * @return string|null
     */
    public function getLastname();

    /**
     * Set lastname
     * @param string $lastname
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setLastname($lastname);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setEmail($email);

    /**
     * Get message
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     * @param string $message
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setMessage($message);
}

