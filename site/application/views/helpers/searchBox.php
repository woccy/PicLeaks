<?php
class Zend_View_Helper_searchBox extends Zend_View_Helper_Abstract
{
    public function searchBox ()
    {
       $searchBox = new Application_Form_Search();
       return $this->view->form = $searchBox;
    }
}

?>