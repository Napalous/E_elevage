<?php

namespace App\Controller;

use App\Entity\Production;
use App\Form\ProductionType;
use App\Repository\ProductionRepository;
use App\Entity\Bovin;
use App\Form\BovinType;
use App\Repository\BovinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/production")
 */
class ProductionController extends AbstractController
{
    /**
     * @Route("/", name="production_index", methods={"GET"})
     */
    public function index(ProductionRepository $productionRepository,BovinRepository $bovinRep): Response
    {
        $entityManagers = $this->getDoctrine()->getManager();
        $cptbovin = $entityManagers->getRepository(Bovin::class)->findAll();
        $cpt=count($cptbovin);

        return $this->render('production/index.html.twig', [
            'productions' => $productionRepository->findAll(),
            'cpt' => $cpt,
        ]);
    }

    /**
     * @Route("/new", name="production_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $production = new Production();
        $form = $this->createForm(ProductionType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($production);
            $entityManager->flush();

            return $this->redirectToRoute('production_index');
        }

        return $this->render('production/new.html.twig', [
            'production' => $production,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="production_show", methods={"GET"})
     */
    public function show(Production $production): Response
    {
        return $this->render('production/show.html.twig', [
            'production' => $production,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="production_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Production $production): Response
    {
        $form = $this->createForm(ProductionType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('production_index');
        }

        return $this->render('production/edit.html.twig', [
            'production' => $production,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="production_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Production $production): Response
    {
        if ($this->isCsrfTokenValid('delete'.$production->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($production);
            $entityManager->flush();
        }

        return $this->redirectToRoute('production_index');
    }
}
