<?php

class SoftUni_Exam_Block_Contests extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('exam/contests.phtml');
    }

}