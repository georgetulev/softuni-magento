<?php

class SoftUni_Exam_Block_Contest extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('exam/contest.phtml');
    }

}