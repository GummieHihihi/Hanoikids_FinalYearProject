<?php

namespace Hanoikids\Forum\Controller\Adminhtml\Listing;

class Index extends \Hanoikids\Forum\Controller\Adminhtml\Vendor {
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute() {
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Forum Request')));
		// die('123');
		return $resultPage;
	}

}