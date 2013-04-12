<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;
use Acme\DemoBundle\Form\FormHandler;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DemoController extends Controller
{
    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/form", name="_demo_form")
     * @Template()
     */
    public function formAction(Request $request)
    {
        $handler = $this->get('acme.form_handler');
        $result = $handler->handle();

        return array('form' => $handler->getForm()->createView(), 'hasErrors' => !$result);
    }

    /**
     * @Route("/hello/{name}", name="_demo_hello")
     * @Template()
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/contact", name="_demo_contact")
     * @Template()
     */
    public function contactAction()
    {
        $form = $this->get('form.factory')->create(new ContactType());

        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $mailer = $this->get('mailer');
                // .. setup a message and send it
                // http://symfony.com/doc/current/cookbook/email.html

                $this->get('session')->setFlash('notice', 'Message sent!');

                return new RedirectResponse($this->generateUrl('_demo'));
            }
        }

        return array('form' => $form->createView());
    }
}
