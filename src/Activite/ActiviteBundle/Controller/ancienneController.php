<?php

namespace Activite\ActiviteBundle\Controller;

use Activite\ActiviteBundle\Entity\ancienne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Activite\ActiviteBundle\Entity\commentaire;
use Activite\ActiviteBundle\Form\commentaireType;


/**
 * Ancienne controller.
 *
 */
class ancienneController extends Controller
{
    /**
     * Lists all ancienne entities.
     *
     */
    public function indexAction()
    {



           /*  $utilisateur = $this->get('security.token_storage')->getToken()->getUser();

           $test =  $utilisateur.getAime();*/
           

        
        $em = $this->getDoctrine()->getManager();

        $anciennes = $em->getRepository('ActiviteBundle:ancienne')->findAll();

        return $this->render('ActiviteBundle:Default:ancienne/layout/index.html.twig', array(
            'anciennes' => $anciennes,
        ));

        
    }

    /**
     * Finds and displays a ancienne entity.
     *
     */
    public function showAction(ancienne $ancienne)
    {

                  $commentaire = new commentaire();
        $form =  $form = $this->createForm(commentaireType::class, $commentaire);

        return $this->render('ActiviteBundle:Default:ancienne/layout/show.html.twig', array(
            'ancienne' => $ancienne,
            'commentaire_form' =>  $form->createView(),
        ));
    }




    public function LikeAction(Album $album){


         $em = $this->getDoctrine()->getManager();
          $utilisateur = $this->get('security.token_storage')->getToken()->getUser();
          $liked = $em->getRepository('ActiviteBundle:aime')->byLiked($utilisateur, $album);

       

           //$test =  $utilisateur->getAime();

          if(count($liked) < 1){
            $like = new aime();
            $like->setUser($utilisateur);
            $like->setAlbum($album);

            $em->persist($like);
            $em->flush();


            }
        }

}
