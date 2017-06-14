<?php

class SoftUni_Exam_ContestsController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();

        return $this->renderLayout();
    }

    public function showAction()
    {
        $contestId = $this->getRequest()->getParam('id');

        $contest = Mage::getModel('softuni_exam/contest')
            ->getCollection()
            ->addFieldToFilter('is_active', 1)
            ->addFieldToFilter('contest_id', $contestId)
            ->count();

        if($contest < 1){
            return $this->_redirect('*/contests');
        }
        $this->loadLayout();

//        $this->_addContent(
//            $this->getLayout()->createBlock('exam/adminhtml_contest')
//        );

        return $this->renderLayout();
    }

    public function postAction()
    {

        if( ! $customer = Mage::getSingleton('customer/session')->isLoggedIn()) {
            $this->_redirectReferer();
            // with some message!
            // and populate the data!
        }
        $data = $this->getRequest()->getParams();
        $contestId = $this->getRequest()->getParam('id');
        // validate
        // set timestamps to ....
        // try catch block

        $customerId = Mage::getSingleton('customer/session')->getId();
        $newModel = Mage::getModel('softuni_exam/contestant');
        $newModel->setData($data);
        $newModel->setData('contest_id', $contestId);
        $newModel->setData('contestant_id', $customerId);
        $newModel->setData('approved', 0);
        $newModel->save();

        return $this->_redirect('/exam/contests');
    }

}