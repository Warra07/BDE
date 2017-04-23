<?php

namespace Activite\ActiviteBundle\Controller;

use Activite\ActiviteBundle\Entity\idee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Idee controller.
 *
 */
class ideeAdminController extends Controller
{
    /**
     * Lists all idee entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $idees = $em->getRepository('ActiviteBundle:idee')->findAll();

        return $this->render('ActiviteBundle:Administration:idee/layout/index.html.twig', array(
            'idees' => $idees,
        ));
    }

    /**
     * Creates a new idee entity.
     *
     */
    public function newAction(Request $request)
    {
        $idee = new Idee();
        $form = $this->createForm('Activite\ActiviteBundle\Form\ideeType', $idee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($idee);
            $em->flush();

            return $this->redirectToRoute('admin_idee_show', array('id' => $idee->getId()));
        }

        return $this->render('ActiviteBundle:Administration:idee/layout/new.html.twig', array(
            'idee' => $idee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a idee entity.
     *
     */
    public function showAction(idee $idee)
    {
        $deleteForm = $this->createDeleteForm($idee);

        return $this->render('ActiviteBundle:Administration:idee/layout/show.html.twig', array(
            'idee' => $idee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing idee entity.
     *
     */
    public function editAction(Request $request, idee $idee)
    {
        $deleteForm = $this->createDeleteForm($idee);
        $editForm = $this->createForm('Activite\ActiviteBundle\Form\ideeType', $idee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_idee_edit', array('id' => $idee->getId()));
        }

        return $this->render('ActiviteBundle:Administration:idee/layout/edit.html.twig', array(
            'idee' => $idee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a idee entity.
     *
     */
    public function deleteAction(Request $request, idee $idee)
    {
        $form = $this->createDeleteForm($idee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($idee);
            $em->flush();
        }

        return $this->redirectToRoute('admin_idee_index');
    }

    /**
     * Creates a form to delete a idee entity.
     *
     * @param idee $idee The idee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(idee $idee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_idee_delete', array('id' => $idee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
