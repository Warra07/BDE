<?php

namespace Activite\ActiviteBundle\Controller;

use Activite\ActiviteBundle\Entity\ancienne;
use Activite\ActiviteBundle\Entity\activite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Activite\ActiviteBundle\Form\commentaireType;
use Activite\ActiviteBundle\Entity\commentaire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Ancienne controller.
 *
 */
class ActiviteController extends Controller
{
    /**
     * Lists all ancienne entities.
     *
     */
    public function CommentaireAction(Request $request, activite $activite)
    {

         $em = $this->getDoctrine()->getManager();
          $utilisateur = $this->get('security.token_storage')->getToken()->getUser();

          $commentaire = new commentaire();
        $form = $this->createForm(commentaireType::class, $commentaire);

         $form->handleRequest($request);

         if( $form->isValid()){

           //$test =  $utilisateur->getAime();
            $commentaire->setUser($utilisateur);
            $commentaire->setActivite($activite);
            $commentaire->setDate(new \DateTime());
       
            $em->persist($commentaire);
            $em->flush();
            }

            $referer = $request->headers->get('referer');
            return $this->redirect($referer);

        
    }


       public function DeleteCommentaireAction(Request $request, commentaire $commentaire)
    {
         $em = $this->getDoctrine()->getManager();
            $em->remove($commentaire);
            $em->flush();

            $referer = $request->headers->get('referer');
            return $this->redirect($referer);

        
    }


}
