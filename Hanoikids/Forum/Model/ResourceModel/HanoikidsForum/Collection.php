<?php
namespace Hanoikids\Forum\Model\ResourceModel\HanoikidsForum;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
    protected $_idFieldName = 'forum_id';
    public function _construct(){
        parent::_construct();
        $this->_init('Hanoikids\Forum\Model\HanoikidsForum', 'Hanoikids\Forum\Model\ResourceModel\HanoikidsForum');
    }
}