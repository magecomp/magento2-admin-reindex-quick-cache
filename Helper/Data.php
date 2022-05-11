<?php

namespace Magecomp\Quickcachereindex\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $_storeManager;
    const QUICKCACHEREINDEX_GENRAL_ENABLED = 'quickcachereindex/general/enable';
    const QUICKCACHEREINDEX_GENRAL_INDEXING = 'quickcachereindex/general/indexing';
    const QUICKCACHEREINDEX_GENRAL_CLEANING = 'quickcachereindex/general/cleaning';

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    )
    {
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function isEnabled()
    {
        $store = $this->_storeManager->getStore();
        $configValue = $this->scopeConfig->getValue(
            self::QUICKCACHEREINDEX_GENRAL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
        return $configValue;
    }

    public function getIndexing()
    {
        $store = $this->_storeManager->getStore();
        $configValue = $this->scopeConfig->getValue(
            self::QUICKCACHEREINDEX_GENRAL_INDEXING,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
        return $configValue;
    }

    public function getCleaning()
    {
        $store = $this->_storeManager->getStore();
        $configValue = $this->scopeConfig->getValue(
            self::QUICKCACHEREINDEX_GENRAL_CLEANING,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
        return $configValue;
    }

}
