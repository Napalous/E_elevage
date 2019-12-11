<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Bovin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Repository\BovinRepository;

class CommanderController extends AbstractController
{
    /**
     * @Route("/commander", name="commander")
     */
    public function index(ProduitRepository $produitRepository,BovinRepository $bovinRepository)
    {
        //$bovinRepository->findOneBy();
        //$cpt=count($bovinRepository->findOneBy(['types' => 'boucherie']));
        return $this->render('commander/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
}
