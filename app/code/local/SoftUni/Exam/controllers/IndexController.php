<?php

class SoftUni_Exam_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
//        var_dump('etooo');
//        die();

        $this->loadLayout();

        return $this->renderLayout();
    }

}