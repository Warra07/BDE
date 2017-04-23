<?php

namespace Activite\ActiviteBundle\Controller;

use Activite\ActiviteBundle\Entity\en_vote;
use Activite\ActiviteBundle\Entity\vote;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Activite\ActiviteBundle\Entity\commentaire;
use Activite\ActiviteBundle\Form\commentaireType;
/**
 * En_vote controller.
 *
 */
class en_voteController extends Controller
{
    /**
     * Lists all en_vote entities.
     *
     */
    public function indexAction()
    {
      
        $em = $this->getDoctrine()->getManager();

        $en_votes = $em->getRepository('ActiviteBundle:en_vote')->findAll();

        return $this->render('ActiviteBundle:Default:en_vote/layout/index.html.twig', array(
            'en_votes' => $en_votes,
        ));
    }



    /**
     * Finds and displays a en_vote entity.
     *
     */
    public function showAction(en_vote $en_vote)
    {

         $commentaire = new commentaire();
        $form =  $form = $this->createForm(commentaireType::class, $commentaire);
        return $this->render('ActiviteBundle:Default:en_vote/layout/show.html.twig', array(
            'en_vote' => $en_vote,
             'commentaire_form' =>  $form->createView(),
        ));
    }

    public function voteAction(Request $request, en_vote $en_vote) 
    {

         $em = $this->getDoctrine()->getManager();
          $utilisateur = $this->get('security.token_storage')->getToken()->getUser();
          $vota = $em->getRepository('ActiviteBundle:vote')->byvota($utilisateur, $en_vote);


            $form = $this->createFormBuilder()->getForm();
          $form->add('dates', EntityType::class, [
        'class' => 'ActiviteBundle:date',
        'choices' => $en_vote->getDate(),
        'multiple'     => false,
        'expanded'     => false,])
         ->add('Valider', SubmitType::class, array('label' => 'Valider'));

         $form->handleRequest($request);

           //$test =  $utilisateur->getAime();

          if(count($vota) < 1){



            if ($this->container->get('request_stack')->getCurrentRequest()->getMethod() == 'POST'){


                $date = $form['dates']->getData();

            $vote = new vote();
            $vote->setUser($utilisateur);
            $vote->setEnvote($en_vote);
            $vote->setDatechoisis($date->getDate());

            $em->persist($vote);
            $em->flush();
            return $this->redirectToRoute('act_envote_index');

                }else{

             return $this->render('vote/new.html.twig', array(
            'en_vote' => $en_vote,
           'form' => $form->createView(),
        ));
                }
            }else{

             $em->remove($vota[0]);
            $em->flush();
            return $this->redirectToRoute('act_envote_index');


            }
         
    

            return $this->redirectToRoute('act_envote_index');

    }
}
