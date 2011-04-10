<?php

class Application_Form_Search extends Zend_Form
{

    public function init()
    {
        $this->setName('search');
        $this->setAction('/index/advanced-search')->setMethod('post');

        $search = new Zend_Form_Element_Text('search');
        $search->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->setValue('Search for...');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Search');

        $this->addElement($search);
             //->addElement($submit);
    }
}

