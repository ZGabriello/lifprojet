<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Category controller.
 *
 * @Route("categories")
 */
class CategoriesController extends Controller
{
    /**
     * Lists all category entities.
     *
     */
    
    public function indexAction() {
        $categoriesService = $this->get('categories_service');
    // Get all category, categoriesTranslate joined
        $categories = $categoriesService->getAllCategories();
        //return view
        return $this->render('categories/index.html.twig', array(
  'categories' => $categories
        ));
    }
     public function informatiqueAction() {
        $categoriesService = $this->get('categories_service');
    // Get all category, categoriesTranslate joined
        $categories = $categoriesService->getAllCategories();
        //return view
        return $this->render('categories/informatique.html.twig', array(
  'categories' => $categories
        ));
    }
    public function mathematiqueAction() {
        $categoriesService = $this->get('categories_service');
    // Get all category, categoriesTranslate joined
        $categories = $categoriesService->getAllCategories();
        //return view
        return $this->render('categories/mathematique.html.twig', array(
  'categories' => $categories
        ));
    }
    public function biologieAction() {
        $categoriesService = $this->get('categories_service');
    // Get all category, categoriesTranslate joined
        $categories = $categoriesService->getAllCategories();
        //return view
        return $this->render('categories/biologie.html.twig', array(
  'categories' => $categories
        ));
    }
    public function physiqueAction() {
        $categoriesService = $this->get('categories_service');
    // Get all category, categoriesTranslate joined
        $categories = $categoriesService->getAllCategories();
        //return view
        return $this->render('categories/physique.html.twig', array(
  'categories' => $categories
        ));
    }
    public function chimieAction() {
        $categoriesService = $this->get('categories_service');
    // Get all category, categoriesTranslate joined
        $categories = $categoriesService->getAllCategories();
        //return view
        return $this->render('categories/chimie.html.twig', array(
  'categories' => $categories
        ));
    }
    /**
     * Creates a new category entity.
     *
     * @Route("/new", name="categories_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $category = new Categories();
        $form = $this->createForm('OC\PlatformBundle\Form\CategoriesType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('categories_show', array('id' => $category->getId()));
        }

        return $this->render('categories/new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category entity.
     *
     */
    public function showAction(Categories $category)
    {
        $deleteForm = $this->createDeleteForm($category);

        return $this->render('categories/show.html.twig', array(
            'category' => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     */
    public function editAction(Request $request, Categories $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('OC\PlatformBundle\Form\CategoriesType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

        $this->addFlash(
            'notice',
            'Votre modification a été enregistrée! '
        );
            return $this->redirectToRoute('categories_edit', array('id' => $category->getId()));
        }

        return $this->render('categories/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing category entity.
     *
     */
    public function deleteImageAction(Request $request, Categories $category)
    {
        $category->setImageFile(null);
        $category->setImage(null);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash(
            'notice',            
            'Vous avez supprimé l\'image de la catégorie '.$category->getId().'. Votre modification a été enregistrée. ! '
        );
        return $this->redirectToRoute('categories_index');

    }

    /**
     * Deletes a category entity.
     *
     */
    public function deleteAction(Request $request, Categories $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('categories_index');
    }

    /**
     * Creates a form to delete a category entity.
     *
     * @param Categories $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categories $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categories_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
