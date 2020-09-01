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
        $groupBallie->setDescription('Een groep voor de grafsoorten van de begraafplaats Zuiderveld in gemeente Zuid-Drecht');
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
        $groupId->setDescription('Een groep voor de grafsoorten van de begraafplaats Zuiderveld in gemeente Zuid-Drecht');
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
        $groupDiensten->setDescription('Een groep voor de grafsoorten van de begraafplaats Zuiderveld in gemeente Zuid-Drecht');
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

        // Grafsoort product Strooiveld
        $id = Uuid::fromString('0982ee23-8a3b-4163-9888-b2d0bfbd1b0d');
        $strooiveldProduct = new Product();
        $strooiveldProduct->setName('Strooiveld');
        $strooiveldProduct->setDescription('Een Product voor grafsoort strooiveld');
        $strooiveldProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $strooiveldProduct->setType('simple');
        $strooiveldProduct->setRequiresAppointment('false');
        $strooiveldProduct->setCatalogue($catalogue);
        $strooiveldProduct->setAudience('public');
        $manager->persist($strooiveldProduct);
        $strooiveldProduct->setId($id);
        $manager->persist($strooiveldProduct);
        $manager->flush();
        $strooiveldProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Strooiveld
        $id = Uuid::fromString('957a1486-db9a-4658-9d30-8695d4000654');
        $strooiveldOffer = new Offer();
        $strooiveldOffer->setName('Strooiveld');
        $strooiveldOffer->setDescription('Een Offer voor grafsoort strooiveld');
        $strooiveldOffer->setPrice('99.99');
        $strooiveldOffer->setPriceCurrency('EUR');
        $strooiveldOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $strooiveldOffer->setAudience('public');
        $manager->persist($strooiveldOffer);
        $strooiveldOffer->setId($id);
        $manager->persist($strooiveldOffer);
        $manager->flush();
        $strooiveldOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $strooiveldOffer->addProduct($strooiveldProduct);
        $manager->persist($strooiveldOffer);

        // Grafsoort product Babygraf
        $id = Uuid::fromString('48a49e07-25bd-4c5e-94cb-adda07e3a3a8');
        $babygrafProduct = new Product();
        $babygrafProduct->setName('Babygraf');
        $babygrafProduct->setDescription('Een Product voor grafsoort babygraf');
        $babygrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $babygrafProduct->setType('simple');
        $babygrafProduct->setRequiresAppointment('false');
        $babygrafProduct->setCatalogue($catalogue);
        $babygrafProduct->setAudience('public');
        $manager->persist($babygrafProduct);
        $babygrafProduct->setId($id);
        $manager->persist($babygrafProduct);
        $manager->flush();
        $babygrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Babygraf
        $id = Uuid::fromString('093b3bfc-544e-45f9-8e42-adc072d2c901');
        $babygrafOffer = new Offer();
        $babygrafOffer->setName('Babygraf');
        $babygrafOffer->setDescription('Een Offer voor grafsoort babygraf');
        $babygrafOffer->setPrice('99.99');
        $babygrafOffer->setPriceCurrency('EUR');
        $babygrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $babygrafOffer->setAudience('public');
        $manager->persist($babygrafOffer);
        $babygrafOffer->setId($id);
        $manager->persist($babygrafOffer);
        $manager->flush();
        $babygrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $babygrafOffer->addProduct($babygrafProduct);
        $manager->persist($babygrafOffer);

        // Grafsoort product Oorlogsgraf
        $id = Uuid::fromString('8f2d1432-34c1-448d-872c-07218cf65095');
        $oorlogsgrafProduct = new Product();
        $oorlogsgrafProduct->setName('Oorlogsgraf');
        $oorlogsgrafProduct->setDescription('Een Product voor grafsoort oorlogsgraf');
        $oorlogsgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $oorlogsgrafProduct->setType('simple');
        $oorlogsgrafProduct->setRequiresAppointment('false');
        $oorlogsgrafProduct->setCatalogue($catalogue);
        $oorlogsgrafProduct->setAudience('public');
        $manager->persist($oorlogsgrafProduct);
        $oorlogsgrafProduct->setId($id);
        $manager->persist($oorlogsgrafProduct);
        $manager->flush();
        $oorlogsgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Oorlogsgraf
        $id = Uuid::fromString('71b132e2-31c4-4f41-8718-7233e8d5e967');
        $oorlogsgrafOffer = new Offer();
        $oorlogsgrafOffer->setName('Oorlogsgraf');
        $oorlogsgrafOffer->setDescription('Een Offer voor grafsoort oorlogsgraf');
        $oorlogsgrafOffer->setPrice('99.99');
        $oorlogsgrafOffer->setPriceCurrency('EUR');
        $oorlogsgrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $oorlogsgrafOffer->setAudience('public');
        $manager->persist($oorlogsgrafOffer);
        $oorlogsgrafOffer->setId($id);
        $manager->persist($oorlogsgrafOffer);
        $manager->flush();
        $oorlogsgrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $oorlogsgrafOffer->addProduct($oorlogsgrafProduct);
        $manager->persist($oorlogsgrafOffer);

        // Grafsoort product Cultuur historisch graf
        $id = Uuid::fromString('20ddd583-20a3-42a1-ac28-88eae306735c');
        $cultuurHistorischGrafProduct = new Product();
        $cultuurHistorischGrafProduct->setName('Cultuur historisch graf');
        $cultuurHistorischGrafProduct->setDescription('Een Product voor grafsoort cultuur historisch graf');
        $cultuurHistorischGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $cultuurHistorischGrafProduct->setType('simple');
        $cultuurHistorischGrafProduct->setRequiresAppointment('false');
        $cultuurHistorischGrafProduct->setCatalogue($catalogue);
        $cultuurHistorischGrafProduct->setAudience('public');
        $manager->persist($cultuurHistorischGrafProduct);
        $cultuurHistorischGrafProduct->setId($id);
        $manager->persist($cultuurHistorischGrafProduct);
        $manager->flush();
        $cultuurHistorischGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Cultuur historisch graf
        $id = Uuid::fromString('0963c2c2-3877-40c7-a330-83c54ee06026');
        $cultuurHistorischGrafOffer = new Offer();
        $cultuurHistorischGrafOffer->setName('Cultuur historisch graf');
        $cultuurHistorischGrafOffer->setDescription('Een Offer voor grafsoort cultuur historisch graf');
        $cultuurHistorischGrafOffer->setPrice('99.99');
        $cultuurHistorischGrafOffer->setPriceCurrency('EUR');
        $cultuurHistorischGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $cultuurHistorischGrafOffer->setAudience('public');
        $manager->persist($cultuurHistorischGrafOffer);
        $cultuurHistorischGrafOffer->setId($id);
        $manager->persist($cultuurHistorischGrafOffer);
        $manager->flush();
        $cultuurHistorischGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $cultuurHistorischGrafOffer->addProduct($cultuurHistorischGrafProduct);
        $manager->persist($cultuurHistorischGrafOffer);

        // Grafsoort product Monument
        $id = Uuid::fromString('7e6ef9bd-ea6d-4cd9-9f16-8344ca939581');
        $monumentProduct = new Product();
        $monumentProduct->setName('Monument');
        $monumentProduct->setDescription('Een Product voor grafsoort monument');
        $monumentProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $monumentProduct->setType('simple');
        $monumentProduct->setRequiresAppointment('false');
        $monumentProduct->setCatalogue($catalogue);
        $monumentProduct->setAudience('public');
        $manager->persist($monumentProduct);
        $monumentProduct->setId($id);
        $manager->persist($monumentProduct);
        $manager->flush();
        $monumentProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Monument
        $id = Uuid::fromString('44e723a9-2f22-4f19-9ea2-5c6af1cd6515');
        $monumentOffer = new Offer();
        $monumentOffer->setName('Monument');
        $monumentOffer->setDescription('Een Offer voor grafsoort monument');
        $monumentOffer->setPrice('99.99');
        $monumentOffer->setPriceCurrency('EUR');
        $monumentOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $monumentOffer->setAudience('public');
        $manager->persist($monumentOffer);
        $monumentOffer->setId($id);
        $manager->persist($monumentOffer);
        $manager->flush();
        $monumentOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $monumentOffer->addProduct($monumentProduct);
        $manager->persist($monumentOffer);

        // Grafsoort product Familiegraf
        $id = Uuid::fromString('fe9da0ec-a6f6-42f1-b316-e51181583020');
        $familieGrafProduct = new Product();
        $familieGrafProduct->setName('Familiegraf');
        $familieGrafProduct->setDescription('Een Product voor grafsoort familiegraf');
        $familieGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $familieGrafProduct->setType('simple');
        $familieGrafProduct->setRequiresAppointment('false');
        $familieGrafProduct->setCatalogue($catalogue);
        $familieGrafProduct->setAudience('public');
        $manager->persist($familieGrafProduct);
        $familieGrafProduct->setId($id);
        $manager->persist($familieGrafProduct);
        $manager->flush();
        $familieGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Familiegraf
        $id = Uuid::fromString('09d90a5e-6e12-4dac-a904-72a19f824dcb');
        $familieGrafOffer = new Offer();
        $familieGrafOffer->setName('Familiegraf');
        $familieGrafOffer->setDescription('Een Offer voor grafsoort familiegraf');
        $familieGrafOffer->setPrice('99.99');
        $familieGrafOffer->setPriceCurrency('EUR');
        $familieGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $familieGrafOffer->setAudience('public');
        $manager->persist($familieGrafOffer);
        $familieGrafOffer->setId($id);
        $manager->persist($familieGrafOffer);
        $manager->flush();
        $familieGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $familieGrafOffer->addProduct($familieGrafProduct);
        $manager->persist($familieGrafOffer);

        // Grafsoort product Oorlogsgraf
        $id = Uuid::fromString('4a2c8ab1-9d08-4581-a6e4-da569c675093');
        $oorlogsGrafProduct = new Product();
        $oorlogsGrafProduct->setName('Oorlogsgraf');
        $oorlogsGrafProduct->setDescription('Een Product voor grafsoort oorlogsgraf');
        $oorlogsGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $oorlogsGrafProduct->setType('simple');
        $oorlogsGrafProduct->setRequiresAppointment('false');
        $oorlogsGrafProduct->setCatalogue($catalogue);
        $oorlogsGrafProduct->setAudience('public');
        $manager->persist($oorlogsGrafProduct);
        $oorlogsGrafProduct->setId($id);
        $manager->persist($oorlogsGrafProduct);
        $manager->flush();
        $oorlogsGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Oorlogsgraf
        $id = Uuid::fromString('fc0f7701-b4f7-46c7-b604-ce285eba059f');
        $oorlogsGrafOffer = new Offer();
        $oorlogsGrafOffer->setName('Oorlogsgraf');
        $oorlogsGrafOffer->setDescription('Een Offer voor grafsoort oorlogsgraf');
        $oorlogsGrafOffer->setPrice('99.99');
        $oorlogsGrafOffer->setPriceCurrency('EUR');
        $oorlogsGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $oorlogsGrafOffer->setAudience('public');
        $manager->persist($oorlogsGrafOffer);
        $oorlogsGrafOffer->setId($id);
        $manager->persist($oorlogsGrafOffer);
        $manager->flush();
        $oorlogsGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $oorlogsGrafOffer->addProduct($oorlogsGrafProduct);
        $manager->persist($oorlogsGrafOffer);

        // Grafsoort product Gedenkteken
        $id = Uuid::fromString('28488fdf-a9ca-418d-b3e6-913a3f921cd2');
        $gedenktekenProduct = new Product();
        $gedenktekenProduct->setName('Gedenkteken');
        $gedenktekenProduct->setDescription('Een Product voor grafsoort gedenkteken');
        $gedenktekenProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $gedenktekenProduct->setType('simple');
        $gedenktekenProduct->setRequiresAppointment('false');
        $gedenktekenProduct->setCatalogue($catalogue);
        $gedenktekenProduct->setAudience('public');
        $manager->persist($gedenktekenProduct);
        $gedenktekenProduct->setId($id);
        $manager->persist($gedenktekenProduct);
        $manager->flush();
        $gedenktekenProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Gedenkteken
        $id = Uuid::fromString('bb420d67-38e7-429c-9897-e328e9b3fbcf');
        $gedenktekenOffer = new Offer();
        $gedenktekenOffer->setName('Gedenkteken');
        $gedenktekenOffer->setDescription('Een Offer voor grafsoort gedenkteken');
        $gedenktekenOffer->setPrice('99.99');
        $gedenktekenOffer->setPriceCurrency('EUR');
        $gedenktekenOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // West Friesland
        $gedenktekenOffer->setAudience('public');
        $manager->persist($gedenktekenOffer);
        $gedenktekenOffer->setId($id);
        $manager->persist($gedenktekenOffer);
        $manager->flush();
        $gedenktekenOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $gedenktekenOffer->addProduct($gedenktekenProduct);
        $manager->persist($gedenktekenOffer);

        // Grafsoorten group gemeente Zuid-Drecht
        $id = Uuid::fromString('995f0088-ebab-4540-9aea-b2e954fea8b2');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Zuid-Drecht');
        $group->setDescription('Een groep voor de grafsoorten van de gemeente Zuid-Drecht');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591'])); // Zuid-Drecht
        $group->setCatalogue($catalogue);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($familieGrafProduct);
        $group->addProduct($oorlogsGrafProduct);
        $group->addProduct($gedenktekenProduct);
        $manager->persist($group);

        $manager->flush();
    }
}
