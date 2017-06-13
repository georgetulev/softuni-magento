<?php

class SoftUni_Statistics_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $frontPageStatus = Mage::getStoreConfig('web/statistics/options');

        if( 1 != $frontPageStatus ) {
            return $this->_redirectReferer();
        }

        $completedOrders = Mage::getModel('sales/order')
            ->getCollection()
            ->addFieldToFilter('state',
                array(
                    array('eq' => Mage_Sales_Model_Order::STATE_COMPLETE),
                )
            )
            ->getSize();

        $diffThanCompleted = Mage::getModel('sales/order')
            ->getCollection()
            ->addFieldToFilter('state',
                array(
                    array('neq' => Mage_Sales_Model_Order::STATE_COMPLETE),
                )
            )
            ->getSize();

        $activeProducts = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToFilter('status', 1)
            ->getSize();

        Mage::getSingleton('core/session')->setCompletedOrders($completedOrders);
        Mage::getSingleton('core/session')->setDiffThanCompleted($diffThanCompleted);
        Mage::getSingleton('core/session')->setActiveProducts($activeProducts);

        $this->loadLayout();
        return $this->renderLayout();
    }
}