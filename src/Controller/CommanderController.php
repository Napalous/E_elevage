<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Bovin;
use App\Entity\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Repository\BovinRepository;
use App\Repository\StockRepository;
use App\Service\CartService;

class CommanderController extends AbstractController
{
    /**
     * @Route("/commander", name="commander")
     */
    public function index(ProduitRepository $produitRepository,BovinRepository $bovinRepository,CartService $cartService,StockRepository $stockRepository)
    {
        /*CartService $cartService;
         $items=$cartService->getFullCart();*/
         //dump($produitRepository->findAll());
         //die();
         /*dump($stockRepository->findBy(array(),array('id'=>'DESC'),1));
         die();*/
        //$bovinRepository->findOneBy();
        //$cpt=count($bovinRepository->findOneBy(['types' => 'boucherie']));
        //dump();
        //die();
        return $this->render('commander/index.html.twig', [
            'produits' => $produitRepository->findAll(),
            'bovins' => $bovinRepository-> findAll(),
            'stocks' => $stockRepository->findBy(array(),array('id'=>'DESC'),1),
        ]);
    }
}
