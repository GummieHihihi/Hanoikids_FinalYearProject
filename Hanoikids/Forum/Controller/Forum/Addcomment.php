<?php
namespace Hanoikids\Forum\Controller\Forum;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Addcomment extends Action {
	protected $objectManager;
	protected $request;
	protected $resultFactory;
	protected $userFactory;
	public function __construct(Context $context,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Customer\Model\CustomerFactory $userFactory,
		ResultFactory $resultFactory) {
		parent::__construct($context);
		$this->objectManager = $objectManager;
		$this->resultFactory = $resultFactory;
		$this->userFactory = $userFactory;
	}

	public function execute() {
		if ($this->getRequest()->getPost()):
			// die(var_dump('in controller'));
			$postData = $this->getRequest()->getPost();
			$comment_model = $this->objectManager->create('Hanoikids\Forum\Model\ForumComment');

			$comment_model->setData('content', $postData['content']);
			$comment_model->setData('customer_id', $postData['userID']);
			$comment_model->setData('forum_id', $postData['forumID']);
			$comment_model->save();
			// $customer = $this->objectManager->get('Magento\Customer\Api\CustomerRepositoryInterface')->getById($postData['userID']);
			// $cusstomerName = $customer->getFirstName() . " " . $customer->getLastName();

			// $returnData =
			// 	['content' => '1',
			// 	'customerName' => '2'];
			// $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
			// $resultJson->setData($returnData);
			// return $resultJson;

			$returnContent = $postData['content'];

			$userData = $this->userFactory->create()->load($postData['userID'])->getData();
			// die(var_dump($userData));
			$returnUserName = $userData['firstname'] . " " . $userData['lastname'];
			$dataBack = [
				'userName' => $returnUserName,
				'content' => $returnContent];
			$resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
			$resultJson->setData($dataBack);
			return $resultJson;
		endif;
	}
}