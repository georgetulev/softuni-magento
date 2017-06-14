<?php

class SoftUni_Exam_Adminhtml_ContestantController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('exam/contest');

        $this->_addContent(
            $this->getLayout()->createBlock('exam/adminhtml_contestant')
        );

        return $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        if($contestantId = $this->getRequest()->getParam('contestant_id')){
            Mage::register('current_contestant', Mage::getModel('softuni_exam/contestant')->load($contestantId));
        }

        $this->loadLayout();
        $this->_setActiveMenu('exam/contestant');

        $this->_addContent(
            $this->getLayout()->createBlock('exam/adminhtml_contestant_edit')
        );

        return $this->renderLayout();
    }

    public function saveAction()
    {
        $contestantId = $this->getRequest()->getParam('contestant_id');
        $contestantModel = Mage::getModel('softuni_exam/contestant')->load($contestantId);

        if ($data = $this->getRequest()->getPost()) {
            try {
                $contestantModel->addData($data)->save();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess($this->__("The contestant was successfully saved!"));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->setContestFormData($data);
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('_current' => true));
            }
        }

        $this->_redirect('*/*/index');
    }

    public function deleteAction()
    {
        $contestantId = $this->getRequest()->getParam('contestant_id');
        $contestantModel = Mage::getModel('softuni_exam/contestant')->load($contestantId);

        try {
            $contestantModel->delete();
            Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__("The contestant was deleted!"));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirectReferer();
        }

        $this->_redirect('*/*/index');
    }

    public function massDeleteAction()
    {
        if ($contestantIds = $this->getRequest()->getParam('contestant_ids')) {
            try {
                foreach ($contestantIds as $contestantId) {
                    $model = Mage::getMOdel('softuni_exam/contestant')->load($contestantId);
                    $model->delete();
                }
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess($this->__("%d contestant(s) deleted!", count($contestantIds)));
            } catch ( Exception $e ) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        } else {
            Mage::getSingleton('adminhtml/session')
                ->addError($this->__('Please select some contestant(s).')
                );
        }

        $this->_redirect('*/*/index');
    }
}