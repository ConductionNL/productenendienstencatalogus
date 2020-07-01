<?php

namespace App\DataFixtures;

use App\Entity\Catalogue;
use App\Entity\Group;
use App\Entity\Product;
use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ZuidDrechtFixtures extends Fixture
{
    private $params;
    private $commonGroundService;

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        if (
            // If build all fixtures is true we build all the fixtures
            !$this->params->get('app_build_all_fixtures') &&
            // Specific domain names
            $this->params->get('app_domain') != "zuid-drecht.nl" && strpos($this->params->get('app_domain'), "zuid-drecht.nl") == false
        ) {
            return false;
        }

        // Catalogi
        $catalogue = new Catalogue();
        $catalogue->setName('Gemeente Zuid Drecht');
        $catalogue->setDescription('De catalogus van de Gemeente zuid Drecht');
        $catalogue->setLogo('https://www.my-organization.com/GemeenteSEDlogo.png');
        $catalogue->setSourceOrganization($this->commonGroundService->cleanUrl(["component"=>"wrc","type"=>"organizations","id"=>"4d1eded3-fbdf-438f-9536-8747dd8ab591"])); // Zuid Drecht
        $manager->persist($catalogue);

        // Ballie Producten
        $id = Uuid::fromString('1baea858-1512-454b-ad58-0d30ac5ef10e');
        $groupBallie = new Group();
        $groupBallie->setIcon('My Icon');
        $groupBallie->setName('Ballie producten');
        $groupBallie->setDescription('Een groep voor de grafsoorten van de begraafplaats Zuiderveld in gemeente Hoorn');
        $groupBallie->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $groupBallie->setSourceOrganization($this->commonGroundService->cleanUrl(["component"=>"wrc","type"=>"organizations","id"=>"4d1eded3-fbdf-438f-9536-8747dd8ab591"])); // Zuid Drecht
        $groupBallie->setCatalogue($catalogue);
        $manager->persist($groupBallie);
        $groupBallie->setId($id);
        $manager->persist($groupBallie);
        $manager->flush();
        $groupBallie = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        $groupId = new Group();
        $id = Uuid::fromString('b2e220b6-9f5c-45b4-84ec-8727123df185');
        $groupId->setIcon('My Icon');
        $groupId->setName('Identietis Bewijzen');
        $groupId->setDescription('Een groep voor de grafsoorten van de begraafplaats Zuiderveld in gemeente Hoorn');
        $groupId->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $groupId->setSourceOrganization($this->commonGroundService->cleanUrl(["component"=>"wrc","type"=>"organizations","id"=>"4d1eded3-fbdf-438f-9536-8747dd8ab591"])); // Zuid Drecht
        $groupId->setCatalogue($catalogue);
        $manager->persist($groupId);
        $groupId->setId($id);
        $manager->persist($groupId);
        $manager->flush();
        $groupId = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        $groupDiensten = new Group();
        $id = Uuid::fromString('bbc03703-27b5-442a-9b20-57dfff95be9b');
        $groupDiensten->setIcon('My Icon');
        $groupDiensten->setName('Diensten');
        $groupDiensten->setDescription('Een groep voor de grafsoorten van de begraafplaats Zuiderveld in gemeente Hoorn');
        $groupDiensten->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $groupDiensten->setSourceOrganization($this->commonGroundService->cleanUrl(["component"=>"wrc","type"=>"organizations","id"=>"4d1eded3-fbdf-438f-9536-8747dd8ab591"])); // Zuid Drecht
        $groupDiensten->setCatalogue($catalogue);
        $manager->persist($groupDiensten);
        $groupDiensten->setId($id);
        $manager->persist($groupDiensten);
        $manager->flush();
        $groupDiensten = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        $product = new Product();
        $product->setName('Paspoort');
        $product->setDescription('Verniewen of aanvragen van een paspoort');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(["component"=>"wrc","type"=>"organizations","id"=>"4d1eded3-fbdf-438f-9536-8747dd8ab591"])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->createOffer('99.99','EUR','Paspoort aanvragen of verlenengen');
        $product->createOffer('150.0','EUR','Paspoort gestolen of verloren');
        $product->addGroup($groupBallie);
        $product->addGroup($groupId);
        $product->addGroup($groupDiensten);
        $manager->persist($product);

        $product = new Product();
        $product->setName('Rijbewijs');
        $product->setDescription('Verniewen of aanvragen van een rijbewijs');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(["component"=>"wrc","type"=>"organizations","id"=>"4d1eded3-fbdf-438f-9536-8747dd8ab591"])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->createOffer('99.99','EUR','Rijbewijs aanvragen of verlenengen');
        $product->createOffer('150.0','EUR','Rijbewijs gestolen of verloren');
        $product->addGroup($groupBallie);
        $product->addGroup($groupId);
        $product->addGroup($groupDiensten);
        $manager->persist($product);

        $product = new Product();
        $product->setName('Identiets Kaart');
        $product->setDescription('Verniewen of aanvragen van een rijbewijs');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(["component"=>"wrc","type"=>"organizations","id"=>"4d1eded3-fbdf-438f-9536-8747dd8ab591"])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->createOffer('99.99','EUR','Identiets Kaart aanvragen of verlenengen');
        $product->createOffer('150.0','EUR','Identiets Kaart gestolen of verloren');
        $product->addGroup($groupBallie);
        $product->addGroup($groupId);
        $product->addGroup($groupDiensten);
        $manager->persist($product);

        $product = new Product();
        $product->setName('Geboorte Aangifte');
        $product->setDescription('Verniewen of aanvragen van een rijbewijs');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(["component"=>"wrc","type"=>"organizations","id"=>"4d1eded3-fbdf-438f-9536-8747dd8ab591"])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->createOffer();
        $product->addGroup($groupDiensten);
        $manager->persist($product);


        $manager->flush();
    }
}
