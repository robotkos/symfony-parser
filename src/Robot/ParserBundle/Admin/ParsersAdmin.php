<?php

namespace Robot\ParserBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
 
class ParsersAdmin extends Admin
{
    public function getBatchActions()
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', null, array('label' => 'Id'))
                   ->add('name', null, array('label' => 'Name'))
                   ->add('status', 'boolean', array('editable' => true))
                   ->add('dateStart', null, array('label' => 'Date Start'))
                    ->add('_action', 'actions', array(
                      'label' => 'Data Action',
                      'actions' => array(
                          'Import' => array(
                              'template' => 'RobotParserBundle:Parsers:list__action_import.html.twig',
                              'show' => array(),
                          )
                      )
                  ));
    }
 
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name')
                   ->add('parts')
                   ->add('status')
                   ->add('dateStart');
    }

  protected function configureRoutes(RouteCollection $collection)
  {
      $collection->add('importimg', $this->getRouterIdParameter().'/importimg');
      $collection->add('import', $this->getRouterIdParameter().'/import');
  }


}