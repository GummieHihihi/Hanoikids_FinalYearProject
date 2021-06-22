<?php
namespace Hanoikids\Forum\Block\Forum;
class CreateForum extends \Magento\Framework\View\Element\Template {
	protected $_objectManager;
	protected $_storeManager;
	protected $session;
	const STATUS_ENABLED = 1;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Customer\Model\SessionFactory $session,
		array $data
	) {
		$this->_objectManager = $objectManager;
		$this->_storeManager = $context->getStoreManager();
		parent::__construct($context, $data);
		$this->session = $session;
	}
	public function getCurrentUserID() {
		$customer = $this->session->create();
		return $customer->getCustomer()->getId();
	}
	public function getStoreManager() {
		return $this->_storeManager;
	}
	public function getMediaUrlImage($imagePath = '') {
		return $this->_storeManager->getStore()
			->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $imagePath;
	}
}
