<?php

namespace Activite\ActiviteBundle\Controller;

use Activite\ActiviteBundle\Entity\en_vote;
use Activite\ActiviteBundle\Entity\date;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * En_vote controller.
 *
 */
class en_voteAdminController extends Controller
{
    /**
     * Lists all en_vote entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $en_votes = $em->getRepository('ActiviteBundle:en_vote')->findAll();

        return $this->render('ActiviteBundle:Administration:en_vote/layout/index.html.twig', array(
            'en_votes' => $en_votes,
        ));
    }

    /**
     * Creates a new en_vote entity.
     *
     */
    public function newAction(Request $request)
    {
        $en_vote = new En_vote();
        $en_vote->addDate(new date());
        $en_vote->addDate(new date());
        $en_vote->addDate(new date());
        $form = $this->createForm('Activite\ActiviteBundle\Form\en_voteType', $en_vote)->add('Ajouter', SubmitType::class, array('label' => 'Ajouter'));;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($en_vote);
            $em->flush();

            return $this->redirectToRoute('admin_act_envote_show', array('id' => $en_vote->getId()));
        }

        return $this->render('ActiviteBundle:Administration:en_vote/layout/new.html.twig', array(
            'en_vote' => $en_vote,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a en_vote entity.
     *
     */
    public function showAction(en_vote $en_vote)
    {
        $deleteForm = $this->createDeleteForm($en_vote);

        return $this->render('ActiviteBundle:Administration:en_vote/layout/show.html.twig', array(
            'en_vote' => $en_vote,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing en_vote entity.
     *
     */
    public function editAction(Request $request, en_vote $en_vote)
    {
        $deleteForm = $this->createDeleteForm($en_vote);
        $editForm = $this->createForm('Activite\ActiviteBundle\Form\en_voteType', $en_vote);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_act_envote_edit', array('id' => $en_vote->getId()));
        }

        return $this->render('ActiviteBundle:Administration:en_vote/layout/edit.html.twig', array(
            'en_vote' => $en_vote,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a en_vote entity.
     *
     */
    public function deleteAction(Request $request, en_vote $en_vote)
    {
        $form = $this->createDeleteForm($en_vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($en_vote);
            $em->flush();
        }

        return $this->redirectToRoute('admin_act_envote_index');
    }

    /**
     * Creates a form to delete a en_vote entity.
     *
     * @param en_vote $en_vote The en_vote entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(en_vote $en_vote)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_act_envote_delete', array('id' => $en_vote->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
