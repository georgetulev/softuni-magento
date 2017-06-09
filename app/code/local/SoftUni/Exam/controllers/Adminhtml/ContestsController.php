<?php

class SoftUni_Exam_Adminhtml_ContestsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();

        return $this->renderLayout();
    }
}