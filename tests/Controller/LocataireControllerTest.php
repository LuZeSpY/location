<?php

namespace App\Test\Controller;

use App\Entity\Locataire;
use App\Repository\LocataireRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LocataireControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private LocataireRepository $repository;
    private string $path = '/locataire/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Locataire::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Locataire index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'locataire[nom]' => 'Testing',
            'locataire[prenom]' => 'Testing',
            'locataire[email]' => 'Testing',
            'locataire[telephone]' => 'Testing',
            'locataire[adresse]' => 'Testing',
            'locataire[complement]' => 'Testing',
            'locataire[ville]' => 'Testing',
            'locataire[code_postal]' => 'Testing',
        ]);

        self::assertResponseRedirects('/locataire/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Locataire();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEmail('My Title');
        $fixture->setTelephone('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setComplement('My Title');
        $fixture->setVille('My Title');
        $fixture->setCode_postal('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Locataire');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Locataire();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEmail('My Title');
        $fixture->setTelephone('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setComplement('My Title');
        $fixture->setVille('My Title');
        $fixture->setCode_postal('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'locataire[nom]' => 'Something New',
            'locataire[prenom]' => 'Something New',
            'locataire[email]' => 'Something New',
            'locataire[telephone]' => 'Something New',
            'locataire[adresse]' => 'Something New',
            'locataire[complement]' => 'Something New',
            'locataire[ville]' => 'Something New',
            'locataire[code_postal]' => 'Something New',
        ]);

        self::assertResponseRedirects('/locataire/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getTelephone());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getComplement());
        self::assertSame('Something New', $fixture[0]->getVille());
        self::assertSame('Something New', $fixture[0]->getCode_postal());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Locataire();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEmail('My Title');
        $fixture->setTelephone('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setComplement('My Title');
        $fixture->setVille('My Title');
        $fixture->setCode_postal('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/locataire/');
    }
}
