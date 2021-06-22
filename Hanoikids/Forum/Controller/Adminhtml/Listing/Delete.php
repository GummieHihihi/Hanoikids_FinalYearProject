<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Multivendor
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */
namespace Hanoikids\Forum\Controller\Adminhtml\Listing;

class Delete extends \Hanoikids\Forum\Controller\Adminhtml\Vendor
{
    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();
        $vendorId = $this->getRequest()->getParam('id');

        // die(var_dump($vendorId));
        
        if ($vendorId > 0) {
            $modelForum = $this->_objectManager->create('Hanoikids\Forum\Model\HanoikidsForum')
                ->load($this->getRequest()->getParam('id'));
            try {
                $modelForum->delete();
                $this->messageManager->addSuccess(__('this rule was successfully deleted'));

            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['_current' => true]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}