<?php

use PHPUnit\Framework\TestCase;
use App\Service\AdresseRequestService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\AdressesRequest;


class AdresseRequestServiceTest extends TestCase
{
 
    public function testHandleAdressRequest()
    {
        // Crée une instance de la classe AdresseRequestService
        $em = $this->createMock(EntityManagerInterface::class);
        $client = $this->createMock(HttpClientInterface::class);
        #$adresseRequestService = new AdresseRequestService($em, $client);

        // Paramètres de test
        $searchAddresseParam = "123 Main St";
        $ip = "127.0.0.1";


        $resultContent = ['features' => ['1' => ['properties' => ['label' => '123 Main St', 'city' => 'Springfield']]], ['2' => ['properties' => ['label' => '123 Main St', 'city' => 'Springfield']]]];
        $mockedObject = $this->getMockBuilder(AdresseRequestService::class)
            ->setMethods(['getAdressesFromGouv'])
            ->setConstructorArgs([$em, $client])
            ->getMock();
        $mockedObject->expects($this->any())
            ->method("getAdressesFromGouv")
            ->willReturn($resultContent);
        $result = $mockedObject->handleAdressRequest($searchAddresseParam, $ip);

        $this->assertIsArray($result);
    }

    public function testSaveRequest()
    {
        // Crée une instance de la classe AdresseRequestService
        $em = $this->createMock(EntityManagerInterface::class);
        $client = $this->createMock(HttpClientInterface::class);
        $adresseRequestService = new AdresseRequestService($em, $client);

        // Paramètres de test
        $searchAddresseParam = "123 Main St";
        $ip = "127.0.0.1";

        // Appelle la méthode à tester
        $result = $adresseRequestService->saveRequest($searchAddresseParam, $ip);

        // Vérifie le résultat attendu
        $this->assertInstanceOf(AdressesRequest::class, $result);
    }
    public function testGetAdressesFromGouv()
    {
        // Crée une instance de la classe AdresseRequestService
        $em = $this->createMock(EntityManagerInterface::class);
        $client = $this->createMock(HttpClientInterface::class);
        $adresseRequestService = new AdresseRequestService($em, $client);

        // Paramètres de test
        $searchAddresseParam = "123 Main St";

        // Appelle la méthode à tester
        $result = $adresseRequestService->getAdressesFromGouv($searchAddresseParam);

        // Vérifie le résultat attendu
        $this->assertIsArray($result);

    }
    
    public function testHandleResultContent()
    {
        // Crée une instance de la classe AdresseRequestService
        $em = $this->createMock(EntityManagerInterface::class);
        $client = $this->createMock(HttpClientInterface::class);
        $adresseRequestService = new AdresseRequestService($em, $client);

        $resultContent = ['features' => ['0' => ['properties' => ['label' => '123 Main St', 'city' => 'Springfield']]], ['1' => ['properties' => ['label' => '321 High St', 'city' => 'Springfield']]]];

        // Appelle la méthode à tester
        $result = $adresseRequestService->handleResultContent($resultContent);

        // Vérifie le résultat attendu
        $this->assertIsArray($result);

    }
}