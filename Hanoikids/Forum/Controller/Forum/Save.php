<?php
namespace Hanoikids\Forum\Controller\Forum;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Event\ManagerInterface as EventManager;

class Save extends Action {
	protected $objectManager;
	protected $request;
	const BASE_MEDIA_PATH = 'Hanoikids/Forum/images';
	protected $_imageHelper;
	private $eventManager;
	public function __construct(Context $context,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Hanoikids\Forum\Helper\Image $imageHelper,
		EventManager $eventManager) {
		parent::__construct($context);
		$this->objectManager = $objectManager;
		$this->_imageHelper = $imageHelper;
		$this->eventManager = $eventManager;
	}

	public function execute() {
		if ($this->getRequest()->getPost()):
			$postData = $this->getRequest()->getPost();
			// $demo = (array) $this->getRequest()->getFiles();
			// die(var_dump($postData));
			$forumModel = $this->objectManager->create('Hanoikids\Forum\Model\HanoikidsForumFactory')->create();
			// die(var_dump($postData));
			$forumModel->setData('content', $postData['Content']);
			$forumModel->setData('customer_id', $postData['userID']);
			$forumModel->setData('header', $postData['header']);
			$forumModel->setData('status', 2);
			$this->_imageHelper->mediaUploadImage($forumModel, 'attachments', self::BASE_MEDIA_PATH, true);
			// die('still ok ');
			$forumModel->save();
			// die('still ok ');
			$collection = $this->objectManager->create('Hanoikids\Forum\Model\ResourceModel\HanoikidsForum\Collection');
			$lastItem = $collection->getLastItem()->getData();
			// die(var_dump($lastItem));
			$this->eventManager->dispatch('afterCreateForum', ['forum_data' => $lastItem]);

			$resultRedirect = $this->resultRedirectFactory->create();
			return $resultRedirect->setPath('*/*/listing');
		endif;
	}
}