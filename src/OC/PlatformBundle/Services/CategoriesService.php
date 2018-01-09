<?php

namespace OC\PlatformBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\PlatformBundle\Entity\Categories;

class CategoriesService {
    /*
     * @var EntityManager
     */

    protected $entityManager;

    function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getAllCategories() {

        $cat = $this->entityManager
                ->getRepository('OCPlatformBundle:Categories')
                ->findAll();
        ;
        return $cat;
    }

}
