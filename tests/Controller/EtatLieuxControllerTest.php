<?php

namespace App\Test\Controller;

use App\Entity\EtatLieux;
use App\Repository\EtatLieuxRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EtatLieuxControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EtatLieuxRepository $repository;
    private string $path = '/etat/lieux/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(EtatLieux::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EtatLieux index');

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
            'etat_lieux[date_etat_lieux]' => 'Testing',
            'etat_lieux[remarque]' => 'Testing',
        ]);

        self::assertResponseRedirects('/etat/lieux/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new EtatLieux();
        $fixture->setDate_etat_lieux('My Title');
        $fixture->setRemarque('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EtatLieux');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new EtatLieux();
        $fixture->setDate_etat_lieux('My Title');
        $fixture->setRemarque('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'etat_lieux[date_etat_lieux]' => 'Something New',
            'etat_lieux[remarque]' => 'Something New',
        ]);

        self::assertResponseRedirects('/etat/lieux/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate_etat_lieux());
        self::assertSame('Something New', $fixture[0]->getRemarque());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new EtatLieux();
        $fixture->setDate_etat_lieux('My Title');
        $fixture->setRemarque('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/etat/lieux/');
    }
}
