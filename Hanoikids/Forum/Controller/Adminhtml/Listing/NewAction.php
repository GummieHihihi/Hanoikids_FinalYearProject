<?php

namespace Hanoikids\Forum\Controller\Adminhtml\Listing;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class NewAction
 * @package Magestore\Multivendor\Controller\Adminhtml\Vendor
 */
class NewAction extends \Hanoikids\Forum\Controller\Adminhtml\Vendor
{
    /**
     * @return mixed
     */
    public function execute()
    {
    	
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        return $resultForward->forward('edit');
    }
}