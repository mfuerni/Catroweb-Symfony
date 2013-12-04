<?php

namespace Catrobat\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Catrobat\CatrowebBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator;
use Symfony\Component\Security\Core\SecurityContext;
use Catrobat\CatrowebBundle\Model\UserManager;
use Catrobat\CatrowebBundle\Model\Requests\AddProjectRequest;
use Catrobat\CatrowebBundle\Model\ProjectManager;
use Catrobat\CatrowebBundle\Services\TokenGenerator;
use Catrobat\CatrowebBundle\Exceptions\InvalidCatrobatFileException;

class SearchController
{
    protected $templating;
    protected $project_manager;
    
    public function __construct(EngineInterface $templating, ProjectManager $project_manager)
    {
      $this->templating = $templating;
      $this->project_manager = $project_manager;
    }
     
    public function searchProjectsAction(Request $request) 
    {
      $retArray = array();
      $projectName = $request->request->get('projectName');
      $limit = intval($request->request->get('limit'));
      $offset = intval($request->request->get('offset'));
       
      //$retArray['projectName'] = $projectName;
      $retArray['limit'] = $limit;
      $retArray['offset'] = $offset;
      
      $entities = $this->project_manager->findAll();
      $retArray['numOfProjects'] = count($entities);
      
      $entities = $this->project_manager->findOneByName($projectName);
      $retArray['id'] = $entities->getId();
      $retArray['projectName'] = $entities->getName();
      $retArray['description'] = $entities->getDescription();
      $retArray['downloads'] = $entities->getDownloads();
      $retArray['views'] = $entities->getViews();
      $retArray['author'] = $entities->getUser()->getUsername();
      $retArray['uploaded_time'] = $entities->getUploadedAt()->getTimestamp();
      $retArray['catrobat_version_name'] = $entities->getCatrobatVersionName();

      return $this->templating->renderResponse('CatrobatApiBundle:Api:searchProjects.json.twig', $retArray);
    }
}
