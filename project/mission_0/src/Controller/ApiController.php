<?php
// src/Controller/ApiController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Service\AdresseRequestService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use \Datetime;

class ApiController extends AbstractController
{
    
    #[Route('/api/adresses', name: 'api_adresses', methods:['post'] )]
    public function adresses(Request $request, AdresseRequestService $addReqService): Response
    {

        // récuparation des paramètres de la requête
        $data = json_decode($request->getContent(), true);
        // isolation de l'adresse recherchée
        $searchAddresseParam = $data['adresse'];
        // récupération de l'ip du client
        $ip = $request->getClientIp();

        // appel au service pour le traitement de la requête
        $jsonResponse  = $addReqService->handleAdressRequest($searchAddresseParam, $ip);
        
        return new Response( json_encode($jsonResponse) );

    }
}