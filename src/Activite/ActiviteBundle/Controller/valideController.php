<?php

namespace Activite\ActiviteBundle\Controller;

use Activite\ActiviteBundle\Entity\valide;
use Activite\ActiviteBundle\Entity\inscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Activite\ActiviteBundle\Form\inscriptionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Activite\ActiviteBundle\Entity\commentaire;
use Activite\ActiviteBundle\Form\commentaireType;
/**


/**
 * Valide controller.
 *
 */
class valideController extends Controller
{
    /**
     * Lists all valide entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $valides = $em->getRepository('ActiviteBundle:valide')->findAll();

        return $this->render('ActiviteBundle:Default:valide/layout/index.html.twig', array(
            'valides' => $valides,
        ));
    }

    /**
     * Finds and displays a valide entity.
     *
     */
    public function showAction(valide $valide)
    {
          $commentaire = new commentaire();
        $form =  $form = $this->createForm(commentaireType::class, $commentaire);
        return $this->render('ActiviteBundle:Default:valide/layout/show.html.twig', array(
            'valide' => $valide,
             'commentaire_form' =>  $form->createView(),
        ));
    }

    public function inscritAction(Request $request, valide $valide)
    {

         $em = $this->getDoctrine()->getManager();
          $utilisateur = $this->get('security.token_storage')->getToken()->getUser();
          $inscrit = $em->getRepository('ActiviteBundle:inscription')->byInscrit($utilisateur, $valide);
          

            $inscription = new inscription();
            $form = $this->createForm(inscriptionType::class, $inscription)->add('Inscrire', SubmitType::class, array('label' => 'S\'inscrire'));

         $form->handleRequest($request);

           //$test =  $utilisateur->getAime();

          if(count($inscrit) < 1){



            if ($this->container->get('request_stack')->getCurrentRequest()->getMethod() == 'POST'){



            $inscription->setUser($utilisateur);
            $inscription->setValide($valide);

            $em->persist($inscription);
            $em->flush();
            return $this->redirectToRoute('act_valide_index');

                }else{

             return $this->render('valideInscription/new.html.twig', array(
            'valide' => $valide,
           'form' => $form->createView(),
        ));
                }
            }else{

         $em->remove($inscrit[0]);
            $em->flush();
            return $this->redirectToRoute('act_valide_index');


            }
         
    

            return $this->redirectToRoute('act_valide_index');

    }
    
}
