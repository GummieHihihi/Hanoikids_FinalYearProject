<?php

namespace Hanoikids\Forum\Observer;

class UpdateForum implements \Magento\Framework\Event\ObserverInterface {
	public $_customerFactory;
	public $_customer;

	public function __construct(
		\Magento\Customer\Model\CustomerFactory $customerFactory,
		\Magento\Customer\Model\Customer $customers
	) {

		$this->_customerFactory = $customerFactory;
		$this->_customer = $customers;
	}
	public function execute(\Magento\Framework\Event\Observer $observer) {

		$data = $observer->getData('forum_data');
		// die(var_dump($data));
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		// die(var_dump($this->getCustomerCollection()->getData()));
		$customerData = $this->getCustomerCollection()->getData();
		// for ($i = 0; $i < sizeof($this->getCustomerCollection()->getData()); $i++) {
		// 	$forumLike_model->setData('customer_id', $customer[$i]['entity_id']);
		// 	$forumLike_model->setData('status', 0);
		// 	$forumLike_model->setData('forum_id', $data['forum_id']);
		// 	$forumLike_model->save();
		// }
		foreach ($this->getCustomerCollection()->getData() as $customer) {
			$forumLike_model = $objectManager->create('Hanoikids\Forum\Model\ForumLike');
			// die(var_dump($customer->getEntity_id()));
			$forumLike_model->setData('customer_id', $customer['entity_id']);
			$forumLike_model->setData('status', 0);
			$forumLike_model->setData('forum_id', $data['forum_id']);
			$forumLike_model->save();
		}

		// die(var_dump($this->getCustomerCollection()->getData()));
		return $this;
	}

	//get all id of all customer
	public function getCustomerCollection() {
		return $this->_customer->getCollection()
			->addAttributeToSelect("*")
			->load();
	}
}
