<?php

namespace Activite\ActiviteBundle\Controller;

use Activite\ActiviteBundle\Entity\ancienne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * Ancienne controller.
 *
 */
class ancienneAdminController extends Controller
{
    /**
     * Lists all ancienne entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $anciennes = $em->getRepository('ActiviteBundle:ancienne')->findAll();

        return $this->render('ActiviteBundle:Administration:ancienne/layout/index.html.twig', array(
            'anciennes' => $anciennes,
        ));
    }

    /**
     * Creates a new ancienne entity.
     *
     */
    public function newAction(Request $request)
    {
        $ancienne = new Ancienne();

        $form = $this->createForm('Activite\ActiviteBundle\Form\ancienneType', $ancienne)->add('Ajouter', SubmitType::class, array('label' => 'Ajouter'));;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ancienne);
            $em->flush();

            return $this->redirectToRoute('admin_act_ancienne_show', array('id' => $ancienne->getId()));
        }

        return $this->render('ActiviteBundle:Administration:ancienne/layout/new.html.twig', array(
            'ancienne' => $ancienne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ancienne entity.
     *
     */
    public function showAction(ancienne $ancienne)
    {
        $deleteForm = $this->createDeleteForm($ancienne);

        return $this->render('ActiviteBundle:Administration:ancienne/layout/show.html.twig', array(
            'ancienne' => $ancienne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ancienne entity.
     *
     */
    public function editAction(Request $request, ancienne $ancienne)
    {
        $deleteForm = $this->createDeleteForm($ancienne);
        $editForm = $this->createForm('Activite\ActiviteBundle\Form\ancienneType', $ancienne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_act_ancienne_edit', array('id' => $ancienne->getId()));
        }

        return $this->render('ActiviteBundle:Administration:ancienne/layout/edit.html.twig', array(
            'ancienne' => $ancienne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ancienne entity.
     *
     */
    public function deleteAction(Request $request, ancienne $ancienne)
    {
        $form = $this->createDeleteForm($ancienne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ancienne);
            $em->flush();
        }

        return $this->redirectToRoute('admin_act_ancienne_index');
    }

    /**
     * Creates a form to delete a ancienne entity.
     *
     * @param ancienne $ancienne The ancienne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ancienne $ancienne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_act_ancienne_delete', array('id' => $ancienne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
