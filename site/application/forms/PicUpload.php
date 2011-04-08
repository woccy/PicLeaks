<?php

class Application_Form_PicUpload extends Zend_Form
{

    public function init()
    {
        $target = UPLOAD_PATH;
        $this->setAction($this->setAction(array('controller'=>'index','action'=>'upload'), null, true))
         ->setEnctype('multipart/form-data')
         ->setMethod('post');
        // title input
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title:')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
        // create file input for photo upload
        $picture = new Zend_Form_Element_File('picture');
        $picture->setLabel('Picture:')
          ->setDestination($target)
          ->setRequired(true);
        $picture->addValidator('Count', false, 1);
        $picture->addValidator('Size', false, 1024000);
        $picture->addValidator('Extension', false, 'jpg,png,gif');
        // private checkbox
        $private = new Zend_Form_Element_Checkbox('private');
        $private->setLabel('Set picture as private:');
        // deny comments checkbox
        $denyComments = new Zend_Form_Element_Checkbox('denyComments');
        $denyComments->setLabel('Deny comments:');
        // tags input
        $tags = new Zend_Form_Element_Text('tags');
        $tags->setLabel('Tags (separate with comma)')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
        // submit button
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Submit');
        // attach elements to form
        $this->addElement($title)
             ->addElement($picture)
             ->addElement($private)
             ->addElement($denyComments)
             ->addElement($tags)
             ->addElement($submit);        
    }


}

