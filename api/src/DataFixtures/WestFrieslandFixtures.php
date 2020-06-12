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
            $this->params->get('app_domain') != 'begraven.zaakonline.nl' && strpos($this->params->get('app_domain'), 'begraven.zaakonline.nl') == false &&
            $this->params->get('app_domain') != 'westfriesland.commonground.nu' && strpos($this->params->get('app_domain'), 'westfriesland.commonground.nu') == false &&
            $this->params->get('app_domain') != "zuid-drecht.nl" && strpos($this->params->get('app_domain'), "zuid-drecht.nl") == false
        ) {
            return false;
        }

        // Catalogi
        // Gemeente Medemblik
        $medemblik = new Catalogue();
        $medemblik->setName('Gemeente Medemblik');
        $medemblik->setDescription('De catalogus van de Gemeente Medemblik');
        $medemblik->setLogo('https://www.my-organization.com/GemeenteMedembliklogo.png');
        $medemblik->setSourceOrganization('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $manager->persist($medemblik);

        $manager->flush();

        //Product WognumKreekland
        // DiversenProduct
        $id = Uuid::fromString('29c81fb5-3df5-48a3-80a2-e52480983e56');
        $product = new Product();
        $product->setSku('69667-2020');
        $product->setName('Diversen Product');
        $product->setDescription('Een Product voor Diversen');
        $product->setLogo('https://www.my-organization.com/DiversenProductlogo.png');
        $product->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $product->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
        $product->setPrice('1.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage('9');
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setAudience('string');
        $product->setDuration('PT10M');
        $product->setCatalogue($medemblik);
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
        $offer->addProduct($product);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik Koffiekamer
        $id = Uuid::fromString('576550f6-aca2-42e0-a994-7625f427d0e1');
        $offer = new Offer();
        $offer->setName('Gebruik Koffiekamer');
        $offer->setDescription('Gebruik van een koffiekamer tijdens een begrafenis');
        $offer->setPrice('45.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $offer->addProduct($product);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik CD speler
        $id = Uuid::fromString('3a7f1f81-94d3-49f6-86d3-3d1479277632');
        $offer = new Offer();
        $offer->setName('Gebruik CD speler');
        $offer->setDescription('Gebruik van een CD speler tijdens een begrafenis');
        $offer->setPrice('40.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $offer->addProduct($product);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Group WognumKreekland
        // Diversen
        $id = Uuid::fromString('b939de43-9c04-4d5e-81e8-2f4d5054fe83');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Diversen');
        $group->setDescription('Een groep voor Diversen');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
        $group->setCatalogue($medemblik);
        $group->addProduct($product);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        //Product WognumKreekland
        // BijzettingsartikelenProduct
        $id = Uuid::fromString('1b775822-7a8d-4848-a455-408a0365a9bf');
        $product = new Product();
        $product->setSku('69666-2020');
        $product->setName('Bijzettingsartikelen Product');
        $product->setDescription('Een Product voor Bijzettingsartikelen');
        $product->setLogo('https://www.my-organization.com/BijzettingsartikelenProductlogo.png');
        $product->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $product->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
        $product->setPrice('1.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage('9');
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setAudience('string');
        $product->setDuration('PT10M');
        $product->setCatalogue($medemblik);
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
        $offer->addProduct($product);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Bijzetting Asbus
        $id = Uuid::fromString('ccaae856-1060-4d25-8537-b4ac11fd06c3');
        $offer = new Offer();
        $offer->setName('Bijzetting Asbus');
        $offer->setDescription('De toepassing van een bijzetting asbus tijdens een begrafenis');
        $offer->setPrice('50.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $offer->addProduct($product);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Group WognumKreekland
        // Bijzettingsartikelen
        $id = Uuid::fromString('9f9a78cb-f708-447f-8795-23f6cf13c39d');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Bijzettingsartikelen');
        $group->setDescription('Een groep voor Bijzettingsartikelen');
        $group->setLogo('https://www.my-organization.com/Bijzettingslogo.png');
        $group->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
        $group->setCatalogue($medemblik);
        $group->addProduct($product);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);


        // Product Opperdoes Oud
        // DiversenProduct
        $id = Uuid::fromString('32ccfa18-4dbc-4895-8d5a-b25a982c28e3');
        $product = new Product();
        $product->setSku('69667-2020');
        $product->setName('Diversen Product');
        $product->setDescription('Een product voor Diversen');
        $product->setLogo('https://www.my-organization.com/DiversenProductlogo.png');
        $product->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $product->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $product->setPrice('1.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage('9');
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setAudience('string');
        $product->setDuration('PT10M');
        $product->setCatalogue($medemblik);
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
        $offer->addProduct($product);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik Koffiekamer
        $id = Uuid::fromString('940a4bc2-f7c1-4d39-9764-32d36aa0c26a');
        $offer = new Offer();
        $offer->setName('Gebruik Koffiekamer');
        $offer->setDescription('Gebruik van een koffiekamer tijdens een begrafenis');
        $offer->setPrice('45.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $group->setCatalogue($medemblik);
        $offer->addProduct($product);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik CD speler
        $id = Uuid::fromString('61ced7cd-1b30-444b-b46d-d1fa49b05ab1');
        $offer = new Offer();
        $offer->setName('Gebruik CD speler');
        $offer->setDescription('Gebruik van een CD speler tijdens een begrafenis');
        $offer->setPrice('40.00');
        $offer->setPriceCurrency('EUR');
        $offer->setOfferedBy('https://wrc.dev.westfriesland.commonground.nu/organizations/429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $offer->addProduct($product);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Group Opperdoes Oud
        // Diversen
        $id = Uuid::fromString('fa842893-8c8b-4acf-b1eb-284e3ea34083');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('Diversen');
        $group->setDescription('Een groep voor Diversen');
        $group->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $group->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $group->addProduct($product);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        // Product Opperdoes Oud
        // AsartikelenProduct
        $id = Uuid::fromString('aa995cc0-d3fd-4869-9d04-07be32ab172f');
        $product = new Product();
        $product->setSku('69666-2020');
        $product->setName('As artikelen Product');
        $product->setDescription('Een Product voor as artikelen');
        $product->setLogo('https://www.my-organization.com/BijzettingsartikelenProductlogo.png');
        $product->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $product->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $product->setPrice('1.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage('9');
        $product->setType('simple');
        $product->setRequiresAppointment('false');
        $product->setAudience('string');
        $product->setDuration('PT10M');
        $product->setCatalogue($medemblik);
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
        $offer->addProduct($product);
        $manager->persist($offer);
        $offer->setId($id);
        $manager->persist($offer);
        $manager->flush();
        $offer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Group Opperdoes Oud
        // Asartikelen
        $id = Uuid::fromString('bae59b6b-4866-4476-ad87-6246f488c1b4');
        $group = new Group();
        $group->setIcon('My Icon');
        $group->setName('As artikelen');
        $group->setDescription('Een groep voor as artikelen');
        $group->setLogo('https://www.my-organization.com/Aslogo.png');
        $group->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $group->setCatalogue($medemblik);
        $group->addProduct($product);
        $manager->persist($group);
        $group->setId($id);
        $manager->persist($group);
        $manager->flush();
        $group = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);


        $manager->flush();
    }
}
