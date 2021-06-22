<?php
namespace Hanoikids\Forum\Block\Forum;
class Listing extends \Magento\Framework\View\Element\Template {
	protected $_objectManager;
	protected $_storeManager;
	const STATUS_ENABLED = 1;
	protected $session;
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
	public function getForumCollection() {
		$ForumCollection = $this->_objectManager->create('Hanoikids\Forum\Model\ResourceModel\HanoikidsForum\Collection')
			->addFieldToFilter('status', self::STATUS_ENABLED);
		return $ForumCollection;
	}
	public function getStoreManager() {
		return $this->_storeManager;
	}
	public function getCurrentUserID() {
		$customer = $this->session->create();
		return $customer->getCustomer()->getId();
	}
	public function getMediaUrlImage($imagePath = '') {
		return $this->_storeManager->getStore()
			->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $imagePath;
	}
}
