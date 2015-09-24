<?php

namespace Robot\ParserBundle\Controller;

use Robot\ParserBundle\Entity\ParserBilstein;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryAdminController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RobotParserBundle:CategoryAdmin:index.html.twig', array('name' => $name));
    }
}
