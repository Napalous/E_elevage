<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RaceRepository;
use App\Repository\ReunionRepository;
use App\Repository\CommandeRepository;
use App\Repository\LivraisonRepository;
use Symfony\Component\Validator\Constraints\Date;
//use App\Repository\BovinRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(RaceRepository $raceRepository,ReunionRepository $reunionRepository,LivraisonRepository $livRepository,CommandeRepository $cmdRepository)
    {
    	//dump($raceRepository->findAll());
    	//dump($bovinRepository->findAll());
    	//dump($bovinRepository->findBy(['races' => $raceRepository->getId()]));
        
        /*$reunion = $reunionRepository->findBy(['date_reunion' => $datetoday]);
        //dump($datetoday->format('Y/m/d'));*/
        
        
        $cmd = count($cmdRepository->findAll()) - count($livRepository->findAll());
        //die();
    	//die();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'races' => $raceRepository->findAll(),
            'reunions' => $reunionRepository->findAll(),
            'cmd' => $cmd,
        ]);
    }
}
