<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Form\RechercheType;
use Ecommerce\EcommerceBundle\Entity\Categories;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProduitsController extends Controller
{  
    public function produitsAction(Categories $categorie = null)
    {
        $session = $this->container->get('request_stack')->getCurrentRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        
        if ($categorie != null)
            $findProduits = $em->getRepository('EcommerceBundle:Produits')->byCategorie($categorie);
        else 
            $findProduits = $em->getRepository('EcommerceBundle:Produits')->findBy(array('disponible' => 1));
        
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;
        
        $produits = $this->get('knp_paginator')->paginate($findProduits,$this->container->get('request_stack')->getCurrentRequest()->query->get('page', 1),3);
        
        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits,
                                                                                                 'panier' => $panier));
    }
    
    public function presentationAction($id)
    {
        $session = $this->container->get('request_stack')->getCurrentRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcommerceBundle:Produits')->find($id);
        
        if (!$produit) throw $this->createNotFoundException('La page n\'existe pas.');
        
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;
        
        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig', array('produit' => $produit,
                                                                                                     'panier' => $panier));
    }
    
    public function rechercheAction() 
    {
        $form = $this->createForm(RechercheType::class);
        return $this->render('EcommerceBundle:Default:Recherche/modulesUsed/recherche.html.twig', array('form' => $form->createView()));
    }
    
    public function rechercheTraitementAction() 
    {
        $form = $this->createForm(RechercheType::class);
        $produits = null;
        
        if ($this->container->get('request_stack')->getCurrentRequest()->getMethod() == 'POST')
        {
            $form->handleRequest($this->container->get('request_stack')->getCurrentRequest());
            $em = $this->getDoctrine()->getManager();
            $findProduits = $em->getRepository('EcommerceBundle:Produits')->recherche($form['recherche']->getData());
            $produits = $this->get('knp_paginator')->paginate($findProduits,$this->container->get('request_stack')->getCurrentRequest()->query->get('page', 1),3);
        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }
        
        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits));
    }
}