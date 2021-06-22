<?php
namespace Hanoikids\Forum\Controller\Forum;
class Create extends \Magento\Framework\App\Action\Action {
	public function execute() {
		$this->_view->loadLayout();
		$this->_view->renderLayout();
	}
}
