<?php

namespace App\Command;

use App\Core\Onboarding\Doctrine\Entity\Country;
use App\Core\Onboarding\Doctrine\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertDataCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this->setName('app:insert-data')
            ->setDescription('Insert data into client and country tables');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $country1 = new Country();
        $country1->setName('Colombia')->setCode('CO');
        $this->entityManager->persist($country1);

        $country2 = new Country();
        $country2->setName('Venezuela')->setCode('VE');
        $this->entityManager->persist($country2);

        $client1 = new Client();
        $client1->setCountry($country1)
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setNewsletter(true)
            ->setLanguage('us-en')
            ->setSource('Source 1')
            ->setData([
                'saludation' => 'Hola Soy John',
                'phone' => '123-456-89',
                'email' => 'john@example.com'
            ])
            ->setAddress([
                'country' => 'Colombia',
                'city' => 'Medellin',
                'street' => 'av. oriental',
                'number' => '#50 - 37',
                'comments' => 'no comments'
            ])
            ->setRegion('LATAM')
            ->setBrand('BMW')
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($client1);

        $client2 = new Client();
        $client2->setCountry($country2)
            ->setFirstName('Angel')
            ->setLastName('Pacheco')
            ->setNewsletter(true)
            ->setLanguage('es-co')
            ->setSource('Source 1')
            ->setData([
                'saludation' => 'Hola Soy Angel',
                'phone' => '123-456-89',
                'email' => 'angel@example.com'
            ])
            ->setAddress([
                'country' => 'Venezuela',
                'city' => 'Rubio',
                'street' => 'La Petrolea',
                'number' => '#00',
                'comments' => 'no comments'
            ])
            ->setRegion('LATAM')
            ->setBrand('Subaru')
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($client2);

        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}