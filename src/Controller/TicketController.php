<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="ticket")
     */
    public function index(): Response
    {
        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
        ]);

    }

    /**
     * @Route("/send",name="send")
     */
    public function send(Request $Request):response

      {
        $ticket = new Ticket;
        $form = $this->createForm(TicketType::class, $ticket);
        
        $form->handleRequest($Request);

        if($form->isSubmitted() && $form->isValid()){
            
            $ticket->setSender($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();

            $this->addFlash("ticket", "message envoyé avec succès.");
            return $this->redirectToRoute("ticket");
      }


      return $this->render('ticket/send.html.twig',[
          "form"=>$form->CreateView()
      ]);
    }

     /**
     * @Route("/received", name="received")
     */
    public function received(): Response
    {
        return $this->render('ticket/received.html.twig');

    }


     /**
     * @Route("/read/{id}", name="read")
     */
    public function read($id): Response
    {
        $ticket = $this->getDoctrine()->getRepository(Ticket::class)->find($id);

        return $this->render('ticket/read.html.twig',[
            'ticket'=> $ticket
        ]);
    }
     /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Ticket $ticket): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($ticket);
        $em->flush();
        return $this->redirectToRoute("received");

    }


     /**
     * @Route("/sent", name="sent")
     */
    public function sent(): Response
    {
        return $this->render('ticket/sent.html.twig');

    }
}
