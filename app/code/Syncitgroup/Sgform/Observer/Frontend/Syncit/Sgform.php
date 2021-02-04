<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Syncitgroup\Sgform\Observer\Frontend\Syncit;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class Sgform implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * @var DirectoryList
     */
    private $directoryList;
 
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(
        \Magento\Framework\Filesystem $filesystem,
        DirectoryList $directoryList
    ) {
        $this->filesystem = $filesystem;
        $this->directoryList = $directoryList;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $ipAddress = $observer->getData('ip_address');
        $formId = $observer->getData('form_id');
        $pubDirectory = $this->filesystem->getDirectoryWrite(
            DirectoryList::PUB
        );
        $pubPath = $this->directoryList->getPath('pub');
        $fileName = 'syncitgroup_sgform.txt';
        $path = $pubPath . '/' . $fileName;
        $content = $formId.'-'.$ipAddress."\r\n";
        $this->writetoFile($pubDirectory, $path, $content);
        return $this;
    }

     /**
     * Write content to text file
     *
     * @param WriteInterface $writeDirectory
     * @param $filePath
     * @return bool
     * @throws FileSystemException
     */
    public function writetoFile(WriteInterface $writeDirectory, string $filePath, $content)
    {
        $mode = !(file_exists($filePath)) ? 'w+' : 'a';
        $stream = $writeDirectory->openFile($filePath, $mode);
        $stream->lock();
        $stream->write($content);
        $stream->unlock();
        $stream->close();
 
        return true;
    }
}

