<?php

namespace Activite\ActiviteBundle\Controller;

use Activite\ActiviteBundle\Entity\valide;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Valide controller.
 *
 */
class valideAdminController extends Controller
{
    /**
     * Lists all valide entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $valides = $em->getRepository('ActiviteBundle:valide')->findAll();

        return $this->render('ActiviteBundle:Administration:valide/layout/index.html.twig', array(
            'valides' => $valides,
        ));
    }

    /**
     * Creates a new valide entity.
     *
     */
    public function newAction(Request $request)
    {
        $valide = new Valide();
        $form = $this->createForm('Activite\ActiviteBundle\Form\valideType', $valide)->add('Ajouter', SubmitType::class, array('label' => 'Ajouter'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($valide);
            $em->flush();

            return $this->redirectToRoute('admin_act_valide_show', array('id' => $valide->getId()));
        }

        return $this->render('ActiviteBundle:Administration:valide/layout/new.html.twig', array(
            'valide' => $valide,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a valide entity.
     *
     */
    public function showAction(valide $valide)
    {
        $deleteForm = $this->createDeleteForm($valide);

        return $this->render('ActiviteBundle:Administration:valide/layout/show.html.twig', array(
            'valide' => $valide,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing valide entity.
     *
     */
    public function editAction(Request $request, valide $valide)
    {
        $deleteForm = $this->createDeleteForm($valide);
        $editForm = $this->createForm('Activite\ActiviteBundle\Form\valideType', $valide);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_act_valide_edit', array('id' => $valide->getId()));
        }

        return $this->render('ActiviteBundle:Administration:valide/layout/edit.html.twig', array(
            'valide' => $valide,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a valide entity.
     *
     */
    public function deleteAction(Request $request, valide $valide)
    {
        $form = $this->createDeleteForm($valide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($valide);
            $em->flush();
        }

        return $this->redirectToRoute('admin_act_valide_index');
    }

    /**
     * Creates a form to delete a valide entity.
     *
     * @param valide $valide The valide entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(valide $valide)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_act_valide_delete', array('id' => $valide->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
