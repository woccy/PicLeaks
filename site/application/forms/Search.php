<?php

class Application_Form_Search extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setAction('http://localhost/picleaks/public/index/advanced-search/')
         ->setMethod('post');

        $search = new Zend_Form_Element_Text('search');
        $search->setRequired(true)
                ->setValue('search')
                ->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Submit');
        // attach elements to form

        $this->addElement($search)
             ->addElement($submit);
    }


}

