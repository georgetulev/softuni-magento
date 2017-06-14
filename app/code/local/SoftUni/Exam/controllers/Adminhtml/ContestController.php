<?php

class SoftUni_Exam_Adminhtml_ContestController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('exam/contest');

        $this->_addContent(
            $this->getLayout()->createBlock('exam/adminhtml_contest')
        );

        return $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        if($contestId = $this->getRequest()->getParam('contest_id')){
            Mage::register('current_contest', Mage::getModel('softuni_exam/contest')->load($contestId));
        }

        $this->loadLayout();
        $this->_setActiveMenu('exam/contest');

        $this->_addContent(
            $this->getLayout()->createBlock('exam/adminhtml_contest_edit')
        );

        return $this->renderLayout();
    }

    public function saveAction()
    {
        $contestId = $this->getRequest()->getParam('contest_id');
        $contestModel = Mage::getModel('softuni_exam/contest')->load($contestId);

        if ($data = $this->getRequest()->getPost()) {

            try {
                $contestModel->addData($data)->save();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess($this->__("The contest was successfully saved!"));
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
        $contestId = $this->getRequest()->getParam('contest_id');
        $contestModel = Mage::getModel('softuni_exam/contest')->load($contestId);

        try {
            $contestModel->delete();
            Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__("The contest was deleted!"));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/edit', array('_current' => true));
        }

        $this->_redirect('*/*/index');
    }

    public function massDeleteAction()
    {
        if ($contestIds = $this->getRequest()->getParam('contest_ids')) {
            try {
                foreach ($contestIds as $contestId) {
                    $model = Mage::getMOdel('softuni_exam/contest')->load($contestId);
                    $model->delete();
                }
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess($this->__("%d contest(s) deleted!", count($contestIds)));
            } catch ( Exception $e ) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        } else {
            Mage::getSingleton('adminhtml/session')
                ->addError($this->__('Please select some contests.')
            );
        }

        $this->_redirect('*/*/index');
    }

    public function massStatusToggleAction()
    {
        $status = $this->getRequest()->getParam('status');
        $this->toggleActivation($status);
        $this->_redirect('*/*/index');
    }

    protected function toggleActivation($status)
    {
        if ($contestIds = $this->getRequest()->getParam('contest_ids')) {

            try {
                foreach ($contestIds as $contestId) {
                    $model = Mage::getMOdel('softuni_exam/contest')->load($contestId);
                    $model->setData('is_active', $status);
                    $model->save();
                }
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess($this->__("%d contest(s) status changed!", count($contestIds)));
            } catch ( Exception $e ) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        } else {
            Mage::getSingleton('adminhtml/session')
                ->addError($this->__('Please select some contests.')
                );
        }
    }
}