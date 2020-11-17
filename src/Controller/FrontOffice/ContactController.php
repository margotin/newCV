<?php

namespace App\Controller\FrontOffice;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->captcha($request)) {
                $contact = $form->getData();
                $nom = htmlspecialchars($contact['nom']);
                $email = htmlspecialchars($contact['adresseMail']);
                $message = htmlspecialchars($contact['message']);

                $email = (new Email())
                    ->from($this->getParameter('app.mailFrom'))
                    ->to($this->getParameter('app.mailTo'))
                    ->replyTo($email)
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject('Message depuis https://mathieumargotin.fr')
                    ->html('<p> message de ' . $nom . ' :<br/>' . $message . '</p>');

                try {
                    $mailer->send($email);
                    $this->addFlash("success", "Votre message a bien été envoyé !");
                } catch (TransportExceptionInterface $e) {
                    $this->addFlash("danger", "Une erreur est survenue, veuillez réessayer ultérieurement !");
                }
            } else {
                $this->addFlash("danger", "ReCAPTACHA non valide, veuillez réessayer ultérieurement !");
            }
            return $this->redirectToRoute('contact');
        }
        return $this->render('front_office/contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }


    private function captcha(Request $request): bool
    {

        (new DotEnv())->load(dirname(__DIR__) . '/../../.env');

        $handlingRequest = false;
        $humanKey = $request->get('g-recaptcha-response');
        $secret = $this->getParameter('app.captchaSecret');

        if (!empty($secret) && !empty($humanKey)) {

            $postFields = sprintf('secret=%s&response=%s', $secret, $humanKey);
            unset($humanKey, $secret);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postFields,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded; charset=utf-8",
                    "Accept: application/json"
                ),
            ));

            $isHuman = curl_exec($curl);
            curl_close($curl);

            if ($isHuman !== false) {
                $isHuman = json_decode($isHuman, true);

                if (isset($isHuman['success'])) {
                    if ($isHuman['success'] === true) {
                        $handlingRequest = true;
                    }
                }
            }
        }

        return $handlingRequest;
    }
}
