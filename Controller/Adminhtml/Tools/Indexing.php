<?php

namespace Magecomp\Quickcachereindex\Controller\Adminhtml\Tools;
class Indexing extends \Magento\Backend\App\Action
{
    protected $indexFactory;
    protected $indexCollection;
    protected $logger;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Indexer\Model\IndexerFactory $indexFactory,
        \Magento\Indexer\Model\Indexer\CollectionFactory $indexCollection,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->indexFactory = $indexFactory;
        $this->indexCollection = $indexCollection;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $indexerCollection = $this->indexCollection->create();
            $indexids = $indexerCollection->getAllIds();
            $collectionSize = count($indexids);
            foreach ($indexids as $indexid) {
                $indexidarray = $this->indexFactory->create()->load($indexid);
                $indexidarray->reindexAll($indexid);
            }
            $this->messageManager->addSuccess(__('A total of %1 record(s) Indexing is completed.', $collectionSize));
            return $this->resultRedirectFactory->create()->setUrl($this->_redirect->getRedirectUrl());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
