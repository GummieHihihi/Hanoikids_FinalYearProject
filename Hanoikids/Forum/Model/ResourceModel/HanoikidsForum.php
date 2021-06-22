<?php
namespace Hanoikids\Forum\Model\ResourceModel;
/**
 * Class Vendor
 * @package Magestore\Multivendor\Model\ResourceModel
 */
class HanoikidsForum extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    protected function _construct()	{
        $this->_init('hanoikids_forum', 'forum_id');
    }
}