<?php
namespace Ens\JobeetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Ens\JobeetBundle\Entity\Affiliate;

class AffiliateAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'isActive',
        'is_active' => array('value' => 2) // The value 2 represents that the displayed affiliate accounts are not activated yet
        );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->add('email')
        ->add('url')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('email')
        ->add('isActive');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->add('isActive')
        ->addIdentifier('email')
        ->add('url')
        ->add('createdAt')
        ->add('token')
        ;
    }
}