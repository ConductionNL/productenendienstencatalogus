<?php

namespace App\DataFixtures;

use App\Entity\Catalogue;
use App\Entity\Group;
use App\Entity\Product;
use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WestFrieslandFixtures extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        if (
            // If build all fixtures is true we build all the fixtures
            !$this->params->get('app_build_all_fixtures') &&
            // Specific domain names
            $this->params->get('app_domain') != 'begraven.zaakonline.nl' && strpos($this->params->get('app_domain'), 'begraven.zaakonline.nl') == false &&
            $this->params->get('app_domain') != 'westfriesland.commonground.nu' && strpos($this->params->get('app_domain'), 'westfriesland.commonground.nu') == false &&
            $this->params->get('app_domain') != "zuid-drecht.nl" && strpos($this->params->get('app_domain'), "zuid-drecht.nl") == false
        ) {
            return false;
        }

        // Catalogi
        // Gemeente SED
        $sed = new Catalogue();
        $sed->setName('Gemeente SED');
        $sed->setDescription('De catalogus van de Gemeente Stede Broec, Enkhuizen en Drechterland');
        $sed->setLogo('https://www.my-organization.com/GemeenteSEDlogo.png');
        $sed->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/7033eeb4-5c77-4d88-9f40-303b538f176f');
        $manager->persist($sed);

        // Gemeente Hoorn
        $hoorn = new Catalogue();
        $hoorn->setName('Gemeente Hoorn');
        $hoorn->setDescription('De catalogus van de Gemeente Hoorn');
        $hoorn->setLogo('https://www.my-organization.com/GemeenteHoornlogo.png');
        $hoorn->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/d736013f-ad6d-4885-b816-ce72ac3e1384');
        $manager->persist($hoorn);

        // Gemeente Medemblik
        $medemblik = new Catalogue();
        $medemblik->setName('Gemeente Medemblik');
        $medemblik->setDescription('De catalogus van de Gemeente Medemblik');
        $medemblik->setLogo('https://www.my-organization.com/GemeenteMedembliklogo.png');
        $medemblik->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $manager->persist($medemblik);

        // Gemeente Koggenland
        $koggenland = new Catalogue();
        $koggenland->setName('Gemeente Koggenland');
        $koggenland->setDescription('De catalogus van de Gemeente Koggenland');
        $koggenland->setLogo('https://www.my-organization.com/GemeenteKoggenlandlogo.png');
        $koggenland->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/f050292c-973d-46ab-97ae-9d8830a59d15');
        $manager->persist($koggenland);

        // Gemeente Opmeer
        $opmeer = new Catalogue();
        $opmeer->setName('Gemeente Opmeer');
        $opmeer->setDescription('De catalogus van de Gemeente Opmeer');
        $opmeer->setLogo('https://www.my-organization.com/GemeenteOpmeerlogo.png');
        $opmeer->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/16fd1092-c4d3-4011-8998-0e15e13239cf');
        $manager->persist($opmeer);

        // Gemeente Westfriesland
        $westfriesland = new Catalogue();
        $westfriesland->setName('Gemeente Westfriesland');
        $westfriesland->setDescription('De catalogus van de Gemeente Westfriesland');
        $westfriesland->setLogo('https://www.my-organization.com/GemeenteWestfrieslandlogo.png');
        $westfriesland->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/d280c4d3-6310-46db-9934-5285ec7d0d5e');
        $manager->persist($westfriesland);

        $manager->flush();

        // Grafsoorten
        // Grafsoort product Koopgraf
        $id = Uuid::fromString('e8cd45f7-350e-408d-8266-153e9395a755');
        $koopgrafProduct = new Product();
        $koopgrafProduct->setName('Koopgraf');
        $koopgrafProduct->setDescription('Een Product voor grafsoort Koopgraf');
        $koopgrafProduct->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/d280c4d3-6310-46db-9934-5285ec7d0d5e');
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
        $koopgrafOffer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/d280c4d3-6310-46db-9934-5285ec7d0d5e');
        $koopgrafOffer->setAudience('public');
        $manager->persist($koopgrafOffer);
        $koopgrafOffer->setId($id);
        $manager->flush();
        $koopgrafOffer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $koopgrafOffer->addProduct($koopgrafProduct);
        $manager->persist($koopgrafOffer);

        // Grafsoorten group gemeente SED
        $id = Uuid::fromString('58298393-2682-4412-9fca-a03170592610');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten SED');
        $group->setDescription('Een groep voor de grafsoorten van de gemeente SED');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/7033eeb4-5c77-4d88-9f40-303b538f176f');
        $group->setCatalogue($sed);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($kist);
        $group->addProduct($urn);
        $manager->persist($group);

        // Grafsoorten group gemeente Hoorn
        $id = Uuid::fromString('17c09fb9-a3a1-4fc9-9617-5ebcf73e06cc');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Hoorn');
        $group->setDescription('Een groep voor de grafsoorten van de gemeente Hoorn');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/d736013f-ad6d-4885-b816-ce72ac3e1384');
        $group->setCatalogue($hoorn);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($koopgrafProduct);
        $manager->persist($group);

        // Grafsoorten group begraafplaats Zuiderveld in gemeente Hoorn
        $id = Uuid::fromString('17c09fb9-a3a1-4fc9-9617-5ebcf73e06cc');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten begraafplaats Zuiderveld');
        $group->setDescription('Een groep voor de grafsoorten van de begraafplaats Zuiderveld in gemeente Hoorn');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/d736013f-ad6d-4885-b816-ce72ac3e1384');
        $group->setCatalogue($hoorn);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($koopgrafProduct);
        $manager->persist($group);

        // Grafsoorten group gemeente Medemblik
        $id = Uuid::fromString('9ed30829-4e38-43a1-a497-c47f7bc54124');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Medemblik');
        $group->setDescription('Een groep voor grafsoorten van de gemeente Medemblik');
        $group->setLogo('https://www.my-organization.com/GrafsoortenMedembliklogo.png');
        $group->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $group->setCatalogue($medemblik);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);

        // Grafsoorten group gemeente Koggenland
        $id = Uuid::fromString('4bc89791-dd77-479f-8df0-3fd10ce47839');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Koggenland');
        $group->setDescription('Een groep voor de grafsoorten van de gemeente Koggenland');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/f050292c-973d-46ab-97ae-9d8830a59d15');
        $group->setCatalogue($koggenland);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($kist);
        $group->addProduct($urn);
        $manager->persist($group);

        // Grafsoorten group gemeente Opmeer
        $id = Uuid::fromString('c0379617-0d36-406b-8a99-e230aad496bf');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Grafsoorten Opmeer');
        $group->setDescription('Een groep voor grafsoorten van de gemeente Opmeer');
        $group->setLogo('https://www.my-organization.com/GrafsoortenOpmeerlogo.png');
        $group->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/16fd1092-c4d3-4011-8998-0e15e13239cf');
        $group->setCatalogue($opmeer);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);


        //Artikelen
        //Product WognumKreekland
        // DiversenProduct
        $id = Uuid::fromString('29c81fb5-3df5-48a3-80a2-e52480983e56');
        $product = new Product();
        $product->setName('Diversen Product');
        $product->setDescription('Een Product voor Diversen');
        $product->setSourceOrganization('https://grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
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
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
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
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
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
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
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
        $group->setSourceOrganization('https://grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
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
        $product->setSourceOrganization('https://grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
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
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
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
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
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
        $group->setSourceOrganization('https://grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
        $group->setCatalogue($medemblik);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);


        // Product Opperdoes Oud
        // DiversenProduct
        $id = Uuid::fromString('32ccfa18-4dbc-4895-8d5a-b25a982c28e3');
        $product = new Product();
        $product->setName('Diversen Product');
        $product->setDescription('Een product voor Diversen');
        $product->setSourceOrganization('https://grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setCatalogue($medemblik);
        $product->setAudience('public');
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Offers Opperdoes Oud
        // Gebruik Orgel
        $id = Uuid::fromString('72183cad-0023-44f5-b743-d0c7eb8f3745');
        $offer = new Offer();
        $offer->setName('Gebruik Orgel');
        $offer->setDescription('Gebruik van een orgel tijdens een begrafenis');
        $offer->setPrice('100.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
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
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
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
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Group Opperdoes Oud
        // Diversen
        $id = Uuid::fromString('fa842893-8c8b-4acf-b1eb-284e3ea34083');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Diversen');
        $group->setDescription('Een groep voor Diversen');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization('https://grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $group->setCatalogue($medemblik);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);

        // Product Opperdoes Oud
        // AsartikelenProduct
        $id = Uuid::fromString('aa995cc0-d3fd-4869-9d04-07be32ab172f');
        $product = new Product();
        $product->setName('As artikelen Product');
        $product->setDescription('Een Product voor as artikelen');
        $product->setSourceOrganization('https://grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setCatalogue($medemblik);
        $product->setAudience('public');
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // Offers Opperdoes Oud
        // Asverstrooiing
        $id = Uuid::fromString('5bbe119d-718c-4b04-82df-63495854b4f4');
        $offer = new Offer();
        $offer->setName('Asverstrooiing');
        $offer->setDescription('De toepassing van asverstrooiing tijdens een begrafenis');
        $offer->setPrice('50.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $offer->setAudience('public');
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);
        $offer->addProduct($product);
        $manager->persist($offer);

        // Group Opperdoes Oud
        // Asartikelen
        $id = Uuid::fromString('bae59b6b-4866-4476-ad87-6246f488c1b4');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('As artikelen');
        $group->setDescription('Een groep voor as artikelen');
        $group->setLogo('https://www.my-organization.com/Aslogo.png');
        $group->setSourceOrganization('https://grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $group->setCatalogue($medemblik);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        $group->addProduct($product);
        $manager->persist($group);


        $manager->flush();
    }
}
