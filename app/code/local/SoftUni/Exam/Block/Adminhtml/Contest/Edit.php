<?php

class SoftUni_Exam_Block_Adminhtml_Contest_Edit extends
    Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'contest_id';
        $this->_blockGroup = 'exam';
        $this->_controller = 'adminhtml_contest';

        parent::__construct();
    }

    public function getHeaderText()
    {
        return Mage::helper('exam')->__('New Contest');
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/contest/save', array('_current' => true));
    }
}