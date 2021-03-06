<?php

namespace Hanoikids\Forum\Block\Adminhtml\Listing\Edit;

/**
 * Class Form
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor\Edit
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        //khai bao thuoc tinh post cua cai form o lop tren
        $form = $this->_formFactory->create(
            array(
                'data' => array(
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', ['store' => $this->getRequest()->getParam('store')]),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                )
            )
        );
        //day chi la noi dung phuong thuc cua form thoi 
        
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}