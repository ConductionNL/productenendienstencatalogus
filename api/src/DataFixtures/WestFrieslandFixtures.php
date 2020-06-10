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

        // Offers Cemetery 1, Wognum Kreekland
        // Gebruik Orgel
        $id = Uuid::fromString('f791ae50-c471-40e9-8ac9-53975c89b328');
        $WognumKreeklandGebruikOrgel = new Offer();
        $WognumKreeklandGebruikOrgel->setName('Gebruik Orgel');
        $WognumKreeklandGebruikOrgel->setDescription('Gebruik van een orgel tijdens een begrafenis');
        $WognumKreeklandGebruikOrgel->setPrice('100.00');
        $WognumKreeklandGebruikOrgel->setPriceCurrency('EUR');
        $manager->persist($WognumKreeklandGebruikOrgel);
        $WognumKreeklandGebruikOrgel->setId($id);
        $manager->persist($WognumKreeklandGebruikOrgel);
        $manager->flush();
        $WognumKreeklandGebruikOrgel = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik Koffiekamer
        $id = Uuid::fromString('576550f6-aca2-42e0-a994-7625f427d0e1');
        $WognumKreeklandGebruikKoffiekamer = new Offer();
        $WognumKreeklandGebruikKoffiekamer->setName('Gebruik Koffiekamer');
        $WognumKreeklandGebruikKoffiekamer->setDescription('Gebruik van een koffiekamer tijdens een begrafenis');
        $WognumKreeklandGebruikKoffiekamer->setPrice('45.00');
        $WognumKreeklandGebruikKoffiekamer->setPriceCurrency('EUR');
        $manager->persist($WognumKreeklandGebruikKoffiekamer);
        $WognumKreeklandGebruikKoffiekamer->setId($id);
        $manager->persist($WognumKreeklandGebruikKoffiekamer);
        $manager->flush();
        $WognumKreeklandGebruikKoffiekamer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik CD speler
        $id = Uuid::fromString('3a7f1f81-94d3-49f6-86d3-3d1479277632');
        $WognumKreeklandGebruikCDSpeler = new Offer();
        $WognumKreeklandGebruikCDSpeler->setName('Gebruik CD speler');
        $WognumKreeklandGebruikCDSpeler->setDescription('Gebruik van een CD speler tijdens een begrafenis');
        $WognumKreeklandGebruikCDSpeler->setPrice('40.00');
        $WognumKreeklandGebruikCDSpeler->setPriceCurrency('EUR');
        $manager->persist($WognumKreeklandGebruikCDSpeler);
        $WognumKreeklandGebruikCDSpeler->setId($id);
        $manager->persist($WognumKreeklandGebruikCDSpeler);
        $manager->flush();
        $WognumKreeklandGebruikCDSpeler = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Bijzetting Urn
        $id = Uuid::fromString('b385925a-0b44-45f1-9ac2-930329b00916');
        $WognumKreeklandBijzettingUrn = new Offer();
        $WognumKreeklandBijzettingUrn->setName('Bijzetting Urn');
        $WognumKreeklandBijzettingUrn->setDescription('De toepassing van een bijzetting urn tijdens een begrafenis');
        $WognumKreeklandBijzettingUrn->setPrice('50.00');
        $WognumKreeklandBijzettingUrn->setPriceCurrency('EUR');
        $manager->persist($WognumKreeklandBijzettingUrn);
        $WognumKreeklandBijzettingUrn->setId($id);
        $manager->persist($WognumKreeklandBijzettingUrn);
        $manager->flush();
        $WognumKreeklandBijzettingUrn = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Bijzetting Asbus
        $id = Uuid::fromString('ccaae856-1060-4d25-8537-b4ac11fd06c3');
        $WognumKreeklandBijzettingAsbus = new Offer();
        $WognumKreeklandBijzettingAsbus->setName('Bijzetting Asbus');
        $WognumKreeklandBijzettingAsbus->setDescription('De toepassing van een bijzetting asbus tijdens een begrafenis');
        $WognumKreeklandBijzettingAsbus->setPrice('50.00');
        $WognumKreeklandBijzettingAsbus->setPriceCurrency('EUR');
        $manager->persist($WognumKreeklandBijzettingAsbus);
        $WognumKreeklandBijzettingAsbus->setId($id);
        $manager->persist($WognumKreeklandBijzettingAsbus);
        $manager->flush();
        $WognumKreeklandBijzettingAsbus = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);


        // Products Cemetery 1, Wognum Kreekland
        // BijzettingsartikelenProduct
        $id = Uuid::fromString('1b775822-7a8d-4848-a455-408a0365a9bf');
        $WognumKreeklandBijzettingsartikelenProduct = new Product();
        $WognumKreeklandBijzettingsartikelenProduct->setSku('69666-2020');
        $WognumKreeklandBijzettingsartikelenProduct->setName('Bijzettingsartikelen Product');
        $WognumKreeklandBijzettingsartikelenProduct->setDescription('Een Product voor Bijzettingsartikelen');
        $WognumKreeklandBijzettingsartikelenProduct->setLogo('https://www.my-organization.com/BijzettingsartikelenProductlogo.png');
        $WognumKreeklandBijzettingsartikelenProduct->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $WognumKreeklandBijzettingsartikelenProduct->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
        $WognumKreeklandBijzettingsartikelenProduct->setPrice('1.00');
        $WognumKreeklandBijzettingsartikelenProduct->setPriceCurrency('EUR');
        $WognumKreeklandBijzettingsartikelenProduct->setTaxPercentage('9');
        $WognumKreeklandBijzettingsartikelenProduct->setType('simple');
        $WognumKreeklandBijzettingsartikelenProduct->setRequiresAppointment('false');
        $WognumKreeklandBijzettingsartikelenProduct->setAudience('string');
        $WognumKreeklandBijzettingsartikelenProduct->setDuration('PT10M');
        $WognumKreeklandBijzettingsartikelenProduct->setOffers([$WognumKreeklandBijzettingAsbus,$WognumKreeklandBijzettingUrn]);
        $manager->persist($WognumKreeklandBijzettingsartikelenProduct);
        $WognumKreeklandBijzettingsartikelenProduct->setId($id);
        $manager->persist($WognumKreeklandBijzettingsartikelenProduct);
        $manager->flush();
        $WognumKreeklandBijzettingsartikelenProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // DiversenProduct
        $id = Uuid::fromString('29c81fb5-3df5-48a3-80a2-e52480983e56');
        $WognumKreeklandDiversenProduct = new Product();
        $WognumKreeklandDiversenProduct->setSku('69667-2020');
        $WognumKreeklandDiversenProduct->setName('Diversen Product');
        $WognumKreeklandDiversenProduct->setDescription('Een Product voor Diversen');
        $WognumKreeklandDiversenProduct->setLogo('https://www.my-organization.com/DiversenProductlogo.png');
        $WognumKreeklandDiversenProduct->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $WognumKreeklandDiversenProduct->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
        $WognumKreeklandDiversenProduct->setPrice('1.00');
        $WognumKreeklandDiversenProduct->setPriceCurrency('EUR');
        $WognumKreeklandDiversenProduct->setTaxPercentage('9');
        $WognumKreeklandDiversenProduct->setType('simple');
        $WognumKreeklandDiversenProduct->setRequiresAppointment('false');
        $WognumKreeklandDiversenProduct->setAudience('string');
        $WognumKreeklandDiversenProduct->setDuration('PT10M');
        $WognumKreeklandDiversenProduct->setOffers([$WognumKreeklandGebruikOrgel,$WognumKreeklandGebruikKoffiekamer,$WognumKreeklandGebruikCDSpeler]);
        $manager->persist($WognumKreeklandDiversenProduct);
        $WognumKreeklandDiversenProduct->setId($id);
        $manager->persist($WognumKreeklandDiversenProduct);
        $manager->flush();
        $WognumKreeklandDiversenProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);


        // Groups Cemetery 1, Wognum Kreekland
        // Bijzettingsartikelen
        $id = Uuid::fromString('9f9a78cb-f708-447f-8795-23f6cf13c39d');
        $WognumKreeklandBijzettingsartikelen = new Group();
        $WognumKreeklandBijzettingsartikelen->setIcon('My Icon');
        $WognumKreeklandBijzettingsartikelen->setName('Bijzettingsartikelen');
        $WognumKreeklandBijzettingsartikelen->setDescription('Een groep voor Bijzettingsartikelen');
        $WognumKreeklandBijzettingsartikelen->setLogo('https://www.my-organization.com/Bijzettingslogo.png');
        $WognumKreeklandBijzettingsartikelen->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
        $WognumKreeklandBijzettingsartikelen->setProducts($WognumKreeklandBijzettingsartikelenProduct);
        $manager->persist($WognumKreeklandBijzettingsartikelen);
        $WognumKreeklandBijzettingsartikelen->setId($id);
        $manager->persist($WognumKreeklandBijzettingsartikelen);
        $manager->flush();
        $WognumKreeklandBijzettingsartikelen = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        // Diversen
        $id = Uuid::fromString('b939de43-9c04-4d5e-81e8-2f4d5054fe83');
        $WognumKreeklandDiversen = new Group();
        $WognumKreeklandDiversen->setIcon('My Icon');
        $WognumKreeklandDiversen->setName('Diversen');
        $WognumKreeklandDiversen->setDescription('Een groep voor Diversen');
        $WognumKreeklandDiversen->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $WognumKreeklandDiversen->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/2556c084-0687-4ca1-b098-e4f0a7292ae8');
        $WognumKreeklandDiversen->setProducts($WognumKreeklandDiversenProduct);
        $manager->persist($WognumKreeklandDiversen);
        $WognumKreeklandDiversen->setId($id);
        $manager->persist($WognumKreeklandDiversen);
        $manager->flush();
        $WognumKreeklandDiversen = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        // Offers Cemetery 2, Opperdoes Oud
        // Gebruik Orgel
        $id = Uuid::fromString('72183cad-0023-44f5-b743-d0c7eb8f3745');
        $OpperdoesOudGebruikOrgel = new Offer();
        $OpperdoesOudGebruikOrgel->setName('Gebruik Orgel');
        $OpperdoesOudGebruikOrgel->setDescription('Gebruik van een orgel tijdens een begrafenis');
        $OpperdoesOudGebruikOrgel->setPrice('100.00');
        $OpperdoesOudGebruikOrgel->setPriceCurrency('EUR');
        $manager->persist($OpperdoesOudGebruikOrgel);
        $OpperdoesOudGebruikOrgel->setId($id);
        $manager->persist($OpperdoesOudGebruikOrgel);
        $manager->flush();
        $OpperdoesOudGebruikOrgel = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik Koffiekamer
        $id = Uuid::fromString('940a4bc2-f7c1-4d39-9764-32d36aa0c26a');
        $OpperdoesOudGebruikKoffiekamer = new Offer();
        $OpperdoesOudGebruikKoffiekamer->setName('Gebruik Koffiekamer');
        $OpperdoesOudGebruikKoffiekamer->setDescription('Gebruik van een koffiekamer tijdens een begrafenis');
        $OpperdoesOudGebruikKoffiekamer->setPrice('45.00');
        $OpperdoesOudGebruikKoffiekamer->setPriceCurrency('EUR');
        $manager->persist($OpperdoesOudGebruikKoffiekamer);
        $OpperdoesOudGebruikKoffiekamer->setId($id);
        $manager->persist($OpperdoesOudGebruikKoffiekamer);
        $manager->flush();
        $OpperdoesOudGebruikKoffiekamer = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Gebruik CD speler
        $id = Uuid::fromString('61ced7cd-1b30-444b-b46d-d1fa49b05ab1');
        $OpperdoesOudGebruikCDSpeler = new Offer();
        $OpperdoesOudGebruikCDSpeler->setName('Gebruik CD speler');
        $OpperdoesOudGebruikCDSpeler->setDescription('Gebruik van een CD speler tijdens een begrafenis');
        $OpperdoesOudGebruikCDSpeler->setPrice('40.00');
        $OpperdoesOudGebruikCDSpeler->setPriceCurrency('EUR');
        $manager->persist($OpperdoesOudGebruikCDSpeler);
        $OpperdoesOudGebruikCDSpeler->setId($id);
        $manager->persist($OpperdoesOudGebruikCDSpeler);
        $manager->flush();
        $OpperdoesOudGebruikCDSpeler = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);

        // Asverstrooiing
        $id = Uuid::fromString('5bbe119d-718c-4b04-82df-63495854b4f4');
        $OpperdoesOudAsverstrooiing = new Offer();
        $OpperdoesOudAsverstrooiing->setName('Asverstrooiing');
        $OpperdoesOudAsverstrooiing->setDescription('De toepassing van asverstrooiing tijdens een begrafenis');
        $OpperdoesOudAsverstrooiing->setPrice('50.00');
        $OpperdoesOudAsverstrooiing->setPriceCurrency('EUR');
        $manager->persist($OpperdoesOudAsverstrooiing);
        $OpperdoesOudAsverstrooiing->setId($id);
        $manager->persist($OpperdoesOudAsverstrooiing);
        $manager->flush();
        $OpperdoesOudAsverstrooiing = $manager->getRepository('App:Offer')->findOneBy(['id'=> $id]);


        // Products Cemetery 2, Opperdoes Oud
        // AsartikelenProduct
        $id = Uuid::fromString('aa995cc0-d3fd-4869-9d04-07be32ab172f');
        $OpperdoesOudAsartikelenProduct = new Product();
        $OpperdoesOudAsartikelenProduct->setSku('69666-2020');
        $OpperdoesOudAsartikelenProduct->setName('As artikelen Product');
        $OpperdoesOudAsartikelenProduct->setDescription('Een Product voor as artikelen');
        $OpperdoesOudAsartikelenProduct->setLogo('https://www.my-organization.com/BijzettingsartikelenProductlogo.png');
        $OpperdoesOudAsartikelenProduct->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $OpperdoesOudAsartikelenProduct->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $OpperdoesOudAsartikelenProduct->setPrice('1.00');
        $OpperdoesOudAsartikelenProduct->setPriceCurrency('EUR');
        $OpperdoesOudAsartikelenProduct->setTaxPercentage('9');
        $OpperdoesOudAsartikelenProduct->setType('simple');
        $OpperdoesOudAsartikelenProduct->setRequiresAppointment('false');
        $OpperdoesOudAsartikelenProduct->setAudience('string');
        $OpperdoesOudAsartikelenProduct->setDuration('PT10M');
        $OpperdoesOudAsartikelenProduct->setOffers($OpperdoesOudAsverstrooiing);
        $manager->persist($OpperdoesOudAsartikelenProduct);
        $OpperdoesOudAsartikelenProduct->setId($id);
        $manager->persist($OpperdoesOudAsartikelenProduct);
        $manager->flush();
        $OpperdoesOudAsartikelenProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        // DiversenProduct
        $id = Uuid::fromString('32ccfa18-4dbc-4895-8d5a-b25a982c28e3');
        $OpperdoesOudDiversenProduct = new Product();
        $OpperdoesOudDiversenProduct->setSku('69667-2020');
        $OpperdoesOudDiversenProduct->setName('Diversen Product');
        $OpperdoesOudDiversenProduct->setDescription('Een product voor Diversen');
        $OpperdoesOudDiversenProduct->setLogo('https://www.my-organization.com/DiversenProductlogo.png');
        $OpperdoesOudDiversenProduct->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $OpperdoesOudDiversenProduct->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $OpperdoesOudDiversenProduct->setPrice('1.00');
        $OpperdoesOudDiversenProduct->setPriceCurrency('EUR');
        $OpperdoesOudDiversenProduct->setTaxPercentage('9');
        $OpperdoesOudDiversenProduct->setType('simple');
        $OpperdoesOudDiversenProduct->setRequiresAppointment('false');
        $OpperdoesOudDiversenProduct->setAudience('string');
        $OpperdoesOudDiversenProduct->setDuration('PT10M');
        $OpperdoesOudDiversenProduct->setOffers([$OpperdoesOudGebruikOrgel,$OpperdoesOudGebruikKoffiekamer,$OpperdoesOudGebruikCDSpeler]);
        $manager->persist($OpperdoesOudDiversenProduct);
        $OpperdoesOudDiversenProduct->setId($id);
        $manager->persist($OpperdoesOudDiversenProduct);
        $manager->flush();
        $OpperdoesOudDiversenProduct = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);


        // Groups Cemetery 2, Opperdoes Oud
        // Asartikelen
        $id = Uuid::fromString('bae59b6b-4866-4476-ad87-6246f488c1b4');
        $OpperdoesOudAsartikelen = new Group();
        $OpperdoesOudAsartikelen->setIcon('My Icon');
        $OpperdoesOudAsartikelen->setName('As artikelen');
        $OpperdoesOudAsartikelen->setDescription('Een groep voor as artikelen');
        $OpperdoesOudAsartikelen->setLogo('https://www.my-organization.com/Aslogo.png');
        $OpperdoesOudAsartikelen->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $OpperdoesOudAsartikelen->setProducts($OpperdoesOudAsartikelenProduct);
        $manager->persist($OpperdoesOudAsartikelen);
        $OpperdoesOudAsartikelen->setId($id);
        $manager->persist($OpperdoesOudAsartikelen);
        $manager->flush();
        $OpperdoesOudAsartikelen = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);

        // Diversen
        $id = Uuid::fromString('fa842893-8c8b-4acf-b1eb-284e3ea34083');
        $OpperdoesOudDiversen = new Group();
        $OpperdoesOudDiversen->setIcon('My Icon');
        $OpperdoesOudDiversen->setName('Diversen');
        $OpperdoesOudDiversen->setDescription('Een groep voor Diversen');
        $OpperdoesOudDiversen->setLogo('https://www.my-organization.com/Diversenlogo.png');
        $OpperdoesOudDiversen->setSourceOrganization('grc.dev.westfriesland.commonground.nu/cemeteries/074defab-e2eb-4eeb-a22f-caf082502db6');
        $OpperdoesOudDiversen->setProducts($OpperdoesOudDiversenProduct);
        $manager->persist($OpperdoesOudDiversen);
        $OpperdoesOudDiversen->setId($id);
        $manager->persist($OpperdoesOudDiversen);
        $manager->flush();
        $OpperdoesOudDiversen = $manager->getRepository('App:Group')->findOneBy(['id'=> $id]);
        
        $manager->flush();
    }
}
