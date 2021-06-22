<?php
namespace Hanoikids\Forum\Model\ResourceModel\ForumComment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	protected $_idFieldName = 'ID';
	public function _construct() {
		parent::_construct();
		$this->_init('Hanoikids\Forum\Model\ForumComment', 'Hanoikids\Forum\Model\ResourceModel\ForumComment');
	}
}