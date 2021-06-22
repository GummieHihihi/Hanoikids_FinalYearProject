<?php
namespace Hanoikids\Forum\Model\ResourceModel\ForumLike;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
    protected $_idFieldName = 'ID';
    public function _construct(){
        parent::_construct();
        $this->_init('Hanoikids\Forum\Model\ForumLike', 'Hanoikids\Forum\Model\ResourceModel\ForumLike');
    }
}