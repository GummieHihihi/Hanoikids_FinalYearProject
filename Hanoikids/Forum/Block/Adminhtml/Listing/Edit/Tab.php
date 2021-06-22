<?php

namespace Hanoikids\Forum\Block\Adminhtml\Listing\Edit;

/**
 * Class Tabs
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor\Edit
 */
class Tab extends \Magento\Backend\Block\Widget\Tabs {

	/**
	 *
	 */
	protected function _construct() {
		parent::_construct();
		$this->setId('rewardpointadmin_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Forum Information: '));
	}

	/**
	 * @return $this
	 * @throws \Exception
	 * @throws \Magento\Framework\Exception\LocalizedException
	 */
	protected function _beforeToHtml() {

		$this->addTab(
			'hanoikidsforum_form',
			[
				'label' => __('Forum Information:'),
				'title' => __('General'),
				'content' => $this->getLayout()->createBlock('Hanoikids\Forum\Block\Adminhtml\Listing\Edit\Tab\Form')
					->toHtml(),
				'active' => true,
			]
			//day moi la dan den noi dung cuar form

		);

		return parent::_beforeToHtml();
	}

}