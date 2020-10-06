<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Entreprise;
use App\Entity\User;
use App\Form\RegistrationFormCandidatType;
use App\Form\RegistrationFormEntrepriseType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\RoutinResponseg\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register/{type<[12]>}", name="app_register")
     * @param int $type
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function register(int $type=0, Request $request, UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if ($type !=0 ) {
            if ($type == 1) {
                $user = new Candidat();
                $form = $this->createForm(RegistrationFormCandidatType::class, $user);
            } else if ($type == 2) {
                $user = new Entreprise();
                $form = $this->createForm(RegistrationFormEntrepriseType::class, $user);

            }

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $passwordEncoded = $passwordEncoder->encodePassword($user, $form->get('password')->getData());
                $user->setPassword($passwordEncoded);

                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('app_login');
            }
                return $this->render('registration/register.html.twig',[
            'form'=> $form->createView()
        ]);
        }

            return $this->redirectToRoute('main');

        }

}
