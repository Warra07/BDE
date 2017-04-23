<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
         $em = $this->getDoctrine()->getManager();
        $envotes = $em->getRepository('ActiviteBundle:en_vote')->findAll();
        $anciennes = $em->getRepository('ActiviteBundle:ancienne')->findAll();
        $valides = $em->getRepository('ActiviteBundle:valide')->findAll();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'envotes' => $envotes,
            'anciennes' => $anciennes,
            'valides' => $valides,
            ));
    }


    public function adminListAction(){

        return $this->render('default/adminList.html.twig');
    }
}
