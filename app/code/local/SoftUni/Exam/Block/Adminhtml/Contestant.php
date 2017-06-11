<?php

class SoftUni_Exam_Block_Adminhtml_Contestant extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'exam';
        $this->_controller = 'adminhtml_contestant';
        $this->_headerText = Mage::helper('exam')->__('Contestants Info');
        $this->_addButtonLabel = Mage::helper('exam')->__('Add Someone New');
        parent::__construct();
    }

}