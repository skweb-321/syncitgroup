<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Syncitgroup\Sgform\Model\Data;

use Syncitgroup\Sgform\Api\Data\SgformInterface;

class Sgform extends \Magento\Framework\Api\AbstractExtensibleObject implements SgformInterface
{

    /**
     * Get id
     * @return string|null
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set id
     * @param string $id
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get firstname
     * @return string|null
     */
    public function getFirstname()
    {
        return $this->_get(self::FIRSTNAME);
    }

    /**
     * Set firstname
     * @param string $firstname
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setFirstname($firstname)
    {
        return $this->setData(self::FIRSTNAME, $firstname);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Syncitgroup\Sgform\Api\Data\SgformExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Syncitgroup\Sgform\Api\Data\SgformExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Syncitgroup\Sgform\Api\Data\SgformExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get lastname
     * @return string|null
     */
    public function getLastname()
    {
        return $this->_get(self::LASTNAME);
    }

    /**
     * Set lastname
     * @param string $lastname
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setLastname($lastname)
    {
        return $this->setData(self::LASTNAME, $lastname);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);   
    }

    /**
     * Get message
     * @return string|null
     */
    public function getMessage()
    {
        return $this->_get(self::MESSAGE);
    }

    /**
     * Set message
     * @param string $message
     * @return \Syncitgroup\Sgform\Api\Data\SgformInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);   
    }
}

