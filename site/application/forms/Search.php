<?php

class Application_Form_Search extends Zend_Form
{

    public function __construct($options = NULL)
    {
        parent::__construct();
        
        Zend_Dojo::enableForm($this);
        
        $this->setName('search')
             ->setAction('/index/advanced-search')
             ->setMethod('post');

        $search = new Zend_Form_Element_Text('search');
        $search->setRequired(true)
               ->setValue('Search...')
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Search')
               ->setIgnore(TRUE)
               ->setRequired(TRUE);

        $this->addElements(array($search));
        
         /** Lomakkeen ulkoasu */
        
        $this->addDecorator('FormElements')
             ->addDecorator('Fieldset')
             ->addDecorator('HtmlTag', array('tag' => '<tr>'))
             ->addDecorator('Form');
        
        $this->setElementDecorators(array(
            array('ViewHelper'),
            array('Errors'),
            array('Description'),
            array('HtmlTag', array('tag' => 'td', 'class' => 'element-group')),
            ));
        
        $submit->setDecorators(array(
            array('ViewHelper'),
            array('Description'),
            array('HtmlTag', array('tag' => 'td', 'class' => 'submit-group')),
            ));
    }
}

