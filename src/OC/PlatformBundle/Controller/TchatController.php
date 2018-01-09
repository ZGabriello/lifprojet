<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Tchat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Chat controller.
 *
 * @Route("chat")
 */
class TchatController extends Controller
{
    /**
     * Lists all category entities.
     *
     */
 public function indexAction() {
        $tchatService = $this->get('tchat_service');
    // Get all category, categoriesTranslate joined
        $tchat = $tchatService->getAllTchat();
        //return view
        return $this->render('categories/tchat.html.twig', array(
  'tchat' => $tchat
        ));
    }
}