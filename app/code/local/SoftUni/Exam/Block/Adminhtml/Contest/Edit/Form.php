<?php

class SoftUni_Exam_Block_Adminhtml_Contest_Edit_Form extends
    Mage_Adminhtml_Block_Widget_Form
{
    protected function _initFormValues()
    {
        // edit existing contests
        if($contest = Mage::registry('current_contest')) {
            $data = $contest->getData();
            $this->getForm()->setValues($data);
        }

        // keep data if post has failed
        if($data = Mage::getSingleton('adminhtml/session')->getData('contest_form_data', true)){
            $this->getForm()->setValues($data);
        }
    }

    public function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );

        $fieldset = $form->addFieldset(
            'base_fieldset',
            array('legend' => Mage::helper('exam')->__('General Information'), 'class' => 'fieldset-wide'));

        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => Mage::helper('exam')->__('Contest Title'),
            'title' => Mage::helper('exam')->__('Contest Title'),
            'required' => true
        ));

        $fieldset->addField('description', 'textarea', array(
            'name' => 'description',
            'label' => Mage::helper('exam')->__('Description'),
            'title' => Mage::helper('exam')->__('Description'),
            'required' => false
        ));

        $fieldset->addField('status', 'select', array(
            'name' => 'is_active',
            'label' => Mage::helper('exam')->__('Status'),
            'title' => Mage::helper('exam')->__('Status'),
            'required' => false,
            'values'    => ['active', 'inactive'],
        ));

        $dateFormatIso = Mage::app()
            ->getLocale()
            ->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

        $fieldset->addField('start_date', 'date', array(
            'name' => 'start_date',
            'format' => $dateFormatIso,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => Mage::helper('exam')->__('Start Date'),
            'title' => Mage::helper('exam')->__('Start Date'),
            'required' => true
        ));

        $fieldset->addField('end_date', 'date', array(
            'name' => 'end_date',
            'format' => $dateFormatIso,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => Mage::helper('exam')->__('End Date'),
            'title' => Mage::helper('exam')->__('End Date'),
            'required' => true
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();

    }
}