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

        $this->addColumn('LastName',
            array(
                'type' => 'text',
                'index' => 'last_name',
                'header' => $this->__('Last Name')
            )
        );
        $this->addColumn('Country',
            array(
                'type' => 'text',
                'index' => 'country',
                'header' => $this->__('Country')
            )
        );
        $this->addColumn('City',
            array(
                'type' => 'text',
                'index' => 'city',
                'header' => $this->__('Name')
            )
        );

        $this->addColumn('Mail',
            array(
                'type' => 'text',
                'index' => 'email',
                'header' => $this->__('Mail')
            )
        );

        $this->addColumn('approved',
            array(
                'header' => $this->__('Approved'),
                'type'=>'options',
                'options' => array('0' => 'NOT YET', '1' => 'YES' ),
                'index' => 'approved',
                'width' => '80px',
                'align' => 'left'
            )
        );

        return $this;
    }

    public function _prepareMassaction()
    {
        $this->setMassactionIdField('contestant_id');
        $this->getMassactionBlock()->setFormFieldName('contestant_ids');

        $this->getMassactionBlock()->addItem('delete_event', array(
            'label' => Mage::helper('exam')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('exam')->__('R U Sure?')
        ));

        return $this;
    }
}