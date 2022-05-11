<?php

namespace Magecomp\Quickcachereindex\Block\Adminhtml;

class Quickcachereindexsbuttons extends \Magento\Backend\Block\Template
{
    protected $helperData;
    protected $formKey;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magecomp\Quickcachereindex\Helper\Data $helperData,
        \Magento\Framework\Data\Form\FormKey $formKey,
        array $data = []
    )
    {
        $this->_storeManager = $storeManager;
        $this->helperData = $helperData;
        $this->formKey = $formKey;
        parent::__construct($context, $data);
    }

    public function isEnabled()
    {
        return $this->helperData->isEnabled();
    }

    public function getIndexing()
    {
        return $this->helperData->getIndexing();
    }

    public function getCleaning()
    {
        return $this->helperData->getCleaning();
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getFormsUrl()
    {
        return $this->getUrl('quickcachereindex/tools/indexing');
    }

    public function getCleanUrl()
    {
        return $this->getUrl('quickcachereindex/tools/cache');
    }

    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
}
