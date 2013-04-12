<?php

namespace Acme\DemoBundle\Form;

abstract class FormHandler
{
    protected $form;
    protected $request;

    public function __construct($form, $request)
    {
        $this->form = $form;
        $this->request = $request;
    }

    public function handle()
    {
        if (in_array($this->request->getMethod(), $this->supportedMethods())) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                return $this->process();
            }
        }

        return false;
    }

    public function getForm()
    {
        return $this->form;
    }

    abstract protected function process();

    protected function supportedMethods()
    {
        return array('POST');
    }
}
