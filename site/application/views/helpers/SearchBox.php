<?php
class Zend_View_Helper_SearchBox extends Zend_View_Helper_Abstract
{
    public function searchBox()
    {
       $form = new Application_Form_Search();
       
       $form->setName('search')
            ->setAction('/index/advanced-search')
            ->setMethod('post');
       
       return $this->view->searchBox = $form;
    }
}
