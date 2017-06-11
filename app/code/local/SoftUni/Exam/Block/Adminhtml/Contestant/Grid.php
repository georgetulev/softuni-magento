<?php

class SoftUni_Exam_Block_Adminhtml_Contestant_Grid extends
    Mage_Adminhtml_Block_Widget_Grid
{
    public function getRowUrl($item)
    {
        return $this->getUrl('*/contestant/edit', array('contestant_id' => $item->getId()));
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('softuni_exam/contestant')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('Name',
            array(
                'type' => 'text',
                'index' => 'first_name',
                'header' => $this->__('Name')
            )
        );

        $this->addColumn('approved',
            array(
                'header' => $this->__('Status'),
                'type'=>'options',
                'options' => array('1' => 'yes', '0' => 'no'),
                'index' => 'approved',
                'width' => '80px',
                'align' => 'left'
            )
        );

        return $this;
    }
}