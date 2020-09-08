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

class WestFrieslandFixtures extends Fixture
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
            $this->params->get('app_domain') != 'begraven.zaakonline.nl' && strpos($this->params->get('app_domain'), 'begraven.zaakonline.nl') == false &&
            $this->params->get('app_domain') != 'westfriesland.commonground.nu' && strpos($this->params->get('app_domain'), 'westfriesland.commonground.nu') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Catalogi
        // Gemeente SED
        $sed = new Catalogue();
        $sed->setName('Gemeente SED');
        $sed->setDescription('De catalogus van de Gemeente Stede Broec, Enkhuizen en Drechterland');
        $sed->setLogo('https://www.my-organization.com/GemeenteSEDlogo.png');
        $sed->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f'])); // SED
        $manager->persist($sed);

        // Gemeente Hoorn
        $hoorn = new Catalogue();
        $hoorn->setName('Gemeente Hoorn');
        $hoorn->setDescription('De catalogus van de Gemeente Hoorn');
        $hoorn->setLogo('https://www.my-organization.com/GemeenteHoornlogo.png');
        $hoorn->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384'])); // Hoorn
        $manager->persist($hoorn);

        // Gemeente Medemblik
        $medemblik = new Catalogue();
        $medemblik->setName('Gemeente Medemblik');
        $medemblik->setDescription('De catalogus van de Gemeente Medemblik');
        $medemblik->setLogo('https://www.my-organization.com/GemeenteMedembliklogo.png');
        $medemblik->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $manager->persist($medemblik);

        // Gemeente Koggenland
        $koggenland = new Catalogue();
        $koggenland->setName('Gemeente Koggenland');
        $koggenland->setDescription('De catalogus van de Gemeente Koggenland');
        $koggenland->setLogo('https://www.my-organization.com/GemeenteKoggenlandlogo.png');
        $koggenland->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'f050292c-973d-46ab-97ae-9d8830a59d15'])); // Koggenland
        $manager->persist($koggenland);

        // Gemeente Opmeer
        $opmeer = new Catalogue();
        $opmeer->setName('Gemeente Opmeer');
        $opmeer->setDescription('De catalogus van de Gemeente Opmeer');
        $opmeer->setLogo('https://www.my-organization.com/GemeenteOpmeerlogo.png');
        $opmeer->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'16fd1092-c4d3-4011-8998-0e15e13239cf'])); // Opmeer
        $manager->persist($opmeer);

        // Gemeente Hogeland
        $hogeland = new Catalogue();
        $hogeland->setName('Gemeente Hogeland');
        $hogeland->setDescription('De catalogus van de Gemeente Hogeland');
        $hogeland->setLogo('https://www.my-organization.com/GemeenteHogelandlogo.png');
        $hogeland->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233'])); // Hogeland
        $manager->persist($hogeland);

        // Gemeente Westfriesland
        $westfriesland = new Catalogue();
        $westfriesland->setName('Gemeente Westfriesland');
        $westfriesland->setDescription('De catalogus van de Gemeente Westfriesland');
        $westfriesland->setLogo('https://www.my-organization.com/GemeenteWestfrieslandlogo.png');
        $westfriesland->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $manager->persist($westfriesland);

        $manager->flush();

        /*
        // Grafsoorten
        // Grafsoort product Koopgraf
        $id = Uuid::fromString('e8cd45f7-350e-408d-8266-153e9395a755');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Koopgraf');
        $koopgrafProduct->setDescription('Een Product voor grafsoort Koopgraf');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($westfriesland);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Koopgraf
        $id = Uuid::fromString('8e182a66-7037-41f3-8f91-25d263fe239b');
        $koopgrafOffer = new Offer();
        $koopgrafOffer->setName('Koopgraf');
        $koopgrafOffer->setDescription('Een Offer voor grafsoort Koopgraf');
        $koopgrafOffer->setPrice('99.99');
        $koopgrafOffer->setPriceCurrency('EUR');
        $koopgrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $koopgrafOffer->setAudience('public');
        $manager->persist($koopgrafOffer);
        $koopgrafOffer->setId($id);
        $manager->persist($koopgrafOffer);
        $manager->flush();
        $koopgrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $koopgrafOffer->addProduct($koopgrafProduct);
        $manager->persist($koopgrafOffer);

        // Grafsoort product Urngraf
        $id = Uuid::fromString('44c6edea-ee80-4c86-8be4-3576b0bd1b56');
        $urngrafProduct = new Product();
        $urngrafProduct->setName('Urngraf');
        $urngrafProduct->setDescription('Een Product voor grafsoort Urngraf');
        $urngrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $urngrafProduct->setType('simple');
        $urngrafProduct->setRequiresAppointment('false');
        $urngrafProduct->setCatalogue($westfriesland);
        $urngrafProduct->setAudience('public');
        $manager->persist($urngrafProduct);
        $urngrafProduct->setId($id);
        $manager->persist($urngrafProduct);
        $manager->flush();
        $urngrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Urngraf
        $id = Uuid::fromString('2244fc2e-103e-4a23-90d9-01d747a3720d');
        $urngrafOffer = new Offer();
        $urngrafOffer->setName('Urngraf');
        $urngrafOffer->setDescription('Een Offer voor grafsoort Urngraf');
        $urngrafOffer->setPrice('99.99');
        $urngrafOffer->setPriceCurrency('EUR');
        $urngrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $urngrafOffer->setAudience('public');
        $manager->persist($urngrafOffer);
        $urngrafOffer->setId($id);
        $manager->persist($urngrafOffer);
        $manager->flush();
        $urngrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $urngrafOffer->addProduct($urngrafProduct);
        $manager->persist($urngrafOffer);

        // Grafsoort product Urnennis
        $id = Uuid::fromString('4a387d78-b530-4d8f-a3f2-724762acf7a6');
        $urnennisProduct = new Product();
        $urnennisProduct->setName('Urnennis');
        $urnennisProduct->setDescription('Een Product voor grafsoort Urnennis');
        $urnennisProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $urnennisProduct->setType('simple');
        $urnennisProduct->setRequiresAppointment('false');
        $urnennisProduct->setCatalogue($westfriesland);
        $urnennisProduct->setAudience('public');
        $manager->persist($urnennisProduct);
        $urnennisProduct->setId($id);
        $manager->persist($urnennisProduct);
        $manager->flush();
        $urnennisProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Urnennis
        $id = Uuid::fromString('cd534c1a-79b9-435b-922f-c16804a352b0');
        $urnennisOffer = new Offer();
        $urnennisOffer->setName('Urnennis');
        $urnennisOffer->setDescription('Een Offer voor grafsoort Urnennis');
        $urnennisOffer->setPrice('99.99');
        $urnennisOffer->setPriceCurrency('EUR');
        $urnennisOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $urnennisOffer->setAudience('public');
        $manager->persist($urnennisOffer);
        $urnennisOffer->setId($id);
        $manager->persist($urnennisOffer);
        $manager->flush();
        $urnennisOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $urnennisOffer->addProduct($urnennisProduct);
        $manager->persist($urnennisOffer);

        // Grafsoort product Huurgraf
        $id = Uuid::fromString('f45e8ee7-82a1-4d75-89b4-ad869d86538f');
        $huurgrafProduct = new Product();
        $huurgrafProduct->setName('Huurgraf');
        $huurgrafProduct->setDescription('Een Product voor grafsoort Huurgraf');
        $huurgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $huurgrafProduct->setType('simple');
        $huurgrafProduct->setRequiresAppointment('false');
        $huurgrafProduct->setCatalogue($westfriesland);
        $huurgrafProduct->setAudience('public');
        $manager->persist($huurgrafProduct);
        $huurgrafProduct->setId($id);
        $manager->persist($huurgrafProduct);
        $manager->flush();
        $huurgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Huurgraf
        $id = Uuid::fromString('42a31408-15a7-4eed-bded-52b5b6eea7fe');
        $huurgrafOffer = new Offer();
        $huurgrafOffer->setName('Huurgraf');
        $huurgrafOffer->setDescription('Een Offer voor grafsoort Huurgraf');
        $huurgrafOffer->setPrice('99.99');
        $huurgrafOffer->setPriceCurrency('EUR');
        $huurgrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $huurgrafOffer->setAudience('public');
        $manager->persist($huurgrafOffer);
        $huurgrafOffer->setId($id);
        $manager->persist($huurgrafOffer);
        $manager->flush();
        $huurgrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $huurgrafOffer->addProduct($huurgrafProduct);
        $manager->persist($huurgrafOffer);

        // Grafsoort product Particulier graf
        $id = Uuid::fromString('e57d0574-8526-4911-b90c-233fb84c96dd');
        $particulierGrafProduct = new Product();
        $particulierGrafProduct->setName('Particulier graf');
        $particulierGrafProduct->setDescription('Een Product voor grafsoort particulier graf');
        $particulierGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $particulierGrafProduct->setType('simple');
        $particulierGrafProduct->setRequiresAppointment('false');
        $particulierGrafProduct->setCatalogue($westfriesland);
        $particulierGrafProduct->setAudience('public');
        $manager->persist($particulierGrafProduct);
        $particulierGrafProduct->setId($id);
        $manager->persist($particulierGrafProduct);
        $manager->flush();
        $particulierGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Particulier Graf
        $id = Uuid::fromString('606ca42a-3fb3-472a-b026-51aca794a588');
        $particulierGrafOffer = new Offer();
        $particulierGrafOffer->setName('Particulier graf');
        $particulierGrafOffer->setDescription('Een Offer voor grafsoort particulier graf');
        $particulierGrafOffer->setPrice('99.99');
        $particulierGrafOffer->setPriceCurrency('EUR');
        $particulierGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $particulierGrafOffer->setAudience('public');
        $manager->persist($particulierGrafOffer);
        $particulierGrafOffer->setId($id);
        $manager->persist($particulierGrafOffer);
        $manager->flush();
        $particulierGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $particulierGrafOffer->addProduct($particulierGrafProduct);
        $manager->persist($particulierGrafOffer);

        // Grafsoort product Algemeen graf
        $id = Uuid::fromString('fcc5289b-c1c9-4760-bb3b-516197ac1d10');
        $algemeenGrafProduct = new Product();
        $algemeenGrafProduct->setName('Algemeen graf');
        $algemeenGrafProduct->setDescription('Een Product voor grafsoort algemeen graf');
        $algemeenGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $algemeenGrafProduct->setType('simple');
        $algemeenGrafProduct->setRequiresAppointment('false');
        $algemeenGrafProduct->setCatalogue($westfriesland);
        $algemeenGrafProduct->setAudience('public');
        $manager->persist($algemeenGrafProduct);
        $algemeenGrafProduct->setId($id);
        $manager->persist($algemeenGrafProduct);
        $manager->flush();
        $algemeenGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Algemeen graf
        $id = Uuid::fromString('f48782e6-3d8d-49ed-a2ea-1b7e3261b559');
        $algemeenGrafOffer = new Offer();
        $algemeenGrafOffer->setName('Algemeen graf');
        $algemeenGrafOffer->setDescription('Een Offer voor grafsoort algemeen graf');
        $algemeenGrafOffer->setPrice('99.99');
        $algemeenGrafOffer->setPriceCurrency('EUR');
        $algemeenGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $algemeenGrafOffer->setAudience('public');
        $manager->persist($algemeenGrafOffer);
        $algemeenGrafOffer->setId($id);
        $manager->persist($algemeenGrafOffer);
        $manager->flush();
        $algemeenGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $algemeenGrafOffer->addProduct($algemeenGrafProduct);
        $manager->persist($algemeenGrafOffer);

        // Grafsoort product Kindergraf
        $id = Uuid::fromString('bca4ec81-7328-4b4f-9114-bbd8f7056724');
        $kinderGrafProduct = new Product();
        $kinderGrafProduct->setName('Kindergraf');
        $kinderGrafProduct->setDescription('Een Product voor grafsoort kindergraf');
        $kinderGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $kinderGrafProduct->setType('simple');
        $kinderGrafProduct->setRequiresAppointment('false');
        $kinderGrafProduct->setCatalogue($westfriesland);
        $kinderGrafProduct->setAudience('public');
        $manager->persist($kinderGrafProduct);
        $kinderGrafProduct->setId($id);
        $manager->persist($kinderGrafProduct);
        $manager->flush();
        $kinderGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Kindergraf
        $id = Uuid::fromString('8255f7c9-9151-4841-9742-12c63ff36e88');
        $kinderGrafOffer = new Offer();
        $kinderGrafOffer->setName('Kindergraf');
        $kinderGrafOffer->setDescription('Een Offer voor grafsoort kindergraf');
        $kinderGrafOffer->setPrice('99.99');
        $kinderGrafOffer->setPriceCurrency('EUR');
        $kinderGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $kinderGrafOffer->setAudience('public');
        $manager->persist($kinderGrafOffer);
        $kinderGrafOffer->setId($id);
        $manager->persist($kinderGrafOffer);
        $manager->flush();
        $kinderGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $kinderGrafOffer->addProduct($kinderGrafProduct);
        $manager->persist($kinderGrafOffer);

        // Grafsoort product Grafkelder
        $id = Uuid::fromString('52b9cd8d-7891-4002-a0c7-119f5d5f9274');
        $grafKelderProduct = new Product();
        $grafKelderProduct->setName('Grafkelder');
        $grafKelderProduct->setDescription('Een Product voor grafsoort grafkelder');
        $grafKelderProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $grafKelderProduct->setType('simple');
        $grafKelderProduct->setRequiresAppointment('false');
        $grafKelderProduct->setCatalogue($westfriesland);
        $grafKelderProduct->setAudience('public');
        $manager->persist($grafKelderProduct);
        $grafKelderProduct->setId($id);
        $manager->persist($grafKelderProduct);
        $manager->flush();
        $grafKelderProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Grafkelder
        $id = Uuid::fromString('4d0731cf-aad8-4d74-80ee-c272149de935');
        $grafKelderOffer = new Offer();
        $grafKelderOffer->setName('Grafkelder');
        $grafKelderOffer->setDescription('Een Offer voor grafsoort grafkelder');
        $grafKelderOffer->setPrice('99.99');
        $grafKelderOffer->setPriceCurrency('EUR');
        $grafKelderOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $grafKelderOffer->setAudience('public');
        $manager->persist($grafKelderOffer);
        $grafKelderOffer->setId($id);
        $manager->persist($grafKelderOffer);
        $manager->flush();
        $grafKelderOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $grafKelderOffer->addProduct($grafKelderProduct);
        $manager->persist($grafKelderOffer);

        // Grafsoort product Calamiteitengraf
        $id = Uuid::fromString('e4b80300-5015-4f38-b059-350e458bf7d7');
        $calamiteitenGrafProduct = new Product();
        $calamiteitenGrafProduct->setName('Calamiteitengraf');
        $calamiteitenGrafProduct->setDescription('Een Product voor grafsoort calamiteiten graf');
        $calamiteitenGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $calamiteitenGrafProduct->setType('simple');
        $calamiteitenGrafProduct->setRequiresAppointment('false');
        $calamiteitenGrafProduct->setCatalogue($westfriesland);
        $calamiteitenGrafProduct->setAudience('public');
        $manager->persist($calamiteitenGrafProduct);
        $calamiteitenGrafProduct->setId($id);
        $manager->persist($calamiteitenGrafProduct);
        $manager->flush();
        $calamiteitenGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Calamiteitengraf
        $id = Uuid::fromString('76f7b5c2-6ca4-483a-b688-a9fe9da1142c');
        $calamiteitenGrafOffer = new Offer();
        $calamiteitenGrafOffer->setName('Calamiteitengraf');
        $calamiteitenGrafOffer->setDescription('Een Offer voor grafsoort calamiteiten graf');
        $calamiteitenGrafOffer->setPrice('99.99');
        $calamiteitenGrafOffer->setPriceCurrency('EUR');
        $calamiteitenGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $calamiteitenGrafOffer->setAudience('public');
        $manager->persist($calamiteitenGrafOffer);
        $calamiteitenGrafOffer->setId($id);
        $manager->persist($calamiteitenGrafOffer);
        $manager->flush();
        $calamiteitenGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $calamiteitenGrafOffer->addProduct($calamiteitenGrafProduct);
        $manager->persist($calamiteitenGrafOffer);

        // Grafsoort product Strooiveld
        $id = Uuid::fromString('52a86411-a966-418d-a017-5a2a1e5ff234');
        $strooiveldProduct = new Product();
        $strooiveldProduct->setName('Strooiveld');
        $strooiveldProduct->setDescription('Een Product voor grafsoort strooiveld');
        $strooiveldProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $strooiveldProduct->setType('simple');
        $strooiveldProduct->setRequiresAppointment('false');
        $strooiveldProduct->setCatalogue($westfriesland);
        $strooiveldProduct->setAudience('public');
        $manager->persist($strooiveldProduct);
        $strooiveldProduct->setId($id);
        $manager->persist($strooiveldProduct);
        $manager->flush();
        $strooiveldProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Strooiveld
        $id = Uuid::fromString('a4c1dcc2-9547-4be9-b6fb-5e044b5a3e45');
        $strooiveldOffer = new Offer();
        $strooiveldOffer->setName('Strooiveld');
        $strooiveldOffer->setDescription('Een Offer voor grafsoort strooiveld');
        $strooiveldOffer->setPrice('99.99');
        $strooiveldOffer->setPriceCurrency('EUR');
        $strooiveldOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $strooiveldOffer->setAudience('public');
        $manager->persist($strooiveldOffer);
        $strooiveldOffer->setId($id);
        $manager->persist($strooiveldOffer);
        $manager->flush();
        $strooiveldOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $strooiveldOffer->addProduct($strooiveldProduct);
        $manager->persist($strooiveldOffer);

        // Grafsoort product Babygraf
        $id = Uuid::fromString('c4b81d61-a4bb-48b6-bd90-dbb03a251781');
        $babygrafProduct = new Product();
        $babygrafProduct->setName('Babygraf');
        $babygrafProduct->setDescription('Een Product voor grafsoort babygraf');
        $babygrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $babygrafProduct->setType('simple');
        $babygrafProduct->setRequiresAppointment('false');
        $babygrafProduct->setCatalogue($westfriesland);
        $babygrafProduct->setAudience('public');
        $manager->persist($babygrafProduct);
        $babygrafProduct->setId($id);
        $manager->persist($babygrafProduct);
        $manager->flush();
        $babygrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Babygraf
        $id = Uuid::fromString('179083ae-0b62-44a7-9541-6f0536c72008');
        $babygrafOffer = new Offer();
        $babygrafOffer->setName('Babygraf');
        $babygrafOffer->setDescription('Een Offer voor grafsoort babygraf');
        $babygrafOffer->setPrice('99.99');
        $babygrafOffer->setPriceCurrency('EUR');
        $babygrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $babygrafOffer->setAudience('public');
        $manager->persist($babygrafOffer);
        $babygrafOffer->setId($id);
        $manager->persist($babygrafOffer);
        $manager->flush();
        $babygrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $babygrafOffer->addProduct($babygrafProduct);
        $manager->persist($babygrafOffer);

        // Grafsoort product Oorlogsgraf
        $id = Uuid::fromString('72bf6c2b-4561-4897-8a8a-2cc5460d1ff1');
        $oorlogsgrafProduct = new Product();
        $oorlogsgrafProduct->setName('Oorlogsgraf');
        $oorlogsgrafProduct->setDescription('Een Product voor grafsoort oorlogsgraf');
        $oorlogsgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $oorlogsgrafProduct->setType('simple');
        $oorlogsgrafProduct->setRequiresAppointment('false');
        $oorlogsgrafProduct->setCatalogue($westfriesland);
        $oorlogsgrafProduct->setAudience('public');
        $manager->persist($oorlogsgrafProduct);
        $oorlogsgrafProduct->setId($id);
        $manager->persist($oorlogsgrafProduct);
        $manager->flush();
        $oorlogsgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Oorlogsgraf
        $id = Uuid::fromString('f9a68594-fc4d-43d4-a56d-59befe638c55');
        $oorlogsgrafOffer = new Offer();
        $oorlogsgrafOffer->setName('Oorlogsgraf');
        $oorlogsgrafOffer->setDescription('Een Offer voor grafsoort oorlogsgraf');
        $oorlogsgrafOffer->setPrice('99.99');
        $oorlogsgrafOffer->setPriceCurrency('EUR');
        $oorlogsgrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $oorlogsgrafOffer->setAudience('public');
        $manager->persist($oorlogsgrafOffer);
        $oorlogsgrafOffer->setId($id);
        $manager->persist($oorlogsgrafOffer);
        $manager->flush();
        $oorlogsgrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $oorlogsgrafOffer->addProduct($oorlogsgrafProduct);
        $manager->persist($oorlogsgrafOffer);

        // Grafsoort product Cultuur historisch graf
        $id = Uuid::fromString('d0538546-3fa0-4bcd-8a5c-d2e643e0e07b');
        $cultuurHistorischGrafProduct = new Product();
        $cultuurHistorischGrafProduct->setName('Cultuur historisch graf');
        $cultuurHistorischGrafProduct->setDescription('Een Product voor grafsoort cultuur historisch graf');
        $cultuurHistorischGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $cultuurHistorischGrafProduct->setType('simple');
        $cultuurHistorischGrafProduct->setRequiresAppointment('false');
        $cultuurHistorischGrafProduct->setCatalogue($westfriesland);
        $cultuurHistorischGrafProduct->setAudience('public');
        $manager->persist($cultuurHistorischGrafProduct);
        $cultuurHistorischGrafProduct->setId($id);
        $manager->persist($cultuurHistorischGrafProduct);
        $manager->flush();
        $cultuurHistorischGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Cultuur historisch graf
        $id = Uuid::fromString('f1e6f029-56d4-4cf1-bb53-a014b32803a6');
        $cultuurHistorischGrafOffer = new Offer();
        $cultuurHistorischGrafOffer->setName('Cultuur historisch graf');
        $cultuurHistorischGrafOffer->setDescription('Een Offer voor grafsoort cultuur historisch graf');
        $cultuurHistorischGrafOffer->setPrice('99.99');
        $cultuurHistorischGrafOffer->setPriceCurrency('EUR');
        $cultuurHistorischGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $cultuurHistorischGrafOffer->setAudience('public');
        $manager->persist($cultuurHistorischGrafOffer);
        $cultuurHistorischGrafOffer->setId($id);
        $manager->persist($cultuurHistorischGrafOffer);
        $manager->flush();
        $cultuurHistorischGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $cultuurHistorischGrafOffer->addProduct($cultuurHistorischGrafProduct);
        $manager->persist($cultuurHistorischGrafOffer);

        // Grafsoort product Monument
        $id = Uuid::fromString('ec6e4f0b-2838-4a82-b78c-5f992cb6f8e2');
        $monumentProduct = new Product();
        $monumentProduct->setName('Monument');
        $monumentProduct->setDescription('Een Product voor grafsoort monument');
        $monumentProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $monumentProduct->setType('simple');
        $monumentProduct->setRequiresAppointment('false');
        $monumentProduct->setCatalogue($westfriesland);
        $monumentProduct->setAudience('public');
        $manager->persist($monumentProduct);
        $monumentProduct->setId($id);
        $manager->persist($monumentProduct);
        $manager->flush();
        $monumentProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Monument
        $id = Uuid::fromString('246dc8fd-6df9-4b67-b12a-a1fff1a85084');
        $monumentOffer = new Offer();
        $monumentOffer->setName('Monument');
        $monumentOffer->setDescription('Een Offer voor grafsoort monument');
        $monumentOffer->setPrice('99.99');
        $monumentOffer->setPriceCurrency('EUR');
        $monumentOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $monumentOffer->setAudience('public');
        $manager->persist($monumentOffer);
        $monumentOffer->setId($id);
        $manager->persist($monumentOffer);
        $manager->flush();
        $monumentOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $monumentOffer->addProduct($monumentProduct);
        $manager->persist($monumentOffer);

        // Grafsoort product Familiegraf
        $id = Uuid::fromString('66ad365c-ba4c-4246-8b3d-717045122108');
        $familieGrafProduct = new Product();
        $familieGrafProduct->setName('Familiegraf');
        $familieGrafProduct->setDescription('Een Product voor grafsoort familiegraf');
        $familieGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $familieGrafProduct->setType('simple');
        $familieGrafProduct->setRequiresAppointment('false');
        $familieGrafProduct->setCatalogue($westfriesland);
        $familieGrafProduct->setAudience('public');
        $manager->persist($familieGrafProduct);
        $familieGrafProduct->setId($id);
        $manager->persist($familieGrafProduct);
        $manager->flush();
        $familieGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Familiegraf
        $id = Uuid::fromString('0d4d1faf-0339-4578-bbe0-b1f5e1c4baeb');
        $familieGrafOffer = new Offer();
        $familieGrafOffer->setName('Familiegraf');
        $familieGrafOffer->setDescription('Een Offer voor grafsoort familiegraf');
        $familieGrafOffer->setPrice('99.99');
        $familieGrafOffer->setPriceCurrency('EUR');
        $familieGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $familieGrafOffer->setAudience('public');
        $manager->persist($familieGrafOffer);
        $familieGrafOffer->setId($id);
        $manager->persist($familieGrafOffer);
        $manager->flush();
        $familieGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $familieGrafOffer->addProduct($familieGrafProduct);
        $manager->persist($familieGrafOffer);

        // Grafsoort product Oorlogsgraf
        $id = Uuid::fromString('c658a713-5dcf-44c8-b10c-795b0f58241e');
        $oorlogsGrafProduct = new Product();
        $oorlogsGrafProduct->setName('Oorlogsgraf');
        $oorlogsGrafProduct->setDescription('Een Product voor grafsoort oorlogsgraf');
        $oorlogsGrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $oorlogsGrafProduct->setType('simple');
        $oorlogsGrafProduct->setRequiresAppointment('false');
        $oorlogsGrafProduct->setCatalogue($westfriesland);
        $oorlogsGrafProduct->setAudience('public');
        $manager->persist($oorlogsGrafProduct);
        $oorlogsGrafProduct->setId($id);
        $manager->persist($oorlogsGrafProduct);
        $manager->flush();
        $oorlogsGrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Oorlogsgraf
        $id = Uuid::fromString('ce3c79df-f626-4c74-afde-38d054880ca3');
        $oorlogsGrafOffer = new Offer();
        $oorlogsGrafOffer->setName('Oorlogsgraf');
        $oorlogsGrafOffer->setDescription('Een Offer voor grafsoort oorlogsgraf');
        $oorlogsGrafOffer->setPrice('99.99');
        $oorlogsGrafOffer->setPriceCurrency('EUR');
        $oorlogsGrafOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $oorlogsGrafOffer->setAudience('public');
        $manager->persist($oorlogsGrafOffer);
        $oorlogsGrafOffer->setId($id);
        $manager->persist($oorlogsGrafOffer);
        $manager->flush();
        $oorlogsGrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $oorlogsGrafOffer->addProduct($oorlogsGrafProduct);
        $manager->persist($oorlogsGrafOffer);

        // Grafsoort product Gedenkteken
        $id = Uuid::fromString('0cfd03a7-917d-4df3-8687-9488560411ce');
        $gedenktekenProduct = new Product();
        $gedenktekenProduct->setName('Gedenkteken');
        $gedenktekenProduct->setDescription('Een Product voor grafsoort gedenkteken');
        $gedenktekenProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $gedenktekenProduct->setType('simple');
        $gedenktekenProduct->setRequiresAppointment('false');
        $gedenktekenProduct->setCatalogue($westfriesland);
        $gedenktekenProduct->setAudience('public');
        $manager->persist($gedenktekenProduct);
        $gedenktekenProduct->setId($id);
        $manager->persist($gedenktekenProduct);
        $manager->flush();
        $gedenktekenProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Grafsoort offer Gedenkteken
        $id = Uuid::fromString('7ae0c837-20ef-4c3e-9b27-00e5c599f570');
        $gedenktekenOffer = new Offer();
        $gedenktekenOffer->setName('Gedenkteken');
        $gedenktekenOffer->setDescription('Een Offer voor grafsoort gedenkteken');
        $gedenktekenOffer->setPrice('99.99');
        $gedenktekenOffer->setPriceCurrency('EUR');
        $gedenktekenOffer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d280c4d3-6310-46db-9934-5285ec7d0d5e'])); // West Friesland
        $gedenktekenOffer->setAudience('public');
        $manager->persist($gedenktekenOffer);
        $gedenktekenOffer->setId($id);
        $manager->persist($gedenktekenOffer);
        $manager->flush();
        $gedenktekenOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $gedenktekenOffer->addProduct($gedenktekenProduct);
        $manager->persist($gedenktekenOffer);

        // Grafsoorten group gemeente SED
        $id = Uuid::fromString('58298393-2682-4412-9fca-a03170592610');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten SED');
        $group->setDescription('Een groep voor de grafsoorten van de gemeente SED');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f'])); // SED
        $group->setCatalogue($sed);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($algemeenGrafProduct);
        $group->addProduct($urngrafProduct);
        $group->addProduct($huurgrafProduct);
        $group->addProduct($particulierGrafProduct);
        $manager->persist($group);

        // Grafsoorten group gemeente Hoorn
        $id = Uuid::fromString('17c09fb9-a3a1-4fc9-9617-5ebcf73e06cc');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Hoorn');
        $group->setDescription('Een groep voor de grafsoorten van de gemeente Hoorn');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384'])); // Hoorn
        $group->setCatalogue($hoorn);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($koopgrafProduct);
        $group->addProduct($urngrafProduct);
        $group->addProduct($urnennisProduct);
        $group->addProduct($huurgrafProduct);
        $group->addProduct($particulierGrafProduct);
        $group->addProduct($algemeenGrafProduct);
        $group->addProduct($kinderGrafProduct);
        $manager->persist($group);

        // Grafsoorten group begraafplaats Zuiderveld in gemeente Hoorn
        $id = Uuid::fromString('baf448a2-671e-481b-88b8-34f9598b5d8b');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten begraafplaats Zuiderveld');
        $group->setDescription('Een groep voor de grafsoorten van de begraafplaats Zuiderveld in gemeente Hoorn');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384'])); // Hoorn
        $group->setCatalogue($hoorn);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($koopgrafProduct);
        $group->addProduct($urngrafProduct);
        $group->addProduct($gedenktekenProduct);
        $group->addProduct($algemeenGrafProduct);
        $group->addProduct($kinderGrafProduct);
        $manager->persist($group);

        // Grafsoorten group gemeente Medemblik
        $id = Uuid::fromString('9ed30829-4e38-43a1-a497-c47f7bc54124');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Medemblik');
        $group->setDescription('Een groep voor grafsoorten van de gemeente Medemblik');
        $group->setLogo('https://www.my-organization.com/GrafsoortenMedembliklogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $group->setCatalogue($medemblik);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($particulierGrafProduct);
        $group->addProduct($kinderGrafProduct);
        $group->addProduct($urngrafProduct);
        $group->addProduct($strooiveldProduct);
        $group->addProduct($babygrafProduct);
        $group->addProduct($oorlogsgrafProduct);
        $group->addProduct($algemeenGrafProduct);
        $group->addProduct($urnennisProduct);
        $group->addProduct($cultuurHistorischGrafProduct);
        $group->addProduct($gedenktekenProduct);
        $manager->persist($group);

        // Grafsoorten group gemeente Koggenland
        $id = Uuid::fromString('4bc89791-dd77-479f-8df0-3fd10ce47839');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Koggenland');
        $group->setDescription('Een groep voor de grafsoorten van de gemeente Koggenland');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'f050292c-973d-46ab-97ae-9d8830a59d15'])); // Koggenland
        $group->setCatalogue($koggenland);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($huurgrafProduct);
        $group->addProduct($kinderGrafProduct);
        $group->addProduct($urngrafProduct);
        $group->addProduct($algemeenGrafProduct);
        $group->addProduct($grafKelderProduct);
        $group->addProduct($koopgrafProduct);
        $group->addProduct($calamiteitenGrafProduct);
        $manager->persist($group);

        // Grafsoorten group gemeente Opmeer
        $id = Uuid::fromString('c0379617-0d36-406b-8a99-e230aad496bf');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Opmeer');
        $group->setDescription('Een groep voor grafsoorten van de gemeente Opmeer');
        $group->setLogo('https://www.my-organization.com/GrafsoortenOpmeerlogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'16fd1092-c4d3-4011-8998-0e15e13239cf'])); // Opmeer
        $group->setCatalogue($opmeer);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($algemeenGrafProduct);
        $group->addProduct($urngrafProduct);
        $manager->persist($group);

        // Grafsoorten group gemeente Hogeland
        $id = Uuid::fromString('02211125-c441-4c1c-bbd1-37c86aa5fc79');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Hogeland');
        $group->setDescription('Een groep voor grafsoorten van de gemeente Hogeland');
        $group->setLogo('https://www.my-organization.com/GrafsoortenHogelandlogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233'])); // Hogeland
        $group->setCatalogue($hogeland);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($algemeenGrafProduct);
        $group->addProduct($urngrafProduct);
        $group->addProduct($urnennisProduct);
        $group->addProduct($strooiveldProduct);
        $group->addProduct($kinderGrafProduct);
        $group->addProduct($monumentProduct);
        $group->addProduct($oorlogsGrafProduct);
        $group->addProduct($familieGrafProduct);
        $manager->persist($group);

        //Artikelen
        //Product WognumKreekland
        // DiversenProduct
        $id = Uuid::fromString('29c81fb5-3df5-48a3-80a2-e52480983e56');
        $product = new Product();
        $product->setName('Diversen Product');
        $product->setDescription('Een Product voor Diversen');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'2556c084-0687-4ca1-b098-e4f0a7292ae8'])); // Wognum (Kreekland)
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setCatalogue($medemblik);
        $product->setAudience('public');
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Offers WognumKreekland
        // Gebruik Orgel
        $id = Uuid::fromString('f791ae50-c471-40e9-8ac9-53975c89b328');
        $offer = new Offer();
        $offer->setName('Gebruik Orgel');
        $offer->setDescription('Gebruik van een orgel tijdens een begrafenis');
        $offer->setPrice('100.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Gebruik Koffiekamer
        $id = Uuid::fromString('576550f6-aca2-42e0-a994-7625f427d0e1');
        $offer = new Offer();
        $offer->setName('Gebruik Koffiekamer');
        $offer->setDescription('Gebruik van een koffiekamer tijdens een begrafenis');
        $offer->setPrice('45.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Gebruik CD speler
        $id = Uuid::fromString('3a7f1f81-94d3-49f6-86d3-3d1479277632');
        $offer = new Offer();
        $offer->setName('Gebruik CD speler');
        $offer->setDescription('Gebruik van een CD speler tijdens een begrafenis');
        $offer->setPrice('40.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Group WognumKreekland
        // Diversen
        $id = Uuid::fromString('b939de43-9c04-4d5e-81e8-2f4d5054fe83');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Diversen');
        $group->setDescription('Een groep voor Diversen');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'2556c084-0687-4ca1-b098-e4f0a7292ae8'])); // Wognum (Kreekland)
        $group->setCatalogue($medemblik);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);

        //Product WognumKreekland
        // BijzettingsartikelenProduct
        $id = Uuid::fromString('1b775822-7a8d-4848-a455-408a0365a9bf');
        $product = new Product();
        $product->setName('Bijzettingsartikelen Product');
        $product->setDescription('Een Product voor Bijzettingsartikelen');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'2556c084-0687-4ca1-b098-e4f0a7292ae8'])); // Wognum (Kreekland)
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setCatalogue($medemblik);
        $product->setAudience('public');
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Offers WognumKreekland
        // Bijzetting Urn
        $id = Uuid::fromString('b385925a-0b44-45f1-9ac2-930329b00916');
        $offer = new Offer();
        $offer->setName('Bijzetting Urn');
        $offer->setDescription('De toepassing van een bijzetting urn tijdens een begrafenis');
        $offer->setPrice('50.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Bijzetting Asbus
        $id = Uuid::fromString('ccaae856-1060-4d25-8537-b4ac11fd06c3');
        $offer = new Offer();
        $offer->setName('Bijzetting Asbus');
        $offer->setDescription('De toepassing van een bijzetting asbus tijdens een begrafenis');
        $offer->setPrice('50.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Group WognumKreekland
        // Bijzettingsartikelen
        $id = Uuid::fromString('9f9a78cb-f708-447f-8795-23f6cf13c39d');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Bijzettingsartikelen');
        $group->setDescription('Een groep voor Bijzettingsartikelen');
        $group->setLogo('https://www.my-organization.com/Bijzettingslogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'2556c084-0687-4ca1-b098-e4f0a7292ae8'])); // Wognum (Kreekland)
        $group->setCatalogue($medemblik);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);

        //Product Hogeland
        // BijzettingsartikelenProduct
        $id = Uuid::fromString('fdab3885-2975-4336-bdb6-31f4b70bba69');
        $product = new Product();
        $product->setName('Bijzettingsartikelen Product');
        $product->setDescription('Een Product voor Bijzettingsartikelen');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'2556c084-0687-4ca1-b098-e4f0a7292ae8'])); // Wognum (Kreekland)
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setCatalogue($medemblik);
        $product->setAudience('public');
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Offers Hogeland
        // Bijzetting Urn
        $id = Uuid::fromString('ee69099b-d5db-43d9-9ac2-1cc338654a84');
        $offer = new Offer();
        $offer->setName('Bijzetting Urn');
        $offer->setDescription('De toepassing van een bijzetting urn tijdens een begrafenis');
        $offer->setPrice('50.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Bijzetting Asbus
        $id = Uuid::fromString('9145ae9c-3b8f-452e-bc39-731c31450275');
        $offer = new Offer();
        $offer->setName('Bijzetting Asbus');
        $offer->setDescription('De toepassing van een bijzetting asbus tijdens een begrafenis');
        $offer->setPrice('50.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Group Hogeland
        // Bijzettingsartikelen
        $id = Uuid::fromString('8135397c-b2ca-413c-ad76-3b3d011cf2f6');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Bijzettingsartikelen');
        $group->setDescription('Een groep voor Bijzettingsartikelen');
        $group->setLogo('https://www.my-organization.com/Bijzettingslogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'2556c084-0687-4ca1-b098-e4f0a7292ae8'])); // Wognum (Kreekland)
        $group->setCatalogue($hogeland);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);

        // Product Opperdoes Nieuw
        // DiversenProduct
        $id = Uuid::fromString('32ccfa18-4dbc-4895-8d5a-b25a982c28e3');
        $product = new Product();
        $product->setName('Diversen Product');
        $product->setDescription('Een product voor Diversen');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'074defab-e2eb-4eeb-a22f-caf082502db6'])); // Opperdoes Nieuw
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setCatalogue($medemblik);
        $product->setAudience('public');
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Offers Opperdoes Nieuw
        // Gebruik Orgel
        $id = Uuid::fromString('72183cad-0023-44f5-b743-d0c7eb8f3745');
        $offer = new Offer();
        $offer->setName('Gebruik Orgel');
        $offer->setDescription('Gebruik van een orgel tijdens een begrafenis');
        $offer->setPrice('100.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Gebruik Koffiekamer
        $id = Uuid::fromString('940a4bc2-f7c1-4d39-9764-32d36aa0c26a');
        $offer = new Offer();
        $offer->setName('Gebruik Koffiekamer');
        $offer->setDescription('Gebruik van een koffiekamer tijdens een begrafenis');
        $offer->setPrice('45.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $group->setCatalogue($medemblik);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Gebruik CD speler
        $id = Uuid::fromString('61ced7cd-1b30-444b-b46d-d1fa49b05ab1');
        $offer = new Offer();
        $offer->setName('Gebruik CD speler');
        $offer->setDescription('Gebruik van een CD speler tijdens een begrafenis');
        $offer->setPrice('40.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Group Opperdoes Nieuw
        // Diversen
        $id = Uuid::fromString('fa842893-8c8b-4acf-b1eb-284e3ea34083');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Diversen');
        $group->setDescription('Een groep voor Diversen');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'074defab-e2eb-4eeb-a22f-caf082502db6'])); // Opperdoes Nieuw
        $group->setCatalogue($medemblik);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);

        // Product Opperdoes Nieuw
        // AsartikelenProduct
        $id = Uuid::fromString('aa995cc0-d3fd-4869-9d04-07be32ab172f');
        $product = new Product();
        $product->setName('As artikelen Product');
        $product->setDescription('Een Product voor as artikelen');
        $product->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'074defab-e2eb-4eeb-a22f-caf082502db6'])); // Opperdoes Nieuw
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setCatalogue($medemblik);
        $product->setAudience('public');
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Offers Opperdoes Nieuw
        // Asverstrooiing
        $id = Uuid::fromString('5bbe119d-718c-4b04-82df-63495854b4f4');
        $offer = new Offer();
        $offer->setName('Asverstrooiing');
        $offer->setDescription('De toepassing van asverstrooiing tijdens een begrafenis');
        $offer->setPrice('50.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5'])); // Medemblik
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Group Opperdoes Nieuw
        // Asartikelen
        $id = Uuid::fromString('bae59b6b-4866-4476-ad87-6246f488c1b4');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('As artikelen');
        $group->setDescription('Een groep voor as artikelen');
        $group->setLogo('https://www.my-organization.com/Aslogo.png');
        $group->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'074defab-e2eb-4eeb-a22f-caf082502db6'])); // Opperdoes Nieuw
        $group->setCatalogue($medemblik);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);

        $manager->flush();
        */


        */

        $id = Uuid::fromString('14569bf0-8f5e-4799-bdc5-376e71c620d0');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 2 grafruimten 10 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 2 grafruimten 10 jaar');
        $offer->setPrice(1149);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('81424ab3-9421-45b7-974d-5b2b84f47fcf');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 2 grafruimten 15 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 2 grafruimten 15 jaar');
        $offer->setPrice(1695);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('d0979ef3-c5cf-42c4-972a-8b76b8fff572');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 2 grafruimten 20 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 2 grafruimten 20 jaar');
        $offer->setPrice(2241);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('a8fdf11d-beca-4264-aefd-179e6e6f7d3a');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 2 grafruimten 25 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 2 grafruimten 25 jaar');
        $offer->setPrice(2787);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('89859e91-b3be-4bfd-813e-4f713aba7fa1');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 2 grafruimten 30 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 2 grafruimten 30 jaar');
        $offer->setPrice(3333);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('c372a1ee-5fcd-4da2-8234-19fe6880e268');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 3 grafruimten 10 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 3 grafruimten 10 jaar');
        $offer->setPrice(1412);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('6127942a-786c-41ea-9066-dcb3051eb6ca');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 3 grafruimten 15 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 3 grafruimten 15 jaar');
        $offer->setPrice(2082);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('5a0f892f-ffb5-4ee0-a936-9ac807daa0b9');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 3 grafruimten 20 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 3 grafruimten 20 jaar');
        $offer->setPrice(2753);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('882e89c2-969e-4814-9713-e5e9fa786ba3');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 3 grafruimten 25 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 3 grafruimten 25 jaar');
        $offer->setPrice(3423);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('aa65666f-5fda-43dc-a6ae-5e188372b553');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier graf 3 grafruimten 30 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier graf 3 grafruimten 30 jaar');
        $offer->setPrice(4094);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('94fb8fca-5a69-40b1-a95f-5a7530628253');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Algemeen graf');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Algemeen graf');
        $offer->setPrice(756);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('18f63ee7-9ef0-4592-ba14-da3536ed63fc');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier kindergraf  10 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier kindergraf  10 jaar');
        $offer->setPrice(787);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('08772c67-c5f7-485b-9edd-6ac49b345da6');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier kindergraf  15 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier kindergraf  15 jaar');
        $offer->setPrice(1160,5);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('983447d0-0291-4d84-b52f-f8712b2753cb');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier kindergraf 20 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier kindergraf 20 jaar');
        $offer->setPrice(1534);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('9c110578-0af2-4ecf-8bc7-d06c75974676');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier kindergraf  25 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier kindergraf  25 jaar');
        $offer->setPrice(1907,5);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $id = Uuid::fromString('202306da-bd92-4546-aa11-231fad7a4ea4');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Particulier kindergraf 30 jaar');
        $koopgrafProduct->setDescription('');
        $koopgrafProduct->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $koopgrafProduct->setType('simple');
        $koopgrafProduct->setRequiresAppointment('false');
        $koopgrafProduct->setCatalogue($hoorn);
        $koopgrafProduct->setAudience('public');
        $manager->persist($koopgrafProduct);
        $koopgrafProduct->setId($id);
        $manager->persist($koopgrafProduct);
        $manager->flush();
        $koopgrafProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        $offer = new Offer();
        $offer->setName('Particulier kindergraf 30 jaar');
        $offer->setPrice(2281);
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
        $offer->setAudience('public');
        $offer->addProduct($koopgrafProduct);
        $manager->persist($offer);

        $manager->flush();
    }
}
