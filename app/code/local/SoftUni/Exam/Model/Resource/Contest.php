<?php


class SoftUni_Exam_Model_Resource_Contest extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('softuni_exam/contest', 'contest_id');
    }
}