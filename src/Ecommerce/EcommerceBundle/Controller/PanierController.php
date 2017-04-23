<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Ecommerce\EcommerceBundle\Form\UtilisateursAdressesType;
use Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PanierController extends Controller
{
    public function menuAction()
    {
        $session = $this->container->get('request_stack')->getCurrentRequest()->getSession();
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));
        
        return $this->render('EcommerceBundle:Default:panier/modulesUsed/panier.html.twig', array('articles' => $articles));
    }
    
    public function supprimerAction($id)
    {
        $session = $this->container->get('request_stack')->getCurrentRequest()->getSession();
        $panier = $session->get('panier');
        
        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');
        }
        
        return $this->redirect($this->generateUrl('panier')); 
    }
    
    public function ajouterAction($id)
    {
        $session = $this->container->get('request_stack')->getCurrentRequest()->getSession();
        
        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        
        if (array_key_exists($id, $panier)) {
            if ($this->container->get('request_stack')->getCurrentRequest()->query->get('qte') != null) $panier[$id] = $this->container->get('request_stack')->getCurrentRequest()->query->get('qte');
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
        } else {
            if ($this->container->get('request_stack')->getCurrentRequest()->query->get('qte') != null)
                $panier[$id] = $this->container->get('request_stack')->getCurrentRequest()->query->get('qte');
            else
                $panier[$id] = 1;
            
            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }
            
        $session->set('panier',$panier);
        
        
        return $this->redirect($this->generateUrl('panier'));
    }
    
    public function panierAction()
    {
        $session = $this->container->get('request_stack')->getCurrentRequest()->getSession();
        if (!$session->has('panier')) $session->set('panier', array());
        
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->findArray(array_keys($session->get('panier')));
        
        return $this->render('EcommerceBundle:Default:panier/layout/panier.html.twig', array('produits' => $produits,
                                                                                             'panier' => $session->get('panier')));
    }
    
    public function adresseSuppressionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EcommerceBundle:UtilisateursAdresses')->find($id);
        
        if ($this->container->get('request_stack')->getCurrentRequest()->getSession() != $entity->getUtilisateur() || !$entity)
            return $this->redirect ($this->generateUrl ('livraison'));
        
        $em->remove($entity);
        $em->flush();
        
        return $this->redirect ($this->generateUrl ('livraison'));
    }
    
    public function livraisonAction()
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $this->get('security.token_storage')->getToken()->getUser();
        $entity = new UtilisateursAdresses();
        $form = $this->createForm(UtilisateursAdressesType::class, $entity, array(
            'action' => $this->generateUrl('livraison'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Ajouter', 'attr' => array('class' => 'btn btn-primary'), ));
        
        if ($this->container->get('request_stack')->getCurrentRequest()->getMethod() == 'POST')
        {
            //die("ccccccccccccccc");
            $form->handleRequest($this->container->get('request_stack')->getCurrentRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity->setUtilisateur($utilisateur);
                $entity->setVille("Alger");
                
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('livraison'));
            }
        }

        return $this->render('EcommerceBundle:Default:panier/layout/livraison.html.twig', array('utilisateur' => $utilisateur,
                                                                                                'form' => $form->createView()));
    }
    
    public function setLivraisonOnSession()
    {
        $session = $this->container->get('request_stack')->getCurrentRequest()->getSession();
        
        if (!$session->has('adresse')) $session->set('adresse',array());
        $adresse = $session->get('adresse');
        
        if ($this->container->get('request_stack')->getCurrentRequest()->request->get('livraison') != null && $this->container->get('request_stack')->getCurrentRequest()->request->get('facturation') != null)
        {
           
            $adresse['livraison'] = $this->container->get('request_stack')->getCurrentRequest()->request->get('livraison');
            $adresse['facturation'] = $this->container->get('request_stack')->getCurrentRequest()->request->get('facturation');
        } else {
            return $this->redirect($this->generateUrl('validation'));
        }
        
        $session->set('adresse',$adresse);

        return $this->redirect($this->generateUrl('validation'));
    }
    
    public function validationAction()
    {
        if ($this->container->get('request_stack')->getCurrentRequest()->getMethod() == 'POST')
            $this->setLivraisonOnSession();
        
        

        $em = $this->getDoctrine()->getManager();
        $prepareCommande = $this->forward('EcommerceBundle:Commandes:prepareCommande');

        $commande = $em->getRepository('EcommerceBundle:Commandes')->find($prepareCommande->getContent());
        
        return $this->render('EcommerceBundle:Default:panier/layout/validation.html.twig', array('commande' => $commande));
    }
}
