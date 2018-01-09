<?php

namespace OC\PlatformBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\PlatformBundle\Entity\Tchat;

class TchatService {
    /*
     * @var EntityManager
     */

    protected $entityManager;

    function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getAllTchat() {

        $cat = $this->entityManager
                ->getRepository('OCPlatformBundle:Tchat')
                ->findAll();
        ;
        return $cat;
    }

}
