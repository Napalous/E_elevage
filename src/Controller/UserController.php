<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setDateCreation(new \DateTime());
            $hash=$encoder->encodePassword($user, $user->getPassword()); 
            $user->setPassword($hash); 
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    
    /**
     * @Route("/bloquer", name="user_bloquer", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function bloquer(Request $request): Response
    {
        if($request->isXmlHttpRequest())
        {
            $id = $_POST['id'];
            $user = $this->getDoctrine()->getRepository(User::class)->find($id);
            if($user)
            {
                if($user->getActive())
                {
                    $user->setActive(false);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();
                    return new JsonResponse([
                        'status' => 'success',
                        'message' => "L'utilisateur est bloqué"
                    ]);
                }
                else
                {
                    $user->setActive(true);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();
                    return new JsonResponse([
                        'status' => 'success',
                        'message' => "L'utilisateur est activé"
                    ]);
                }
            }
            return new JsonResponse([
                'status' => 'error',
                'message' => "L'utilisateur n'existe pas"
            ]);
        }
    }

    /**
  * Require ROLE_ADMINISTRATEUR for *every* controller method in this class.
  *
  * @IsGranted("ROLE_ADMINISTRATEUR")
  */
  public function adminDashboard()
{
    $this->denyAccessUnlessGranted('ROLE_ADMINISTRATEUR');

    // or add an optional message - seen by developers
    $this->denyAccessUnlessGranted('ROLE_ADMINISTRATEUR', null, 'User tried to access a page without having ROLE_ADMINISTRATEUR');
}
/**
  * Require ROLE_RESPONSABLE for *every* controller method in this class.
  *
  * @IsGranted("ROLE_RESPONSABLE")
  */
  public function responsableDashboard()
{
    $this->denyAccessUnlessGranted('ROLE_RESPONSABLE');

    // or add an optional message - seen by developers
    $this->denyAccessUnlessGranted('ROLE_RESPONSABLE', null, 'User tried to access a page without having ROLE_RESPONSABLE');
}



/**
  * Require ROLE_VETERINAIRE for *every* controller method in this class.
  *
  * @IsGranted("ROLE_VETERINAIRE")
  */
  public function veterinaireDashboard()
{
    $this->denyAccessUnlessGranted('ROLE_VETERINAIRE');

    // or add an optional message - seen by developers
    $this->denyAccessUnlessGranted('ROLE_VETERINAIRE', null, 'User tried to access a page without having ROLE_VETERINAIRE');
}

/**
  * Require ROLE_LIVREUR for *every* controller method in this class.
  *
  * @IsGranted("ROLE_LIVREUR")
  */
  public function livreurDashboard()
{
    $this->denyAccessUnlessGranted('ROLE_LIVREUR');

    // or add an optional message - seen by developers
    $this->denyAccessUnlessGranted('ROLE_LIVREUR', null, 'User tried to access a page without having ROLE_LIVREUR');
}

}
