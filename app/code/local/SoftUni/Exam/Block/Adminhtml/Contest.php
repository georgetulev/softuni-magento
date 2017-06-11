<?php

class SoftUni_Exam_Block_Adminhtml_Contest extends
    Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'exam';
        $this->_controller = 'adminhtml_contest';
        $this->_headerText = Mage::helper('exam')->__('Contests');
        $this->_addButtonLabel = Mage::helper('exam')->__('Add New Contest');
        parent::__construct();
    }
}