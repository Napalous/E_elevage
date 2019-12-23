<?php

namespace App\Controller;

use App\Entity\Bovin;
use App\Form\BovinType;
use App\Repository\BovinRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Production;
use App\Form\ProductionType;
use App\Repository\ProductionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @Route("/bovin")
 */
class BovinController extends AbstractController
{
    /**
     * @Route("/", name="bovin_index", methods={"GET"})
     */


    public function index(BovinRepository $bovinRepository): Response
    {
        /*$bovin=$bovinRepository->findAll();
        dump($bovin);
        die();*/
        return $this->render('bovin/index.html.twig', [
            'bovins' => $bovinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bovin_new", methods={"GET","POST"})
     */
    public function new(Bovin $bovin=null, Request $request,ProductionRepository $stockRep,BovinRepository $bovinRep): Response
    {
        if(!$bovin){
            $bovin = new Bovin();
        }
        
        $form = $this->createFormBuilder($bovin)
                    ->add('numero_ordre')
                    ->add('sexe', ChoiceType::class, [
                        'choices' => [                    
                            'Mâle' => 'M',
                            'Femelle' => 'F',                
                                    ]
                        ])
                    ->add('date_naissance')
                    ->add('categories')
                    ->add('races')
                    ->add('types')
                    ->add('bovin',EntityType::class,[
                        'class' => Bovin::class,
                        'choices' => $bovinRep->findBy(['sexe' => 'F']),
                        'expanded' => false,
                        'multiple' => false,
                    ])
                    ->getForm();
        $form->handleRequest($request);

        $entityManagers = $this->getDoctrine()->getManager();
        $cptbovin = $entityManagers->getRepository(Bovin::class)->findAll();
        $cpt=count($cptbovin);
        //die();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
                        
            if($bovin->getBovin() != null){
            $entityManagers = $this->getDoctrine()->getManager();
            $guic = $entityManagers->getRepository(Production::class)->findOneBy([
                'bovin' => $bovin->getBovin()->getId(),
            ]);

            if($guic==null && $bovin->getBovin()->getSexe()=='F'){
                
                $entityManager->persist($bovin);
                $entityManager->flush();
                //dump()
                //die();
            $production =new Production();
            $production->setBovin($bovin->getBovin());
            $production->setNbreMiseBas(1);
            $production->setNbreVeau(1);
            $production->setNbreVivant(1);
            $production->setNbreMort(0);
            $production->setTauxProduction((1/$cpt)*100);
            $production->setTauxMortalite(0); 
            $production->setDateProduction(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($production);
            $entityManager->flush();
            

            return $this->redirectToRoute('bovin_index');
            }
            elseif ($guic !=null && $bovin->getBovin()->getSexe()=='F') {
            
            $entityManager->persist($bovin);
            $entityManager->flush();    

            $production =new Production();
            $production->setBovin($bovin->getBovin());
            $production->setNbreMiseBas(1+$guic->getNbreMiseBas());
            $production->setNbreVeau(1+$guic->getNbreVeau());
            $production->setNbreVivant(1+$guic->getNbreVivant());
            $production->setNbreMort($guic->getNbreMort());
            $production->setTauxProduction((1+$guic->getNbreMiseBas())/(1+$cpt)*100);
            $production->setTauxMortalite($guic->getTauxMortalite()); 
            $production->setDateProduction(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($production);
            $entityManager->flush();

            $entityManager->persist($bovin);
            $entityManager->flush();

            return $this->redirectToRoute('bovin_index');
                # code...
            }
        }
        else{
            $entityManager->persist($bovin);
            $entityManager->flush();

            return $this->redirectToRoute('bovin_index');
            }
            /*dump($guic);
            dump($bovin->getBovin()->getSexe());
            die();*/

            
        }

        return $this->render('bovin/new.html.twig', [
            'bovin' => $bovin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bovin_show", methods={"GET"})
     */
    public function show(Bovin $bovin): Response
    {
        return $this->render('bovin/show.html.twig', [
            'bovin' => $bovin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bovin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bovin $bovin): Response
    {
        $form = $this->createForm(BovinType::class, $bovin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bovin_index');
        }

        return $this->render('bovin/edit.html.twig', [
            'bovin' => $bovin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bovin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bovin $bovin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bovin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bovin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bovin_index');
    }
}
