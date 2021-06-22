<?php
namespace Hanoikids\Forum\Controller\Adminhtml\Listing;
use Magento\Framework\Event\ManagerInterface as EventManager;

class Save extends \Hanoikids\Forum\Controller\Adminhtml\Vendor {
	protected $_imageHelper;
	const BASE_MEDIA_PATH = 'Hanoikids/Forum/images';
	private $eventManager;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Hanoikids\Forum\Helper\Image $imageHelper,
		EventManager $eventManager) {
		parent::__construct($context);
		$this->_imageHelper = $imageHelper;
		$this->eventManager = $eventManager;

	}

	public function execute() {
		$data = $this->getRequest()->getPostValue();
		$forum_id = (int) $this->getRequest()->getParam('forum_id');
		$resultRedirect = $this->resultRedirectFactory->create();

		if ($data) {
			if ($forum_id) {

				$forum_model = $this->_objectManager->create('Hanoikids\Forum\Model\HanoikidsForum')->load($forum_id);
				// die('123');
			} else {

				$forum_model = $this->_objectManager->create('Hanoikids\Forum\Model\HanoikidsForum');
			}
			// die(var_dump($forum_model->load('1')->getData()));
			//  die(var_dump($data));
			$forum_model->setData('customer_id', $data['customer_id']);
			$forum_model->setData('status', $data['status']);
			$forum_model->setData('content', $data['content']);
			$forum_model->setData('header', $data['header']);
			$this->_imageHelper->mediaUploadImage($forum_model, 'attachments', self::BASE_MEDIA_PATH, true);
			$forum_model->save();

			$collection = $this->_objectManager->create('Hanoikids\Forum\Model\ResourceModel\HanoikidsForum\Collection');
			$lastItem = $collection->getLastItem()->getData();
			// die(var_dump($lastItem));
			$this->eventManager->dispatch('afterCreateForum', ['forum_data' => $lastItem]);

			if ($this->getRequest()->getParam('back') == 'edit') {
				return $resultRedirect->setPath('*/*/edit', ['id' => $vendor_model->getId()]);
			}

			return $resultRedirect->setPath('*/*/');
		}
	}
}
