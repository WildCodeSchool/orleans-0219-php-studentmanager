<?php

namespace App\Controller;

use App\Entity\User;
use Exception;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('/security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/forgotten_password", name="app_forgotten_password")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @param TokenGeneratorInterface $tokenGenerator
     * @return Response
     */
    public function forgottenPassword(
        Request $request,
        Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User */
            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('app_forgotten_password"');
            }
            $token = $tokenGenerator->generateToken();
            try {
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('app_login');
            }
            $url = $this->generateUrl(
                'app_reset_password',
                array('token' => $token),
                UrlGeneratorInterface::ABSOLUTE_URL
            );
            $message = (new Swift_Message('Mot de passe oublié'))
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($user->getEmail())
                ->setCharset('utf-8')
                ->setBody(
                    "Cliquez sur le lien pour renouveler votre mot de passe : " . $url,
                    'text/html'
                );
            $mailer->send($message);
            $this->addFlash('success', 'Mail envoyé');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/forgotten_password.html.twig');
    }

    /**
     * @Route("/reset_password/{token}", name="app_reset_password")
     * @param Request $request
     * @param string $token
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            /* @var $user User */
            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('app_reset_password');
            }
            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();
            $this->addFlash('success', 'Mot de passe mis à jour');
            return $this->redirectToRoute('app_login');
        } else {
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(): void
    {
    }
}
