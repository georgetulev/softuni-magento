<?php

class SoftUni_Exam_Block_Adminhtml_Contest_Grid extends
    Mage_Adminhtml_Block_Widget_Grid
{
    public function getRowUrl($item)
    {
        return $this->getUrl('*/contest/edit', array('contest_id' => $item->getId()));
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('softuni_exam/contest')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('title',
            array(
                'type' => 'text',
                'index' => 'title',
                'header' => $this->__('Title')
            )
        );

        $this->addColumn('is_active',
            array(
                'header' => $this->__('Status'),
                'type'=>'options',
                'options' => array('1' => 'Active', '0' => 'Inactive'),
                'index' => 'is_active',
                'width' => '80px',
                'align' => 'left'
            )
        );

        $this->addColumn('start_date',
            array(
                'type' => 'date',
                'index' => 'start_date',
                'header' => $this->__('Start Date')
            )
        );

        $this->addColumn('end_date',
            array(
                'type' => 'date',
                'index' => 'end_date',
                'header' => $this->__('End Date')
            )
        );

        return $this;
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('contest_id');
        $this->getMassactionBlock()->setFormFieldName('contest_ids');

        $this->getMassactionBlock()->addItem('delete_event',
            array(
                'label'   => Mage::helper('exam')->__('Delete'),
                'url'     => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('exam')->__('Sure?'),
            )
        );

        $this->getMassactionBlock()->addItem('activate_event',
            array(
                'label'   => Mage::helper('exam')->__('Activate'),
                'url'     => $this->getUrl('*/*/massStatusToggle?status=1'),
            )
        );

        $this->getMassactionBlock()->addItem('deactivate_event',
            array(
                'label'   => Mage::helper('exam')->__('Deactivate'),
                'url'     => $this->getUrl('*/*/massStatusToggle?status=0'),
            )
        );

        return $this;
    }
}

















