<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OC\UserBundle\Entity\User;
use OC\PlatformBundle\Entity\Categories;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AdvertController extends Controller
{
    public function indexAction()
    {
        $categoriesService = $this->get('categories_service');
        // Get all category, categoriesTranslate joined
        $categories = $categoriesService->getAllCategories();
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
        'listAdverts' => array(),
        'categories' => $categories
));  }

  public function addAction(Request $request)
  {
    // On crée un objet User
    $user = new User();

    // On crée le FormBuilder grâce au service form factory
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $user);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      ->add('username',      TextType::class)
      ->add('password',     TextType::class)
      ->add('email',       TextType::class)
      ->add('save',      SubmitType::class)
     ;
    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

    // À partir du formBuilder, on génère le formulaire
    $form = $formBuilder->getForm();
	
	 if ($request->isMethod('POST')) {
      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
      $form->handleRequest($request);

      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      if ($form->isValid()) {
        // On enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Utilisateur bien enregistrée.');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
  'listAdverts' => array()));
      }
    }

    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('OCPlatformBundle:Advert:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}