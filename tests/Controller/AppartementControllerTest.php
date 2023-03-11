<?php

namespace App\Test\Controller;

use App\Entity\Appartement;
use App\Repository\AppartementRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppartementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AppartementRepository $repository;
    private string $path = '/appartement/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Appartement::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Appartement index');

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
            'appartement[adresse]' => 'Testing',
            'appartement[complement]' => 'Testing',
            'appartement[ville]' => 'Testing',
            'appartement[code_postal]' => 'Testing',
            'appartement[prix_charges]' => 'Testing',
            'appartement[prix_loyer]' => 'Testing',
            'appartement[superficie]' => 'Testing',
            'appartement[prix_depot_garantie]' => 'Testing',
        ]);

        self::assertResponseRedirects('/appartement/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Appartement();
        $fixture->setAdresse('My Title');
        $fixture->setComplement('My Title');
        $fixture->setVille('My Title');
        $fixture->setCode_postal('My Title');
        $fixture->setPrix_charges('My Title');
        $fixture->setPrix_loyer('My Title');
        $fixture->setSuperficie('My Title');
        $fixture->setPrix_depot_garantie('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Appartement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Appartement();
        $fixture->setAdresse('My Title');
        $fixture->setComplement('My Title');
        $fixture->setVille('My Title');
        $fixture->setCode_postal('My Title');
        $fixture->setPrix_charges('My Title');
        $fixture->setPrix_loyer('My Title');
        $fixture->setSuperficie('My Title');
        $fixture->setPrix_depot_garantie('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'appartement[adresse]' => 'Something New',
            'appartement[complement]' => 'Something New',
            'appartement[ville]' => 'Something New',
            'appartement[code_postal]' => 'Something New',
            'appartement[prix_charges]' => 'Something New',
            'appartement[prix_loyer]' => 'Something New',
            'appartement[superficie]' => 'Something New',
            'appartement[prix_depot_garantie]' => 'Something New',
        ]);

        self::assertResponseRedirects('/appartement/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getComplement());
        self::assertSame('Something New', $fixture[0]->getVille());
        self::assertSame('Something New', $fixture[0]->getCode_postal());
        self::assertSame('Something New', $fixture[0]->getPrix_charges());
        self::assertSame('Something New', $fixture[0]->getPrix_loyer());
        self::assertSame('Something New', $fixture[0]->getSuperficie());
        self::assertSame('Something New', $fixture[0]->getPrix_depot_garantie());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Appartement();
        $fixture->setAdresse('My Title');
        $fixture->setComplement('My Title');
        $fixture->setVille('My Title');
        $fixture->setCode_postal('My Title');
        $fixture->setPrix_charges('My Title');
        $fixture->setPrix_loyer('My Title');
        $fixture->setSuperficie('My Title');
        $fixture->setPrix_depot_garantie('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/appartement/');
    }
}
