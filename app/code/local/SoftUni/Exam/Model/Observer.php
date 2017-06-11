<?php

class SoftUni_Exam_Model_Observer
{

    public function addItemToTopMenu(Varien_Event_Observer $observer)
    {
        $menu = $observer->getMenu();
        $tree = $menu->getTree();
        $url  = '/exam/contests';

        $node = new Varien_Data_Tree_Node(array(
            'name' => 'Contests',
            'id' => 'contests',
            'url' => $url,
        ), 'id', $tree, $menu);

        $menu->addChild($node);

        // Children menu items
        $collection = Mage::getModel('softuni_exam/contest')
            ->getCollection()
            ->addFieldToFilter('is_active', 1)
            ->getData();

        foreach ($collection as $index => $value) {
            $tree = $node->getTree();
            $data = array(
                'name' => $value['title'],
                'id' => 'category-node-' . $value->id,
                'url' => '/exam/contests/index?id=' . $value['contest_id'],
            );

            $subNode = new Varien_Data_Tree_Node($data, 'id', $tree, $node);
            $node->addChild($subNode);
        }
    }
}