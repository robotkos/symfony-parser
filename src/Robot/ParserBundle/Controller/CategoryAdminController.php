<?php

namespace Robot\ParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryAdminController extends Controller
{
    public function listAction()
    {
        return $this->render('RobotParserBundle:CategoryAdminController:index.html.twig', array(
                // ...
            ));    }

}
