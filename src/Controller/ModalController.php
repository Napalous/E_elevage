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

use App\Entity\Facture;
use App\Form\FactureType;
use App\Repository\FactureRepository;
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
     * @Route("/addClient/", name="cmd_addClient")
     */
    public function addClient(CartService $cartService)
    {                    
            $client = new Client();
            /*echo json_encode($_POST['tel']);
            die();*/
           /* $pro= new Produit();
            dump($client);*/           
            $tel = $_POST['tel'];
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
            $items=$cartService->getFullCart();

            $total=$cartService->getTotal();
            

            foreach ($items as $key => $value) 
            {
                /*dump($value['product']->getPrix());
                dump($value['quantity']);
                die();*/

                $detailscmd =new DetailsCommande();
                $detailscmd->setCommande($cmd);
                $detailscmd->setProduits($value['product']); 
                $detailscmd->setPrixUnitaire($value['product']->getPrix());
                $detailscmd->setQtecommandee($value['quantity']);           

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($detailscmd);
                $entityManager->flush();                
            }        
            
            
            $facture =new Facture();
            $facture->setCommande($cmd);
            $facture->setMontant($total);
            $facture->setDateFacture(new \DateTime());  
                      

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($facture);
             
            $entityManager->flush();
            echo json_encode($client->getId());
            die(); 
    }
}
