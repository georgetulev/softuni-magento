<?php

class SoftUni_Statistics_Model_Options
{
    public function toOptionArray()
    {
        return array(
            array('value'=>1, 'label'=>Mage::helper('statistics')->__('Enabled')),
            array('value'=>2, 'label'=>Mage::helper('statistics')->__('Disabled')),
        );
    }
}