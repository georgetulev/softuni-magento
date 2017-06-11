<?php

class SoftUni_Exam_Block_Adminhtml_Contestant_Edit extends
    Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'contestant_id';
        $this->_blockGroup = 'exam';
        $this->_controller = 'adminhtml_contestant';

        parent::__construct();
    }

    public function getHeaderText()
    {
        return Mage::helper('exam')->__('Add New');
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/contestant/save', array('_current' => true));
    }
}