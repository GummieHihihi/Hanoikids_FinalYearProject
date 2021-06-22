<?php
namespace Hanoikids\Forum\Block\Forum;
use Magento\Framework\App\Http\Context as AuthContext;

class View extends \Magento\Framework\View\Element\Template {
	protected $_objectManager;
	protected $_storeManager;
	const STATUS_ENABLED = 1;
	protected $session;
	protected $authContext;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		array $data,
		\Magento\Customer\Model\Session $session,
		AuthContext $authContext
	) {
		$this->_objectManager = $objectManager;
		$this->_storeManager = $context->getStoreManager();
		parent::__construct($context, $data);
		$this->session = $session;
		$this->authContext = $authContext;
	}
	public function getForumCollection() {
		$id = $this->getRequest()->getParam('id');
		$ForumCollection = $this->_objectManager->create('Hanoikids\Forum\Model\ResourceModel\HanoikidsForum\Collection')
			->addFieldToFilter('status', self::STATUS_ENABLED)->addFieldToFilter('forum_id', $id);
		return $ForumCollection;
	}

	public function getStoreManager() {
		return $this->_storeManager;
	}
	public function getMediaUrlImage($imagePath = '') {
		return $this->_storeManager->getStore()
			->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $imagePath;
	}

	public function getLikeNumber($forumID) {
		$forumLike_collection = $this->_objectManager->create('Hanoikids\Forum\Model\ResourceModel\ForumLike\Collection');

		$likes = $forumLike_collection->addFieldToFilter('forum_id', $forumID)
			->addFieldToFilter('status', '1');

		return $likes_number = sizeof($likes->getData());

	}

	public function getDislikeNumber($forumID) {
		$forumLike_collection = $this->_objectManager->create('Hanoikids\Forum\Model\ResourceModel\ForumLike\Collection');
		$dislikes = $forumLike_collection->addFieldToFilter('forum_id', $forumID)->addFieldToFilter('status', 2);
		return $dislike_number = sizeof($dislikes->getData());
	}

	public function getUserStatus() {
		$isLoggedIn = $this->authContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
		if ($isLoggedIn == true) {
			return 1;
		} else {
			return 2;
		}
	}

	public function getForumLike($userID, $forumID) {
		$forumLike_collection = $this->_objectManager->create('Hanoikids\Forum\Model\ResourceModel\ForumLike\CollectionFactory')->create();
		$forumLikeInfo = $forumLike_collection->addFieldToFilter('forum_id', $forumID)->addFieldToFilter('customer_id', $userID)->getData();
		return $forumLikeInfo;
	}

	public function getForumComment($forumID) {
		$forumComment_collection = $this->_objectManager->create('Hanoikids\Forum\Model\ResourceModel\ForumComment\CollectionFactory');
		return $forumComment_collection->create()->addFieldToFilter('forum_id', $forumID);
	}

	public function getCurrentUserID() {
		return $this->session->getCustomer()->getId();
	}

	public function getBaseUrl() {
		return $this->_storeManager->getStore()->getBaseUrl();
	}
}
