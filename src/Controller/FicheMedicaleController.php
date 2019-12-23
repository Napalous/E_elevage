<?php

namespace App\Controller;

use App\Entity\FicheMedicale;
use App\Form\FicheMedicaleType;
use App\Repository\FicheMedicaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fiche/medicale")
 */
class FicheMedicaleController extends AbstractController
{
    /**
     * @Route("/", name="fiche_medicale_index", methods={"GET"})
     */
    public function index(FicheMedicaleRepository $ficheMedicaleRepository): Response
    {
        return $this->render('fiche_medicale/index.html.twig', [
            'fiche_medicales' => $ficheMedicaleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fiche_medicale_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ficheMedicale = new FicheMedicale();
        $form = $this->createForm(FicheMedicaleType::class, $ficheMedicale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ficheMedicale);
            $entityManager->flush();

            return $this->redirectToRoute('fiche_medicale_index');
        }

        return $this->render('fiche_medicale/new.html.twig', [
            'fiche_medicale' => $ficheMedicale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_medicale_show", methods={"GET"})
     */
    public function show(FicheMedicale $ficheMedicale): Response
    {
        return $this->render('fiche_medicale/show.html.twig', [
            'fiche_medicale' => $ficheMedicale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fiche_medicale_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FicheMedicale $ficheMedicale): Response
    {
        $form = $this->createForm(FicheMedicaleType::class, $ficheMedicale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fiche_medicale_index');
        }

        return $this->render('fiche_medicale/edit.html.twig', [
            'fiche_medicale' => $ficheMedicale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_medicale_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FicheMedicale $ficheMedicale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheMedicale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ficheMedicale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fiche_medicale_index');
    }
}
