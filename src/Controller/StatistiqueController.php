<?php

namespace App\Controller;
use App\Entity\Stock;
use App\Form\StockType;
use App\Repository\StockRepository;
use App\Repository\LivraisonRepository;
use App\Repository\VenteRepository;
use App\Repository\DetailsCommandeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueController extends AbstractController
{
    /**
     * @Route("/statistique", name="statistique")
     */
    public function index(StockRepository $stockRepository,StockRepository $stockRepository1)
    {
    	$stocks = $stockRepository->findAll();
    	$stockdates = $stockRepository1->findAll();
    	$note = array();
        foreach ($stocks as $key => $variable) 
        {
            $myarray = array('id' => "".$variable->getId()."",  'quantite' => $variable->getQuantite(),'datestocks' => $variable->getDateStock());
            array_push($note,$myarray);
        }
        $data = [
            'notes' => $note];
           // $stocks= return new Response(json_encode($note));

    	//dump($stockdates->getDateStock(new \DateTime()));
    	//die();

        return $this->render('statistique/index.html.twig', [
            'stock' => json_encode($note),
            'stocks_dates' => $stockdates,
        ]);
    }

    /**
     * @Route("/statistique2", name="statistique2")
     */
    public function index2(VenteRepository $venteRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $sql="SELECT sum(prix) as montant,
        create_at FROM `Vente`  group by(day(create_at))";
        $result = $em->getConnection()->prepare($sql);
        $result->execute();
        //$cpt = count($result->fetch());
        //die();
        
           //$stocks= return new Response(json_encode($note));
        /*dump($venteRepository->findBy(array(),array(
            'createAt' => 'Desc')));
        die();
        /*dump($venteRepository->findAll());
        die();*/

        return $this->render('statistique/index2.html.twig', [
            'ventes' => $result->fetch(),       
        ]);
    }
}
