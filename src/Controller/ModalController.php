<?php

namespace App\Controller;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;

use App\Entity\DetailsCommande;
use App\Form\DetailsCommandeType;
use App\Repository\DetailsCommandeRepository;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Service\CartService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ModalController extends AbstractController
{
    /**
     * @Route("/modal", name="modal")
     */
    public function index()
    {
        return $this->render('modal/index.html.twig', [
            'controller_name' => 'ModalController',
        ]);
    }

    /**
     * @Route("/addClient/{tel}", name="cmd_addClient")
     */
    public function addClient($tel)
    {        
            $cartService=new CartService();
            $client = new Client();
            $pro= new Produit();
            dump($client);
            dump($cartService->getFullCart());
            die();
        $client->setTel($tel);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($client);
        $entityManager->flush();


            $cmd = new Commande();
            $cmd->setClients($client);
            $cmd->setDatecommande(new \DateTime());            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cmd);
            $entityManager->flush();

            /*$pro= new Produit();
            dump($client);
            dump($pro->getLibelle());
            die();*/

            $detailscmd =new DetailsCommande();
            $detailscmd->setCommande($cmd);
            $detailscmd->setProduits(); 
            $detailscmd->setPrixUnitaire();
            $detailscmd->setQtecommandee();           

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($detailscmd);
            $entityManager->flush();
        
        return $this->redirectToRoute('commander');
    }
}
