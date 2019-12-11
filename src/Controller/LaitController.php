<?php

namespace App\Controller;

use App\Entity\Lait;
use App\Form\LaitType;
use App\Repository\LaitRepository;
use App\Entity\Stock;
use App\Form\StockType;
use App\Repository\StockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lait")
 */
class LaitController extends AbstractController
{
    /**
     * @Route("/", name="lait_index", methods={"GET"})
     */
    public function index(LaitRepository $laitRepository): Response
    {
        return $this->render('lait/index.html.twig', [
            'laits' => $laitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lait_new", methods={"GET","POST"})
     */
    public function new(Request $request,StockRepository $stockRep): Response
    {
        $lait = new Lait();
        $form = $this->createForm(LaitType::class, $lait);
        $form->handleRequest($request);
        $entityManagers = $this->getDoctrine()->getManager();
        $guic = $entityManagers->getRepository(Stock::class)->findAll();

        if(count($guic)==0){                

        if ($form->isSubmitted() && $form->isValid()) {

            $stock =new Stock();
            $stock->setQuantite($lait->getQuantite());
            $stock->setDateStock(new \DateTime());
            $stock->setLaits(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stock);
            $entityManager->flush();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lait);
            $entityManager->flush();

            return $this->redirectToRoute('lait_index');
        }

        return $this->render('lait/new.html.twig', [
            'lait' => $lait,
            'form' => $form->createView(),
        ]);

        }

        else
        {

            if ($form->isSubmitted() && $form->isValid()) {

                $tab = [];
                $_tab = [];
                $compteur = [];
                foreach($guic as $tab)
                {
                    $_tab['quantite'] = $tab->getQuantite();
                }
                //dump($_tab['quantite']);
            $stock = new Stock();
            $stock->setQuantite($_tab['quantite']+$lait->getQuantite());
            $stock->setDateStock(new \DateTime());
            $stock->setLaits(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stock);
            $entityManager->flush();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lait);
            $entityManager->flush();

            return $this->redirectToRoute('lait_index');
        }

        return $this->render('lait/new.html.twig', [
            'lait' => $lait,
            'form' => $form->createView(),
        ]);
        }
    }


    /**
     * @Route("/{id}", name="lait_show", methods={"GET"})
     */
    public function show(Lait $lait): Response
    {
        return $this->render('lait/show.html.twig', [
            'lait' => $lait,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lait_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lait $lait): Response
    {
        $form = $this->createForm(LaitType::class, $lait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lait_index');
        }

        return $this->render('lait/edit.html.twig', [
            'lait' => $lait,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lait_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lait $lait): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lait->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lait);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lait_index');
    }
}
