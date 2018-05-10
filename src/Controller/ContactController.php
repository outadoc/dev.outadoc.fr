<?php

    namespace App\Controller;

    use App\Entity\Message;
    use App\Form\Type\MessageType;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Request;

    class ContactController extends Controller
    {

        /**
         * @Route("/contact", name="contact")
         * @Route("/contact/")
         * @param Request $request
         * @return \Symfony\Component\HttpFoundation\Response
         */
        public function indexAction(Request $request)
        {
            $message = new Message();
            $form = $this->createForm(MessageType::class, $message);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // Send an email with the message
                $message = \Swift_Message::newInstance()
                    ->setSubject('Message from ' . $message->getName())
                    ->setFrom($message->getEmail())
                    ->setTo('outadoc+dev@gmail.com')
                    ->setBody(
                        $this->renderView(
                            'contact/email.html.twig',
                            array('message' => $message)
                        ),
                        'text/html'
                    );

                $this->get('mailer')->send($message);
            }

            return $this->render('contact/index.html.twig', array(
                'form'  => $form->createView(),
                'valid' => $form->isSubmitted() && $form->isValid()
            ));
        }

        /**
         * @deprecated
         * @Route("/contact.html")
         */
        public function oldIndexAction()
        {
            return $this->redirectToRoute('contact', array(), 301);
        }

    }
