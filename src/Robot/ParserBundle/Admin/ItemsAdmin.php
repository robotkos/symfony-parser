<?php

namespace Robot\ParserBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
 
class ItemsAdmin extends Admin
{
    public function getBatchActions()
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', null, array('label' => 'Id'))
                   ->add('pn', null, array('label' => 'pn'))
                   ->add('oldPn', null, array('label' => 'oldPn'))
                   ->add('img', null, array('label' => 'img'));
    }
 
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('pn')
                   ->add('oldPn')
                   ->add('descr')
                   ->add('img');
    }

  protected function configureRoutes(RouteCollection $collection)
  {
      #$collection->add('parsers', $this->getRouterIdParameter().'/parsers');
  }


}