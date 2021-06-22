<?php
// namespace Hanoikids\Forum\Controller\Forum;
// class Like extends \Magento\Framework\App\Action\Action {
// 	public function execute() {
// 		$data = $this->getRequest()->getPost()['hasCustomerLike'];

// 		die(var_dump($data));
// 		$this->_view->loadLayout();
// 		$this->_view->renderLayout();
// 	}
// }
?>
<?php
namespace Hanoikids\Forum\Controller\Forum;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Like extends Action {
	protected $objectManager;
	protected $request;
	public function __construct(Context $context,
		\Magento\Framework\ObjectManagerInterface $objectManager) {
		parent::__construct($context);
		$this->objectManager = $objectManager;
	}

	public function execute() {
		if ($this->getRequest()->getPost()):
			$postData = $this->getRequest()->getPost();
			$customerLikeId = $postData['customerLikeId'];
			$button = $postData['button'];
			$like_model = $this->objectManager->create('Hanoikids\Forum\Model\ForumLike')->load($customerLikeId);
			$forumID = $like_model->getForum_id();
			$currentLikeStatus = $like_model->getStatus();
			//if customer press like button
			if ($button == "like") {

				//change status of this like in the like database
				//1 mean customer has like, 2 mean has dislike, 0 mean not like or dislike
				if ($currentLikeStatus == 1) {
					$like_model->setData('status', 0);
					$currentLikeStatus = 0;

				} else {
					$like_model->setData('status', 1);
					$currentLikeStatus = 1;
				}
				$like_model->save();
				//update back the current status for the frontlike, like and dislike number as well.
				//get like and dislike number :

			} else if ($button == "dislike") {
			//change status of this dislike in the like database
			if ($currentLikeStatus == 2) {
				$like_model->setData('status', 0);
				$currentLikeStatus = 0;

			} else {
				$like_model->setData('status', 2);
				$currentLikeStatus = 2;
			}
			$like_model->save();
		}
		//customer press comment
		else {

			}

			$likeCollection = $collection = $this->_objectManager->create('Hanoikids\Forum\Model\ResourceModel\ForumLike\CollectionFactory');
			$likeNumber = sizeof($likeCollection->create()->addFieldToFilter('forum_id', $forumID)->addFieldToFilter('status', 1));
			$dislikeNumber = sizeof($likeCollection->create()->addFieldToFilter('forum_id', $forumID)->addFieldToFilter('status', 2));
			$dataBack =
				['currentLikeStatus' => $currentLikeStatus,
				'likeNumber' => $likeNumber,
				'dislikeNumber' => $dislikeNumber];
			$resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
			$resultJson->setData($dataBack);
			return $resultJson;
		endif;
	}
}