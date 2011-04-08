<?php

class Application_Form_AdvancedSearch extends Zend_Form
{

    public function init()
    {
        $this->setAction($this->setAction(array('controller'=>'index','action'=>'advanced-search'), null, true))
         ->setMethod('post');
        // title input
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title:')
				->setRequired(false)
				->addFilter('StripTags')
				->addFilter('StringTrim');
        // username
        $uploaderUsername = new Zend_Form_Element_Text('uploaderUsername');
        $uploaderUsername->setLabel('Username of the uploader:')
				->setRequired(false)
				->addFilter('StripTags')
				->addFilter('StringTrim');
        // tags
        $tags = new Zend_Form_Element_Text('tags');
        $tags->setLabel('Tags:')
				->setRequired(false)
				->addFilter('StripTags')
				->addFilter('StringTrim');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Submit');
        // attach elements to form
        $this->addElement($title)
             ->addElement($uploaderUsername)
             ->addElement($tags)
             ->addElement($submit);
    }


}

