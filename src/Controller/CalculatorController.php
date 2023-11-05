<?php

namespace App\Controller;

use App\Form\CalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    /**
     * @Route("/", name="calcul")
     */
    public function addition(Request $request): Response
    {
        $result = null;
        $devise = null;
        $formData = [];

        $euro = 'euro';
        $dollar = 'dollar';
        $euroChange = 1;
        $dollarChangeEuro = $euroChange * 0.90;
        
        // Création du formulaire
        $form = $this->createForm(CalculatorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();
            // Rendu en fonction des devises choisies
            if ($formData['devise1'] === $dollar && $formData['devise2'] === $dollar) {
                $result = $formData['valeur1'] + $formData['valeur2'];
                $devise = 'dollars';
            } elseif($formData['devise1'] === $dollar || $formData['devise2'] === $dollar) {
                if ($formData['devise1'] === $dollar){
                    $result = ($formData['valeur1'] * $dollarChangeEuro) + $formData['valeur2'];
                } else {
                    $result = $formData['valeur1'] + ($formData['valeur2'] * $dollarChangeEuro);
                }
                $devise = 'euros';
            } else {
                $devise = 'euros';
                $result = $formData['valeur1'] + $formData['valeur2'];
            }
        }

        return $this->render('calculator.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
            'devise' => $devise,
        ]);
    }
}