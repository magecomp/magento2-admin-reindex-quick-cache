<?php

namespace Magecomp\Quickcachereindex\Controller\Adminhtml\Tools;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool;
use \Psr\Log\LoggerInterface;

class Cache extends Action
{
    protected $typeListInterface;
    protected $pool;
    protected $logger;

    public function __construct(
        TypeListInterface $typeListInterface,
        Pool $pool,
        Context $context,
        LoggerInterface $logger
    )
    {
        $this->typeListInterface = $typeListInterface;
        $this->pool = $pool;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $_cacheTypeList = $this->typeListInterface;

            $_cacheFrontendPool = $this->pool;

            $types = array('full_page');

            foreach ($types as $type) {
                $_cacheTypeList->cleanType($type);
            }
            foreach ($_cacheFrontendPool as $cacheFrontend) {
                $cacheFrontend->getBackend()->clean();
            }
            $this->messageManager->addSuccess(__('The Magento cache storage has been flushed.'));
            return $this->resultRedirectFactory->create()->setUrl($this->_redirect->getRedirectUrl());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

    }

}
