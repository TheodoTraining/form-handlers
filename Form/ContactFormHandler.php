<?php

namespace Acme\DemoBundle\Form;

class ContactFormHandler extends FormHandler
{
    protected function process()
    {
        var_dump($this->form->getData());

        return true;
    }
}
