<?php
namespace App\Service;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\AdressesRequest;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class AdresseRequestService
{
    public function __construct(
        private EntityManagerInterface $em,
        private HttpClientInterface $client,
    ){}

    public function handleAdressRequest(string $searchAddresseParam, string $ip)
    {
        // sauvegarde de la requête en base
        $addReq = $this->saveRequest($searchAddresseParam, $ip);

        // récupération des adresses via l'api gouv
        $resultContent = $this->getAdressesFromGouv($searchAddresseParam);

        // traitement du résultat
        $result = $this->handleResultContent($resultContent);

        return $result ;
    }

    public function saveRequest(string $searchAddresseParam, string $ip): AdressesRequest
    {
        // création del'objet AdressesRequest
        // dans l'idéal j'aurais ajouter un attribut status pour stocker la bonne éxecution de la requête et gérer les erreurs
        $addReq = new AdressesRequest();
        $addReq->setRequestParams($searchAddresseParam);
        $addReq->setRequestIp($ip);
        $addReq->setTimestamp(new \Datetime);

        $this->em->persist($addReq);

        $this->em->flush();

        // le retour de l'objet AdressesRequest n'est pas utile ici, mais il pourrait être utilisé pour des tests
        return $addReq ;

    }

    // Idealement j'aurais fait un service dédié aux appel api dasn laquelle aurait été cette méthode
    public function getAdressesFromGouv(string $searchAddresseParam)
    {

        $response = $this->client->request('GET', 'https://api-adresse.data.gouv.fr/search/', [
            'query' => [
                'q' => $searchAddresseParam,
            ],
        ]);

        // le status code devait être utilisé pour gérer les erreurs, j'ai manqué de temps pour le faires
        $statusCode = $response->getStatusCode();
        
        $content = $response->toArray();

        return $content;
 
    }

    public function handleResultContent($resultContent): array
    {
        $adresses = [];
        
        foreach ($resultContent['features'] as $rawAdresse) {
            
            
            $adresse = [
                'adresse' => $rawAdresse['properties']['label'],
                'ville' => $rawAdresse['properties']['city'],
            ];
            $adresses[] = $adresse;
          }
        return $adresses;
    }

}