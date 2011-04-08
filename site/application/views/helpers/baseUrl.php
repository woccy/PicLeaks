<?php
class Zend_View_Helper_baseUrl extends Zend_View_Helper_Abstract
{
    public function baseUrl ()
    {
       $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();

       return $baseUrl;
    }
}

?>