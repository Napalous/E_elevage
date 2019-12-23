<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Entity\Stock;
use App\Form\LivraisonType;
use App\Repository\LivraisonRepository;
use App\Repository\ProduitRepository;
use App\Repository\DetailsCommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/livraison")
 */
class LivraisonController extends AbstractController
{
    /**
     * @Route("/", name="livraison_index", methods={"GET"})
     */
    public function index(LivraisonRepository $livraisonRepository): Response
    {
        return $this->render('livraison/index.html.twig', [
            'livraisons' => $livraisonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="livraison_new", methods={"GET","POST"})
     */
    public function new(Request $request,DetailsCommandeRepository $detailsCommandeRepository,ProduitRepository $produiteRepository): Response
    {
        $livraison = new Livraison();
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);
        $entityManagers = $this->getDoctrine()->getManager();
        $guic = $entityManagers->getRepository(Stock::class)->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($livraison);
            $entityManager->flush();

            if(count($guic)==0)
            {

            }
            else
            {
                $tab = [];
                $_tab = [];
                $compteur = [];
                foreach($guic as $tab)
                {
                    $_tab['quantite'] = $tab->getQuantite();
                }


                $pro=$produiteRepository->findBy(['libelle' => 'lait']);
            //dump($pro);
           $dt=$detailsCommandeRepository->findBy([
                'commande' => $livraison->getCommande(),
                'produits'=> $pro
            ]);

                $stock = new Stock();
                $stock->setQuantite($_tab['quantite']-$dt[0]->getQtecommandee());
                $stock->setDateStock(new \DateTime());
                $stock->setLaits(null);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($stock);
                $entityManager->flush();
            }

            //dump($livraison->getCommande());            

            return $this->redirectToRoute('livraison_index');
        }

        return $this->render('livraison/new.html.twig', [
            'livraison' => $livraison,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livraison_show", methods={"GET"})
     */
    public function show(Livraison $livraison): Response
    {
        return $this->render('livraison/show.html.twig', [
            'livraison' => $livraison,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="livraison_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livraison $livraison): Response
    {
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livraison_index');
        }

        return $this->render('livraison/edit.html.twig', [
            'livraison' => $livraison,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livraison_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Livraison $livraison): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livraison->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livraison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livraison_index');
    }
}
