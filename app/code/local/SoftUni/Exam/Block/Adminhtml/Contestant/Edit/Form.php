<?php

class SoftUni_Exam_Block_Adminhtml_Contestant_Edit_Form extends
    Mage_Adminhtml_Block_Widget_Form
{
    protected function _initFormValues()
    {
        if($contestant = Mage::registry('current_contestant')) {
            $data = $contestant->getData();
            $this->getForm()->setValues($data);
        }

        // keep data if post has failed
        if($data = Mage::getSingleton('adminhtml/session')->getData('contestant_form_data', true)){
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
            array('legend' => Mage::helper('exam')->__('List Of Participants'), 'class' => 'fieldset-wide'));

        $fieldset->addField('first_name', 'text', array(
            'name' => 'first_name',
            'label' => Mage::helper('exam')->__('First Name'),
            'title' => Mage::helper('exam')->__('First Name'),
            'required' => true
        ));

        $fieldset->addField('country', 'text', array(
            'name' => 'country',
            'label' => Mage::helper('exam')->__('Country'),
            'title' => Mage::helper('exam')->__('Country'),
            'required' => true
        ));

        $fieldset->addField('city', 'text', array(
            'name' => 'city',
            'label' => Mage::helper('exam')->__('City'),
            'title' => Mage::helper('exam')->__('City'),
            'required' => true
        ));

        $fieldset->addField('last_name', 'text', array(
            'name' => 'last_name',
            'label' => Mage::helper('exam')->__('Last Name'),
            'title' => Mage::helper('exam')->__('Last Name'),
            'required' => true
        ));

        $fieldset->addField('email', 'text', array(
            'name' => 'email',
            'label' => Mage::helper('exam')->__('Email'),
            'title' => Mage::helper('exam')->__('Email'),
            'required' => true
        ));

        $fieldset->addField('message', 'textarea', array(
            'name' => 'message',
            'label' => Mage::helper('exam')->__('Message'),
            'title' => Mage::helper('exam')->__('Message'),
            'required' => false
        ));

        $fieldset->addField('approved', 'select', array(
            'name' => 'approved',
            'label' => Mage::helper('exam')->__('Status'),
            'title' => Mage::helper('exam')->__('Status'),
            'required' => false,
            'values'    => ['approved', 'rejected'],
        ));

        $dateFormatIso = Mage::app()
            ->getLocale()
            ->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

        $fieldset->addField('dob', 'date', array(
            'name' => 'dob',
            'format' => $dateFormatIso,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => Mage::helper('exam')->__('Birth Date'),
            'title' => Mage::helper('exam')->__('Birth Date'),
            'required' => true
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();

    }
}