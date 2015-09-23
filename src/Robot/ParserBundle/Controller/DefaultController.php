<?php

namespace Robot\ParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RobotParserBundle:Default:index.html.twig', array('name' => $name));
    }
}
