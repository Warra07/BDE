<?php

namespace Activite\ActiviteBundle\Controller;

use Activite\ActiviteBundle\Entity\album;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Activite\ActiviteBundle\Entity\ancienne;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Album controller.
 *
 */
class AlbumController extends Controller
{
    /**
     * Lists all album entities.
     *
     */
    public function indexAction(Request $request, ancienne $ancienne = null)
    {




        $em = $this->getDoctrine()->getManager();

        $albums = [];


          $form = $this->createFormBuilder()->getForm();
        if ($ancienne != null){
            $albums = $em->getRepository('ActiviteBundle:album')->byAncienne($ancienne);}
        else 
            $albums = $em->getRepository('ActiviteBundle:album')->findAll();


                  $form->add('album', EntityType::class, [
        'class' => 'ActiviteBundle:album',
        'choices' => $albums,
        'multiple'     => true,
        'expanded'     => true,])
         ->add('Telecharger', SubmitType::class, array('label' => 'Telecharger'))
        ->add('Supprimer', SubmitType::class, array('label' => 'Supprimer'));


         if ($this->container->get('request_stack')->getCurrentRequest()->getMethod() == 'POST'){

             $form->handleRequest($request);

            if($form->get('Supprimer')->isClicked())
            {
               if(!($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') || $this->get('security.authorization_checker')->isGranted('ROLE_CESI') )){
                $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Vous ne possédez pas les privilèges nécessaire pour faire ceci.');}
          
            foreach( $form['album']->getData() as $image){

            $em->remove($image);
            $em->flush(); }

                 return $this->redirectToRoute('album_index');

        }else if($form->get('Telecharger')->isClicked())
        {
            if(file_exists ( 'Album.zip' )){
         unlink('Album.zip');}
          $zip = new \ZipArchive();
          $zipName = "Album.zip";
          
           $zip->open($zipName,  \ZipArchive::CREATE);
            
            foreach ($form['album']->getData() as $image){
             $zip->addFile($image->getImage()->getAssetPath(), $image->getImage()->getName() . ".png");
            }
           

         $zip->close();
          $response = new Response();
         $response->headers->set('Cache-Control', 'private');
         $response->headers->set('Content-type', mime_content_type($zipName));
         $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($zipName) . '"');
         $response->headers->set('Content-length', filesize($zipName));
    
                           $response->sendHeaders();

                         $response->setContent(readfile($zipName));

         return $response;
            }

       
         }
         
        return $this->render('album/index.html.twig', array(
            'albums' => $albums,
              'form' => $form->createView(),
        ));

     }


 
    

    /**
     * Creates a new album entity.
     *
     */
    public function newAction(Request $request)
    {


         $em = $this->getDoctrine()->getManager();

        //var_dump($albums);
        //die();
        $album = new album();
        $form = $this->createForm('Activite\ActiviteBundle\Form\AlbumType', $album)
         ->add('Upload', SubmitType::class, array('label' => 'Upload'));

        $form->handleRequest($request);
        $album->setUser($this->get('security.token_storage')->getToken()->getUser());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($album);
            $em->flush();

            return $this->redirectToRoute('album_index');
        }
        return $this->render('album/new.html.twig', array(
            'album' => $album,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a album entity.
     *
     */
    public function showAction(album $album)
    {
        $deleteForm = $this->createDeleteForm($album);

        return $this->render('album/show.html.twig', array(
            'album' => $album,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing album entity.
     *
     */
    public function editAction(Request $request, album $album)
    {
        $deleteForm = $this->createDeleteForm($album);
        $editForm = $this->createForm('Activite\ActiviteBundle\Form\AlbumType', $album);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('album_edit', array('id' => $album->getId()));
        }

        return $this->render('album/edit.html.twig', array(
            'album' => $album,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a album entity.
     *
     */
    public function deleteAction(Request $request, album $album)
    {
        $form = $this->createDeleteForm($album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($album);
            $em->flush();
        }

        return $this->redirectToRoute('album_index');
    }

    /**
     * Creates a form to delete a album entity.
     *
     * @param Album $album The album entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(album $album)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('album_delete', array('id' => $album->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
