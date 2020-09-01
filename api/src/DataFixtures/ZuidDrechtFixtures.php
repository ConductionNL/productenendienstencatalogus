<?php

namespace App\DataFixtures;

use App\Entity\Catalogue;
use App\Entity\Group;
use App\Entity\Offer;
use App\Entity\Product;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
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
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Catalogi
        $catalogue = new Catalogue();
        $catalogue->setName('Gemeente Zuid Drecht');
        $catalogue->setDescription('De catalogus van de Gemeente zuid Drecht');
        $catalogue->setLogo('https://www.my-organization.com/GemeenteSEDlogo.png');
        $catalogue->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $manager->persist($catalogue);

        $catalogueCheckin = new Catalogue();
        $catalogueCheckin->setName('Checkin Zuid Drecht');
        $catalogueCheckin->setDescription('De catalogus voor de checkin van zuid Drecht');
        $catalogueCheckin->setLogo('https://www.my-organization.com/GemeenteSEDlogo.png');
        $catalogueCheckin->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $manager->persist($catalogueCheckin);

        // Checkin Producten (abbonnementen)
        $id = Uuid::fromString('21c7f76b-066f-4361-a5ee-c8a3bdf8947f');
        $groupCheckin = new Group();
        $groupCheckin->setIcon('My Icon');
        $groupCheckin->setName('Checkin Producten');
        $groupCheckin->setDescription('Een groep voor de producten die beschikbaar zijn bij de checkin van zuid Drecht');
        $groupCheckin->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $groupCheckin->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $groupCheckin->setCatalogue($catalogueCheckin);
        $manager->persist($groupCheckin);
        $groupCheckin->setId($id);
        $manager->persist($groupCheckin);
        $manager->flush();
        $groupCheckin = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        $product = new Product();
        $product->setName('Abbonnement');
        $product->setDescription('Kiezen van een abbonnement');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $product->setType('subscription');
        $product->setRequiresAppointment('false');
        $product->setCatalogue($catalogueCheckin);
        $product->createOffer('35.00', 'EUR', 'Normaal abbonnement');
        $product->createOffer('30.00', 'EUR', 'KHN lid abbonnement');
        $product->addGroup($groupCheckin);
        $manager->persist($product);

        $id = Uuid::fromString('eb491ee9-ad8c-456d-92b2-c297a6a2b3e5');
        $offer = new Offer();
        $offer->setName('Normaal abbonnement');
        $offer->setDescription('Een normaal abbonnement');
        $offer->setPrice('35.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $id = Uuid::fromString('2a3cc560-f36d-4cbd-937f-8504d0e5b486');
        $offer = new Offer();
        $offer->setName('KHN lid abbonnement');
        $offer->setDescription('Een abbonnement voor KHN leden');
        $offer->setPrice('30.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Ballie Producten
        $id = Uuid::fromString('1baea858-1512-454b-ad58-0d30ac5ef10e');
        $groupBallie = new Group();
        $groupBallie->setIcon('My Icon');
        $groupBallie->setName('Ballie producten');
        $groupBallie->setDescription('Een groep voor de grafsoorten van de begraafplaats Zuiderveld in gemeente Hoorn');
        $groupBallie->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $groupBallie->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
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
        $groupId->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
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
        $groupDiensten->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $groupDiensten->setCatalogue($catalogue);
        $manager->persist($groupDiensten);
        $groupDiensten->setId($id);
        $manager->persist($groupDiensten);
        $manager->flush();
        $groupDiensten = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        $product = new Product();
        $product->setName('Paspoort');
        $product->setDescription('Verniewen of aanvragen van een paspoort');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->createOffer('99.99', 'EUR', 'Paspoort aanvragen of verlenengen');
        $product->createOffer('150.0', 'EUR', 'Paspoort gestolen of verloren');
        $product->addGroup($groupBallie);
        $product->addGroup($groupId);
        $product->addGroup($groupDiensten);
        $manager->persist($product);

        $id = Uuid::fromString('840df85b-638d-4e97-928f-30d0aa010982');
        $offer = new Offer();
        $offer->setName('Paspoort aanvragen/vernieuwen');
        $offer->setDescription('Verniewen of aanvragen van een paspoort');
        $offer->setPrice('99.99');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $id = Uuid::fromString('1b899d19-9e66-4b31-ad12-bf581d50ca6f');
        $offer = new Offer();
        $offer->setName('Paspoort gestolen/veloren');
        $offer->setDescription('Verniewen of aanvragen van een paspoort');
        $offer->setPrice('150.0');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $product = new Product();
        $product->setName('Rijbewijs');
        $product->setDescription('Verniewen of aanvragen van een rijbewijs');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->createOffer('99.99', 'EUR', 'Rijbewijs aanvragen of verlengen');
        $product->createOffer('150.0', 'EUR', 'Rijbewijs gestolen of verloren');
        $product->addGroup($groupBallie);
        $product->addGroup($groupId);
        $product->addGroup($groupDiensten);
        $manager->persist($product);

        $id = Uuid::fromString('b409aba2-1cf4-48a3-a934-e168e26e5f09');
        $offer = new Offer();
        $offer->setName('Rijbewijs aanvragen/verlengen');
        $offer->setDescription('Verniewen of aanvragen van een rijbewijs');
        $offer->setPrice('99.99');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $id = Uuid::fromString('7607b93d-c743-46ab-9314-e38dafa577c1');
        $offer = new Offer();
        $offer->setName('Rijbewijs gestolen/veloren');
        $offer->setDescription('Verniewen of aanvragen van een rijbewijs');
        $offer->setPrice('150.0');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $product = new Product();
        $product->setName('Identiteitskaart');
        $product->setDescription('Verniewen of aanvragen van een Identiteitskaart');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->createOffer('99.99', 'EUR', 'identiteitskaart aanvragen of verlengen');
        $product->createOffer('150.0', 'EUR', 'identiteitskaart gestolen of verloren');
        $product->addGroup($groupBallie);
        $product->addGroup($groupId);
        $product->addGroup($groupDiensten);
        $manager->persist($product);

        $id = Uuid::fromString('4c264c6d-1048-41e8-8cd8-b9eb1e65973a');
        $offer = new Offer();
        $offer->setName('Identiteitskaart aanvragen/verlengen');
        $offer->setDescription('Verniewen of aanvragen van een Identiteitskaart');
        $offer->setPrice('99.99');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $id = Uuid::fromString('d6bb4e1f-dbfb-4199-a398-2c754d051416');
        $offer = new Offer();
        $offer->setName('Identiteitskaart gestolen/veloren');
        $offer->setDescription('Verniewen of aanvragen van een Identiteitskaart');
        $offer->setPrice('150.0');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $product = new Product();
        $product->setName('Geboorte Aangifte');
        $product->setDescription('Verniewen of aanvragen van een geboorte aangifte');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->createOffer();
        $product->addGroup($groupDiensten);
        $manager->persist($product);

        $id = Uuid::fromString('ff0d3a09-5d50-4133-b0b1-c434900a83e2');
        $offer = new Offer();
        $offer->setName('Geboorte Aangifte');
        $offer->setDescription('Verniewen of aanvragen van een geboorte aangifte');
        $offer->setPrice('99.99');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // trouwen / plechtigheden
        $id = Uuid::fromString('ea494037-773c-4a32-a363-76857e5f0c46');
        $groupPlechtigheden = new Group();
        $groupPlechtigheden->setIcon('My Icon');
        $groupPlechtigheden->setName('Plechtigheden');
        $groupPlechtigheden->setDescription('groep voor de beschikbare plechtigheden');
        $groupPlechtigheden->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $groupPlechtigheden->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $groupPlechtigheden->setCatalogue($catalogue);
        $manager->persist($groupPlechtigheden);
        $groupPlechtigheden->setId($id);
        $manager->persist($groupPlechtigheden);
        $manager->flush();
        $groupPlechtigheden = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        $product = new Product();
        $product->setName('Flitshuwelijk');
        $product->setDescription('Flitshuwelijk');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->addGroup($groupPlechtigheden);
        $manager->persist($product);

        $id = Uuid::fromString('5e129ca9-0990-4cb3-840f-09c1a64f87d8');
        $offer = new Offer();
        $offer->setName('Flitshuwelijk');
        $offer->setDescription('Flitshuwelijk');
        $offer->setPrice('163.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $product = new Product();
        $product->setName('Eenvoudig trouwen');
        $product->setDescription('Eenvoudig trouwen');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->addGroup($groupPlechtigheden);
        $manager->persist($product);

        $id = Uuid::fromString('8df73d6b-c048-4017-8acd-725a2d41be38');
        $offer = new Offer();
        $offer->setName('Eenvoudig trouwen');
        $offer->setDescription('Eenvoudig trouwen');
        $offer->setPrice('163.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $product = new Product();
        $product->setName('Gratis trouwen');
        $product->setDescription('Gratis trouwen');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->addGroup($groupPlechtigheden);
        $manager->persist($product);

        $id = Uuid::fromString('efca77f9-816b-42b2-a9d7-122d3719bb18');
        $offer = new Offer();
        $offer->setName('Gratis trouwen');
        $offer->setDescription('Gratis trouwen');
        $offer->setPrice('0.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $product = new Product();
        $product->setName('Uitgebreid trouwen');
        $product->setDescription('Uitgebreid trouwen');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid Drecht
        $product->setType('simple');
        $product->setRequiresAppointment('true');
        $product->setCatalogue($catalogue);
        $product->addGroup($groupPlechtigheden);
        $manager->persist($product);

        $id = Uuid::fromString('afacea10-40b1-47d5-bf64-c544afa1dfa0');
        $offer = new Offer();
        $offer->setName('Uitgebreid trouwen');
        $offer->setDescription('Uitgebreid trouwen');
        $offer->setPrice('627.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); //Zuid drecht
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        $manager->flush();
    }
}
