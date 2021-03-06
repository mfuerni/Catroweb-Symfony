<?php

namespace App\Admin;

use App\Entity\Template;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TemplateAdmin extends AbstractAdmin
{
  /**
   * @override
   *
   * @var string
   */
  protected $baseRouteName = 'admin_catrobat_adminbundle_templateadmin';
  /**
   * @override
   *
   * @var string
   */
  protected $baseRoutePattern = 'template';

  /**
   * @override
   *
   * @var array
   */
  protected $datagridValues = [
    '_sort_by' => 'id',
    '_sort_order' => 'DESC',
  ];

  /**
   * @return array
   */
  public function getBatchActions()
  {
    $actions = parent::getBatchActions();
    unset($actions['delete']);

    return $actions;
  }

  /**
   * @param Template $object
   *
   * @return string
   */
  public function getThumbnailImageUrl($object)
  {
    return '/'.$this->getConfigurationPool()->getContainer()->get('template_screenshot_repository')
      ->getThumbnailWebPath($object->getId())
    ;
  }

  /**
   * @param FormMapper $formMapper
   *
   * Fields to be shown on create/edit forms
   */
  protected function configureFormFields(FormMapper $formMapper): void
  {
    $isNew = null == $this->getSubject()->getId();
    $formMapper
      ->add('name', TextType::class, ['label' => 'Program name'])
      ->add('landscape_program_file', FileType::class, ['required' => false])
      ->add('portrait_program_file', FileType::class, ['required' => false])
      ->add('thumbnail', FileType::class, ['required' => $isNew])
      ->add('active', null, ['required' => false])
    ;
  }

  /**
   * @param DatagridMapper $datagridMapper
   *
   * Fields to be shown on filter forms
   */
  protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
  {
    $datagridMapper
      ->add('id')
      ->add('name')
    ;
  }

  /**
   * @param ListMapper $listMapper
   *
   * Fields to be shown on lists
   */
  protected function configureListFields(ListMapper $listMapper): void
  {
    $listMapper
      ->addIdentifier('id')
      ->add('name')
      ->add('thumbnail', 'string', ['template' => 'Admin/program_thumbnail_image_list.html.twig'])
      ->add('active', 'boolean', ['editable' => true])
      ->add('_action', 'actions', ['actions' => [
        'edit' => [],
        'delete' => [],
      ]])
    ;
  }

  protected function configureRoutes(RouteCollection $collection): void
  {
    $collection->remove('export');
  }
}
