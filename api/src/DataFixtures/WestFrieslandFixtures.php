<?php

namespace App\DataFixtures;

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
            $this->params->get('app_domain') != 'begraven.zaakonline.nl' &&
            strpos($this->params->get('app_domain'), 'begraven.zaakonline.nl') == false &&
            $this->params->get('app_domain') != 'westfriesland.commonground.nu' &&
            strpos($this->params->get('app_domain'), 'westfriesland.commonground.nu') == false
        ) {
            return false;
        }

        // Offers
        // Gebruik Orgel
        $id = Uuid::fromString('f791ae50-c471-40e9-8ac9-53975c89b328');
        $GebruikOrgel = new Offer();
        $GebruikOrgel->setName('Gebruik Orgel');
        $GebruikOrgel->setDescription('Gebruik van een orgel tijdens een begrafenis');
        $GebruikOrgel->setPrice('100.00');
        $GebruikOrgel->setPriceCurrency('EUR');
        $manager->persist($GebruikOrgel);
        $GebruikOrgel->setId($id);
        $manager->persist($GebruikOrgel);
        $manager->flush();
        $GebruikOrgel = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik Koffiekamer
        $id = Uuid::fromString('576550f6-aca2-42e0-a994-7625f427d0e1');
        $GebruikKoffiekamer = new Offer();
        $GebruikKoffiekamer->setName('Gebruik Koffiekamer');
        $GebruikKoffiekamer->setDescription('Gebruik van een koffiekamer tijdens een begrafenis');
        $GebruikKoffiekamer->setPrice('45.00');
        $GebruikKoffiekamer->setPriceCurrency('EUR');
        $manager->persist($GebruikKoffiekamer);
        $GebruikKoffiekamer->setId($id);
        $manager->persist($GebruikKoffiekamer);
        $manager->flush();
        $GebruikKoffiekamer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik CD speler
        $id = Uuid::fromString('3a7f1f81-94d3-49f6-86d3-3d1479277632');
        $GebruikCDSpeler = new Offer();
        $GebruikCDSpeler->setName('Gebruik CD speler');
        $GebruikCDSpeler->setDescription('Gebruik van een CD speler tijdens een begrafenis');
        $GebruikCDSpeler->setPrice('40.00');
        $GebruikCDSpeler->setPriceCurrency('EUR');
        $manager->persist($GebruikCDSpeler);
        $GebruikCDSpeler->setId($id);
        $manager->persist($GebruikCDSpeler);
        $manager->flush();
        $GebruikCDSpeler = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Asverstrooiing
        $id = Uuid::fromString('20038c17-31fe-4c2b-99fb-72c6cebd31c1');
        $Asverstrooiing = new Offer();
        $Asverstrooiing->setName('Asverstrooiing');
        $Asverstrooiing->setDescription('De toepassing van asverstrooiing tijdens een begrafenis');
        $Asverstrooiing->setPrice('50.00');
        $Asverstrooiing->setPriceCurrency('EUR');
        $manager->persist($Asverstrooiing);
        $Asverstrooiing->setId($id);
        $manager->persist($Asverstrooiing);
        $manager->flush();
        $Asverstrooiing = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Bijzetting Asbus
        $id = Uuid::fromString('ccaae856-1060-4d25-8537-b4ac11fd06c3');
        $BijzettingAsbus = new Offer();
        $BijzettingAsbus->setName('Bijzetting Asbus');
        $BijzettingAsbus->setDescription('De toepassing van een bijzetting asbus tijdens een begrafenis');
        $BijzettingAsbus->setPrice('50.00');
        $BijzettingAsbus->setPriceCurrency('EUR');
        $manager->persist($BijzettingAsbus);
        $BijzettingAsbus->setId($id);
        $manager->persist($BijzettingAsbus);
        $manager->flush();
        $BijzettingAsbus = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);


        // Products
        // BijzettingsartikelenProduct
        $id = Uuid::fromString('1b775822-7a8d-4848-a455-408a0365a9bf');
        $BijzettingsartikelenProduct = new Product();
        $BijzettingsartikelenProduct->setSku('69666-2020');
        $BijzettingsartikelenProduct->setName('Bijzettingsartikelen Product');
        $BijzettingsartikelenProduct->setDescription('Een Product voor Bijzettingsartikelen');
        $BijzettingsartikelenProduct->setLogo('https://www.my-organization.com/BijzettingsartikelenProductlogo.png');
        $BijzettingsartikelenProduct->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $BijzettingsartikelenProduct->setSourceOrganization('002851234');
        $BijzettingsartikelenProduct->setPrice('1.00');
        $BijzettingsartikelenProduct->setPriceCurrency('EUR');
        $BijzettingsartikelenProduct->setTaxPercentage('9');
        $BijzettingsartikelenProduct->setType('simple');
        $BijzettingsartikelenProduct->setRequiresAppointment('false');
        $BijzettingsartikelenProduct->setAudience('string');
        $BijzettingsartikelenProduct->setDuration('PT10M');
        $BijzettingsartikelenProduct->setOffers([$BijzettingAsbus,$Asverstrooiing]);
        $manager->persist($BijzettingsartikelenProduct);
        $BijzettingsartikelenProduct->setId($id);
        $manager->persist($BijzettingsartikelenProduct);
        $manager->flush();
        $BijzettingsartikelenProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // DiversenProduct
        $id = Uuid::fromString('29c81fb5-3df5-48a3-80a2-e52480983e56');
        $DiversenProduct = new Product();
        $DiversenProduct->setSku('69667-2020');
        $DiversenProduct->setName('Diversen Product');
        $DiversenProduct->setDescription('Een Product voor Diversen');
        $DiversenProduct->setLogo('https://www.my-organization.com/DiversenProductlogo.png');
        $DiversenProduct->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $DiversenProduct->setSourceOrganization('002851234');
        $DiversenProduct->setPrice('1.00');
        $DiversenProduct->setPriceCurrency('EUR');
        $DiversenProduct->setTaxPercentage('9');
        $DiversenProduct->setType('simple');
        $DiversenProduct->setRequiresAppointment('false');
        $DiversenProduct->setAudience('string');
        $DiversenProduct->setDuration('PT10M');
        $DiversenProduct->setOffers([$GebruikOrgel,$GebruikKoffiekamer,$GebruikCDSpeler]);
        $manager->persist($DiversenProduct);
        $DiversenProduct->setId($id);
        $manager->persist($DiversenProduct);
        $manager->flush();
        $DiversenProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);


        // Groups
        // Bijzettingsartikelen
        $id = Uuid::fromString('9f9a78cb-f708-447f-8795-23f6cf13c39d');
        $Bijzettingsartikelen = new Group();
        $Bijzettingsartikelen->setIcon('My Icon');
        $Bijzettingsartikelen->setName('Bijzettingsartikelen');
        $Bijzettingsartikelen->setDescription('Een groep voor Bijzettingsartikelen');
        $Bijzettingsartikelen->setLogo('https://www.my-organization.com/Bijzettingslogo.png');
        $Bijzettingsartikelen->setSourceOrganization('002851234');
        $Bijzettingsartikelen->setProducts($BijzettingsartikelenProduct);
        $manager->persist($Bijzettingsartikelen);
        $Bijzettingsartikelen->setId($id);
        $manager->persist($Bijzettingsartikelen);
        $manager->flush();
        $Bijzettingsartikelen = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        // Diversen
        $id = Uuid::fromString('b939de43-9c04-4d5e-81e8-2f4d5054fe83');
        $Diversen = new Group();
        $Diversen->setIcon('My Icon');
        $Diversen->setName('Diversen');
        $Diversen->setDescription('Een groep voor Diversen');
        $Diversen->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $Diversen->setSourceOrganization('002851234');
        $Diversen->setProducts($DiversenProduct);
        $manager->persist($Diversen);
        $Diversen->setId($id);
        $manager->persist($Diversen);
        $manager->flush();
        $Diversen = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);


        $manager->flush();
    }
}
