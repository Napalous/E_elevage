<?php

namespace App\Controller;

use App\Entity\Production;
use App\Form\ProductionType;
use App\Repository\ProductionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
    public function new(Production $production=null,Request $request,BovinRepository $bovinRep): Response
    {
        if(!$production){
            $production = new Production();
        }
        
        $form = $this->createFormBuilder($production)
                    ->add('nbre_mort')
                    ->add('bovin',EntityType::class,[
                        'class' => Bovin::class,
                        'choices' => $bovinRep->findBy(['sexe' => 'F']),
                        'expanded' => false,
                        'multiple' => false,
                    ])
                    ->add('date_production')
                    ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $production->setNbreMort($production->getNbreMort());
            $production->setNbreVivant(0);
            $production->setNbreVeau(0);
            $production->setNbreMiseBas(0);
            $production->setTauxProduction(0);
            $production->setTauxMortalite(0);
            
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
        /*dump($production->getNbreVeau());
        dump($production->getNbreMiseBas());
        dump($production->getNbreVivant()-$production->getNbreMort());
        dump($production->getNbreMort());
        die();*/
        //$prod = new Production();
        if ($form->isSubmitted() && $form->isValid()) {
            if($production->getNbreVivant() > $production->getNbreMort() ){
            $production->setNbreVivant($production->getNbreVivant()-$production->getNbreMort());
            $production->setNbreMort($production->getNbreMort());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('production_index');
            }
            else {
            //$production->setNbreVivant($production->getNbreVivant()-$production->getNbreMort());
            $production->setNbreVivant(0);
            $production->setNbreMort($production->getNbreMort());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('production_index');
            }
            
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
