<?php

namespace App\DataFixtures;

use App\Entity\Catalogue;
use App\Entity\Group;
use App\Entity\Offer;
use App\Entity\Product;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LarpingFixtures extends Fixture
{
    private $commonGroundService;
    private $params;

    public function __construct(CommonGroundService $commonGroundService, ParameterBagInterface $params)
    {
        $this->commonGroundService = $commonGroundService;
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        if (
            // If build all fixtures is true we build all the fixtures
            !$this->params->get('app_build_all_fixtures') &&
            // Specific domain names
            $this->params->get('app_domain') != 'larping.eu' && strpos($this->params->get('app_domain'), 'larping.eu') == false
        ) {
            return false;
        }

//        // Catalogi
//        $catalogue = new Catalogue();
//        $catalogue->setName('VortexAdventures2020');
//        $catalogue->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$catalogue->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $manager->persist($catalogue);
//
//        // Productgroep
//        $groupSubs = new Group();
//        $groupSubs->setName('Lidmaatschap');
//        $groupSubs->setDescription('Alle producten met betrekking tot lidmaatschap');
//        $groupSubs->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$groupSubs->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $groupSubs->setCatalogue($catalogue);
//        $manager->persist($groupSubs);
//
//        // Productgroep
//        $groupEvent = new Group();
//        $groupEvent->setName('Evenementen');
//        $groupEvent->setDescription('Alle producten met betrekking tot events');
//        $groupEvent->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$groupEvent->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $groupEvent->setCatalogue($catalogue);
//        $manager->persist($groupEvent);
//
//        // Product
//        $productELM2 = new Product();
//        $productELM2->setName('Evenementlidmaatschap Moots 2');
//        $productELM2->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$productELM2->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $productELM2->setDescription('Met dit product word je lid van Vortex Adventures voor alleen het Moots 2 2020 event');
//        $productELM2->setType('subscription');
//        $productELM2->setSku('Eventlid-moots2-2020');
//        $productELM2->setCatalogue($catalogue);
//        $productELM2->addGroup($groupSubs);
//        $productELM2->setRequiresAppointment(false);
//        $manager->persist($productELM2);
//
//        // Offer
//        $offerELM2 = new Offer();
//        $offerELM2->setName('Offer Eventlid Moots 2 2020');
//        $offerELM2->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerELM2->setDescription('Evenementlidmaatschap Moots 2 2020');
//        $offerELM2->setPrice(500);
//        $offerELM2->setPriceCurrency('EUR');
//        $offerELM2->setAudience('internal');
//        $offerELM2->addProduct($productELM2);
//        $manager->persist($offerELM2);

        // Product
        $id = Uuid::fromString('c3ed3d66-920b-411f-8b37-36fcdf90245f');
        $productlidmaatschap = new Product();
        $productlidmaatschap->setName('Evenementlidmaatschap');
        $productlidmaatschap->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'51eb5628-3b37-497b-a57f-6b039ec776e5']));
        //$productELM1->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
        $productlidmaatschap->setDescription('Met dit product word je lid van Vortex Adventures voor alleen het Moots 1 2020 event');
        $productlidmaatschap->setType('subscription');
        $productlidmaatschap->setSku('Eventlid-moots1-2020');
        $productlidmaatschap->setRequiresAppointment(false);
        $manager->persist($productlidmaatschap);
        $productlidmaatschap->setId($id);
        $manager->persist($productlidmaatschap);
        $manager->flush();
        $productlidmaatschap = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
//        $productlidmaatschap->setCatalogue($catalogue);
//        $productlidmaatschap->addGroup($groupSubs);
        $manager->persist($productlidmaatschap);
        $manager->flush();

        // Offer
        $offerELM1 = new Offer();
        $offerELM1->setName('Evenementlidmaatschap jaarlijks');
        $offerELM1->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'51eb5628-3b37-497b-a57f-6b039ec776e5']));
        $offerELM1->setDescription('Evenementlidmaatschap Moots 1 2020');
        $offerELM1->setPrice(500);
        $offerELM1->setPriceCurrency('EUR');
        $offerELM1->setAudience('internal');
        $offerELM1->setRecurrence('P1Y');
        $offerELM1->setNotice('P1M');
        $offerELM1->addProduct($productlidmaatschap);
        $manager->persist($offerELM1);

        // Product
        $id = Uuid::fromString('893e5c2f-4c89-438c-aa62-c0bd4636e858');
        $productELM1 = new Product();
        $productELM1->setName('Ticket Moots 1');
        $productELM1->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'51eb5628-3b37-497b-a57f-6b039ec776e5']));
        //$productELM1->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
        $productELM1->setDescription('Met dit product heb je entree van Vortex Adventures tot het Moots 1 2020 event');
        $productELM1->setType('ticket');
        $productELM1->setSku('Eventlid-moots1-2020');
        $productELM1->setRequiresAppointment(false);
        $productELM1->setEvent($this->commonGroundService->cleanUrl(['component' => 'arc', 'type' => 'events', 'id' => 'ae31eadb-0635-4190-b1c0-ac783afbc25c']));
        $manager->persist($productELM1);
        $productELM1->setId($id);
        $manager->persist($productELM1);
        $manager->flush();
        $productELM1 = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
//        $productELM1->setCatalogue($catalogue);
//        $productELM1->addGroup($groupSubs);
        $productELM1->addPrerequisiteProduct($productlidmaatschap);
        $manager->persist($productELM1);
        $manager->flush();

        // Offer
        $offerELM1 = new Offer();
        $offerELM1->setName('Ticket Moots 1 2020');
        $offerELM1->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'51eb5628-3b37-497b-a57f-6b039ec776e5']));
        $offerELM1->setDescription('Ticket Moots 1');
        $offerELM1->setPrice(100);
        $offerELM1->setPriceCurrency('EUR');
        $offerELM1->setAudience('personal');
        $offerELM1->setOptions([
            [
                'name'  => 'Tent 4 persoons',
                'price' => -50,
            ],
        ]);
        $offerELM1->addProduct($productELM1);
        $manager->persist($offerELM1);
        $manager->flush();

        // Product
        $id = Uuid::fromString('364523a6-458f-45f3-a9de-7d10b9e928a7');
        $productELM1 = new Product();
        $productELM1->setName('Test Subscription');
        $productELM1->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'51eb5628-3b37-497b-a57f-6b039ec776e5']));
        //$productELM1->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
        $productELM1->setDescription('Met dit product heb je een test subscription van Vortex Adventures');
        $productELM1->setType('subscription');
        $productELM1->setSku('Eventlid-moots1-2020');
        $productELM1->setRequiresAppointment(false);
        $productELM1->setEvent($this->commonGroundService->cleanUrl(['component' => 'arc', 'type' => 'events', 'id' => '81052670-582e-401d-ad2b-77ac60cf9d73']));
        $manager->persist($productELM1);
        $productELM1->setId($id);
        $manager->persist($productELM1);
        $manager->flush();
        $productELM1 = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
//        $productELM1->setCatalogue($catalogue);
//        $productELM1->addGroup($groupSubs);
        $productELM1->addPrerequisiteProduct($productlidmaatschap);
        $manager->persist($productELM1);
        $manager->flush();

        // Offer
        $offerELM1 = new Offer();
        $offerELM1->setName('Test Subscription');
        $offerELM1->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'51eb5628-3b37-497b-a57f-6b039ec776e5']));
        $offerELM1->setDescription('Test Subscription');
        $offerELM1->setPrice(30);
        $offerELM1->setPriceCurrency('EUR');
        $offerELM1->setAudience('personal');
        $offerELM1->setOptions([
            [
                'name'  => 'Price reduction',
                'price' => -4,
            ],
        ]);
        $offerELM1->setRecurrence('P1M');
        $offerELM1->setNotice('P1M');
        $offerELM1->addProduct($productELM1);
        $manager->persist($offerELM1);
        $manager->flush();
//
//        // Product
//        $productELS = new Product();
//        $productELS->setName('Evenementlidmaatschap Summoning 2020');
//        $productELS->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$productELS->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $productELS->setDescription('Met dit product word je lid van Vortex Adventures voor alleen het Summoning 2020 event');
//        $productELS->setType('subscription');
//        $productELS->setSku('Eventlid-Summoning-2020');
//        $productELS->setCatalogue($catalogue);
//        $productELS->addGroup($groupSubs);
//        $productELS->setRequiresAppointment(false);
//        $manager->persist($productELS);
//
//        // Offer
//        $offerELS = new Offer();
//        $offerELS->setName('Offer Eventlid summoning 2020');
//        $offerELS->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerELS->setDescription('Evenementlidmaatschap summoning 2020');
//        $offerELS->setPrice(500);
//        $offerELS->setPriceCurrency('EUR');
//        $offerELS->setAudience('internal');
//        $offerELS->addProduct($productELS);
//        $manager->persist($offerELS);
//
//        // Product
//        $productJP2020 = new Product();
//        $productJP2020->setName('Jaarpakket 2020');
//        $productJP2020->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$productJP2020->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $productJP2020->setDescription('Met dit product neem je deel aan Moots 1, Summoning en Moots 2 events van Vortex Adventures');
//        $productJP2020->setType('set');
//        $productJP2020->setSku('jaarpakket-2020');
//        $productJP2020->setAudience('public');
//        $productJP2020->setCatalogue($catalogue);
//        $productJP2020->addGroup($groupEvent);
//        $productJP2020->setRequiresAppointment(false);
//        $manager->persist($productJP2020);
//
//        // Offer
//        $offerJP2020Crew = new Offer();
//        $offerJP2020Crew->setName('Offer Jaarpakket 2020 Crew');
//        $offerJP2020Crew->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerJP2020Crew->setDescription('Jaarpakket 2020 crew');
//        $offerJP2020Crew->setPrice(12500);
//        $offerJP2020Crew->setPriceCurrency('EUR');
//        $offerJP2020Crew->setAudience('public');
//        $offerJP2020Crew->addProduct($productJP2020);
//        $manager->persist($offerJP2020Crew);
//
//        // Offer
//        $offerJP2020Speler = new Offer();
//        $offerJP2020Speler->setName('Offer Jaarpakket 2020 Speler');
//        $offerJP2020Speler->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerJP2020Speler->setDescription('Jaarpakket 2020 Speler');
//        $offerJP2020Speler->setPrice(18000);
//        $offerJP2020Speler->setPriceCurrency('EUR');
//        $offerJP2020Speler->setAudience('public');
//        $offerJP2020Speler->addProduct($productJP2020);
//        $manager->persist($offerJP2020Speler);
//
//        // Product
//        $productJL = new Product();
//        $productJL->setName('Jaarlidmaatschap 2020');
//        $productJL->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$productJL->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $productJL->setDescription('Met dit product word je lid van Vortex Adventures voor 2020');
//        $productJL->setType('subscription');
//        $productJL->setSku('Jaarlid-2020');
//        $productJL->setAudience('public');
//        $productJL->setCatalogue($catalogue);
//        $productJL->addGroup($groupSubs);
////        $productJL->addSet($productJP2020);
//        $productJL->setRequiresAppointment(false);
//        $manager->persist($productJL);
//
//        // Offer
//        $offerJL = new Offer();
//        $offerJL->setName('Offer Jaarlid 2020');
//        $offerJL->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerJL->setDescription('Vereniginglidmaatschap 2020');
//        $offerJL->setPrice(1500);
//        $offerJL->setPriceCurrency('EUR');
//        $offerJL->setAudience('public');
//        $offerJL->addProduct($productJL);
//        $manager->persist($offerJL);
//
//        // Product
//        $productM12020 = new Product();
//        $productM12020->setName('Deelname Moots 1');
//        $productM12020->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$productM12020->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $productM12020->setDescription('Met dit product neem je deel aan het Moots 1 2020 event van Vortex Adventures');
//        $productM12020->setType('ticket');
//        $productM12020->setSku('Moots1-2020');
//        $productM12020->setCatalogue($catalogue);
//        $productM12020->addGroup($groupEvent);
////        $productM12020->addSet($productJP2020);
//        $productM12020->setRequiresAppointment(false);
//        $manager->persist($productM12020);
//
//        // Offer
//        $offerPM1S = new Offer();
//        $offerPM1S->setName('Offer Poortinschrijving Moots 1 2020 Speler');
//        $offerPM1S->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM1S->setDescription('Poortinschrijving Moots 1 2020 Speler');
//        $offerPM1S->setPrice(6500);
//        $offerPM1S->setPriceCurrency('EUR');
//        $offerPM1S->setAudience('internal');
//        $offerPM1S->addProduct($productM12020);
//        $manager->persist($offerPM1S);
//
//        // Offer
//        $offerPM1F = new Offer();
//        $offerPM1F->setName('Offer Poortinschrijving Moots 1 2020 Figurant');
//        $offerPM1F->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM1F->setDescription('Poortinschrijving Moots 1 2020 Figurant');
//        $offerPM1F->setPrice(0);
//        $offerPM1F->setPriceCurrency('EUR');
//        $offerPM1F->setAudience('internal');
//        $offerPM1F->addProduct($productM12020);
//        $manager->persist($offerPM1F);
//
//        // Offer
//        $offerPM1C = new Offer();
//        $offerPM1C->setName('Offer Poortinschrijving Moots 1 2020 Crew');
//        $offerPM1C->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM1C->setDescription('Poortinschrijving Moots 1 2020 Crew');
//        $offerPM1C->setPrice(3500);
//        $offerPM1C->setPriceCurrency('EUR');
//        $offerPM1C->setAudience('internal');
//        $offerPM1C->addProduct($productM12020);
//        $manager->persist($offerPM1C);
//
//        // Offer
//        $offerPM11215 = new Offer();
//        $offerPM11215->setName('Offer Poortinschrijving Moots 1 2020 12-15 jaar');
//        $offerPM11215->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM11215->setDescription('Poortinschrijving Moots 1 2020 12-15 jaar');
//        $offerPM11215->setPrice(3250);
//        $offerPM11215->setPriceCurrency('EUR');
//        $offerPM11215->setAudience('internal');
//        $offerPM11215->addProduct($productM12020);
//        $manager->persist($offerPM11215);
//
//        // Offer
//        $offerPM112 = new Offer();
//        $offerPM112->setName('Offer Poortinschrijving Moots 1 2020 >12');
//        $offerPM112->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM112->setDescription('Poortinschrijving Moots 1 2020 >12');
//        $offerPM112->setPrice(1500);
//        $offerPM112->setPriceCurrency('EUR');
//        $offerPM112->setAudience('internal');
//        $offerPM112->addProduct($productM12020);
//        $manager->persist($offerPM112);
//
//        // Offer
//        $offerVM1S = new Offer();
//        $offerVM1S->setName('Offer Voorinschrijving Moots 1 2020 Speler');
//        $offerVM1S->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM1S->setDescription('Voorinschrijving Moots 1 2020 Speler');
//        $offerVM1S->setPrice(5500);
//        $offerVM1S->setPriceCurrency('EUR');
//        $offerVM1S->setAudience('internal');
//        $offerVM1S->addProduct($productM12020);
//        $manager->persist($offerVM1S);
//
//        // Offer
//        $offerVM1F = new Offer();
//        $offerVM1F->setName('Offer Voorinschrijving Moots 1 2020 Figurant');
//        $offerVM1F->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM1F->setDescription('Voorinschrijving Moots 1 2020 Figurant');
//        $offerVM1F->setPrice(0);
//        $offerVM1F->setPriceCurrency('EUR');
//        $offerVM1F->setAudience('internal');
//        $offerVM1F->addProduct($productM12020);
//        $manager->persist($offerVM1F);
//
//        // Offer
//        $offerVM1C = new Offer();
//        $offerVM1C->setName('Offer Voorinschrijving Moots 1 2020 Crew');
//        $offerVM1C->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM1C->setDescription('Voorinschrijving Moots 1 2020 Crew');
//        $offerVM1C->setPrice(2500);
//        $offerVM1C->setPriceCurrency('EUR');
//        $offerVM1C->setAudience('internal');
//        $offerVM1C->addProduct($productM12020);
//        $manager->persist($offerVM1C);
//
//        // Offer
//        $offerVM11215 = new Offer();
//        $offerVM11215->setName('Offer Voorinschrijving Moots 1 2020 12-15 jaar');
//        $offerVM11215->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM11215->setDescription('Voorinschrijving Moots 1 2020 12-15 jaar');
//        $offerVM11215->setPrice(2750);
//        $offerVM11215->setPriceCurrency('EUR');
//        $offerVM11215->setAudience('internal');
//        $offerVM11215->addProduct($productM12020);
//        $manager->persist($offerVM11215);
//
//        // Offer
//        $offerVM112 = new Offer();
//        $offerVM112->setName('Offer Voorinschrijving Moots 1 2020 >12');
//        $offerVM112->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM112->setDescription('Voorinschrijving Moots 1 2020 >12');
//        $offerVM112->setPrice(1500);
//        $offerVM112->setPriceCurrency('EUR');
//        $offerVM112->setAudience('internal');
//        $offerVM112->addProduct($productM12020);
//        $manager->persist($offerVM112);
//
//        // Offer
//        $offerM1H = new Offer();
//        $offerM1H->setName('Offer handelaar Moots 1 2020');
//        $offerM1H->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerM1H->setDescription('Inschrijving handelaar Moots 1 2020');
//        $offerM1H->setPrice(5000);
//        $offerM1H->setPriceCurrency('EUR');
//        $offerM1H->setAudience('internal');
//        $offerM1H->addProduct($productM12020);
//        $manager->persist($offerM1H);
//
//        // Product
//        $productM22020 = new Product();
//        $productM22020->setName('Deelname Moots 2');
//        $productM22020->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$productM22020->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $productM22020->setDescription('Met dit product neem je deel aan het Moots 2 2020 event van Vortex Adventures');
//        $productM22020->setType('ticket');
//        $productM22020->setSku('Moots2-2020');
//        $productM22020->setCatalogue($catalogue);
//        $productM22020->addGroup($groupEvent);
////        $productM22020->addSet($productJP2020);
//        $productM22020->setRequiresAppointment(false);
//        $manager->persist($productM22020);
//
//        // Offer
//        $offerPM2S = new Offer();
//        $offerPM2S->setName('Offer Poortinschrijving Moots 2 2020 Speler');
//        $offerPM2S->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM2S->setDescription('Poortinschrijving Moots 2 2020 Speler');
//        $offerPM2S->setPrice(6500);
//        $offerPM2S->setPriceCurrency('EUR');
//        $offerPM2S->setAudience('internal');
//        $offerPM2S->addProduct($productM22020);
//        $manager->persist($offerPM2S);
//
//        // Offer
//        $offerPM2F = new Offer();
//        $offerPM2F->setName('Offer Poortinschrijving Moots 2 2020 Figurant');
//        $offerPM2F->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM2F->setDescription('Poortinschrijving Moots 2 2020 Figurant');
//        $offerPM2F->setPrice(0);
//        $offerPM2F->setPriceCurrency('EUR');
//        $offerPM2F->setAudience('internal');
//        $offerPM2F->addProduct($productM22020);
//        $manager->persist($offerPM2F);
//
//        // Offer
//        $offerPM2C = new Offer();
//        $offerPM2C->setName('Offer Poortinschrijving Moots 2 2020 Crew');
//        $offerPM2C->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM2C->setDescription('Poortinschrijving Moots 2 2020 Crew');
//        $offerPM2C->setPrice(3500);
//        $offerPM2C->setPriceCurrency('EUR');
//        $offerPM2C->setAudience('internal');
//        $offerPM2C->addProduct($productM22020);
//        $manager->persist($offerPM2C);
//
//        // Offer
//        $offerPM21215 = new Offer();
//        $offerPM21215->setName('Offer Poortinschrijving Moots 2 2020 12-15 jaar');
//        $offerPM21215->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM21215->setDescription('Poortinschrijving Moots 2 2020 12-15 jaar');
//        $offerPM21215->setPrice(3250);
//        $offerPM21215->setPriceCurrency('EUR');
//        $offerPM21215->setAudience('internal');
//        $offerPM21215->addProduct($productM22020);
//        $manager->persist($offerPM21215);
//
//        // Offer
//        $offerPM212 = new Offer();
//        $offerPM212->setName('Offer Poortinschrijving Moots 2 2020 >12');
//        $offerPM212->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerPM212->setDescription('Poortinschrijving Moots 2 2020 >12');
//        $offerPM212->setPrice(1500);
//        $offerPM212->setPriceCurrency('EUR');
//        $offerPM212->setAudience('internal');
//        $offerPM212->addProduct($productM22020);
//        $manager->persist($offerPM212);
//
//        // Offer
//        $offerVM2S = new Offer();
//        $offerVM2S->setName('Offer Voorinschrijving Moots 2 2020 Speler');
//        $offerVM2S->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM2S->setDescription('Voorinschrijving Moots 2 2020 Speler');
//        $offerVM2S->setPrice(5500);
//        $offerVM2S->setPriceCurrency('EUR');
//        $offerVM2S->setAudience('internal');
//        $offerVM2S->addProduct($productM22020);
//        $manager->persist($offerVM2S);
//
//        // Offer
//        $offerVM2F = new Offer();
//        $offerVM2F->setName('Offer Voorinschrijving Moots 2 2020 Figurant');
//        $offerVM2F->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM2F->setDescription('Voorinschrijving Moots 2 2020 Figurant');
//        $offerVM2F->setPrice(0);
//        $offerVM2F->setPriceCurrency('EUR');
//        $offerVM2F->setAudience('internal');
//        $offerVM2F->addProduct($productM22020);
//        $manager->persist($offerVM2F);
//
//        // Offer
//        $offerVM2C = new Offer();
//        $offerVM2C->setName('Offer Voorinschrijving Moots 2 2020 Crew');
//        $offerVM2C->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM2C->setDescription('Voorinschrijving Moots 2 2020 Crew');
//        $offerVM2C->setPrice(2500);
//        $offerVM2C->setPriceCurrency('EUR');
//        $offerVM2C->setAudience('internal');
//        $offerVM2C->addProduct($productM22020);
//        $manager->persist($offerVM2C);
//
//        // Offer
//        $offerVM21215 = new Offer();
//        $offerVM21215->setName('Offer Voorinschrijving Moots 2 2020 12-15 jaar');
//        $offerVM21215->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM21215->setDescription('Voorinschrijving Moots 2 2020 12-15 jaar');
//        $offerVM21215->setPrice(2750);
//        $offerVM21215->setPriceCurrency('EUR');
//        $offerVM21215->setAudience('internal');
//        $offerVM21215->addProduct($productM22020);
//        $manager->persist($offerVM21215);
//
//        // Offer
//        $offerVM212 = new Offer();
//        $offerVM212->setName('Offer Voorinschrijving Moots 2 2020 >12');
//        $offerVM212->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerVM212->setDescription('Voorinschrijving Moots 2 2020 >12');
//        $offerVM212->setPrice(1500);
//        $offerVM212->setPriceCurrency('EUR');
//        $offerVM212->setAudience('internal');
//        $offerVM212->addProduct($productM22020);
//        $manager->persist($offerVM212);
//
//        // Offer
//        $offerM2H = new Offer();
//        $offerM2H->setName('Offer handelaar Moots 2 2020');
//        $offerM2H->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        $offerM2H->setDescription('Inschrijving handelaar Moots 2 2020');
//        $offerM2H->setPrice(5000);
//        $offerM2H->setPriceCurrency('EUR');
//        $offerM2H->setAudience('internal');
//        $offerM2H->addProduct($productM22020);
//        $manager->persist($offerM2H);
//
//        // Product
//        $productS2020 = new Product();
//        $productS2020->setName('Deelname Summoning 2020');
//        $productS2020->setSourceOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$productS2020->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $productS2020->setDescription('Met dit product neem je deel aan het summoning 2020 event van Vortex Adventures');
//        $productS2020->setType('ticket');
//        $productS2020->setSku('summoning-2020');
//        $productS2020->setCatalogue($catalogue);
//        $productS2020->addGroup($groupEvent);
////        $productS2020->addSet($productJP2020);
//        $productS2020->setRequiresAppointment(false);
//        $manager->persist($productS2020);
//
//        // Offer
//        $offerPSS = new Offer();
//        $offerPSS->setName('Offer Poortinschrijving Summoning 2020 Speler');
//        $offerPSS->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$offerPSS->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerPSS->setDescription('Poortinschrijving Summoning 2020 Speler');
//        $offerPSS->setPrice(6500);
//        $offerPSS->setPriceCurrency('EUR');
//        $offerPSS->setAudience('internal');
//        $offerPSS->addProduct($productS2020);
//        $manager->persist($offerPSS);
//
//        // Offer
//        $offerPSF = new Offer();
//        $offerPSF->setName('Offer Poortinschrijving Summoning 2020 Figurant');
//        $offerPSF->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        // $offerPSF->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerPSF->setDescription('Poortinschrijving Summoning 2020 Figurant');
//        $offerPSF->setPrice(0);
//        $offerPSF->setPriceCurrency('EUR');
//        $offerPSF->setAudience('internal');
//        $offerPSF->addProduct($productS2020);
//        $manager->persist($offerPSF);
//
//        // Offer
//        $offerPSC = new Offer();
//        $offerPSC->setName('Offer Poortinschrijving Summoning 2020 Crew');
//        $offerPSC->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        // $offerPSC->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerPSC->setDescription('Poortinschrijving Summoning 2020 Crew');
//        $offerPSC->setPrice(3500);
//        $offerPSC->setPriceCurrency('EUR');
//        $offerPSC->setAudience('internal');
//        $offerPSC->addProduct($productS2020);
//        $manager->persist($offerPSC);
//
//        // Offer
//        $offerPS1215 = new Offer();
//        $offerPS1215->setName('Offer Poortinschrijving Summoning 2020 12-15 jaar');
//        $offerPS1215->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$offerPS1215->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerPS1215->setDescription('Poortinschrijving Summoning 2020 12-15 jaar');
//        $offerPS1215->setPrice(3250);
//        $offerPS1215->setPriceCurrency('EUR');
//        $offerPS1215->setAudience('internal');
//        $offerPS1215->addProduct($productS2020);
//        $manager->persist($offerPS1215);
//
//        // Offer
//        $offerPS12 = new Offer();
//        $offerPS12->setName('Offer Poortinschrijving Summoning 2020 >12');
//        $offerPS12->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$offerPS12->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerPS12->setDescription('Poortinschrijving Summoning 2020 >12');
//        $offerPS12->setPrice(1500);
//        $offerPS12->setPriceCurrency('EUR');
//        $offerPS12->setAudience('internal');
//        $offerPS12->addProduct($productS2020);
//        $manager->persist($offerPS12);
//
//        // Offer
//        $offerVSS = new Offer();
//        $offerVSS->setName('Offer Voorinschrijving Summoning 2020 Speler');
//        $offerVSS->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$offerVSS->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerVSS->setDescription('Voorinschrijving Summoning 2020 Speler');
//        $offerVSS->setPrice(5500);
//        $offerVSS->setPriceCurrency('EUR');
//        $offerVSS->setAudience('internal');
//        $offerVSS->addProduct($productS2020);
//        $manager->persist($offerVSS);
//
//        // Offer
//        $offerVSF = new Offer();
//        $offerVSF->setName('Offer Voorinschrijving Summoning 2020 Figurant');
//        $offerVSF->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$offerVSF->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerVSF->setDescription('Voorinschrijving Summoning 2020 Figurant');
//        $offerVSF->setPrice(0);
//        $offerVSF->setPriceCurrency('EUR');
//        $offerVSF->setAudience('internal');
//        $offerVSF->addProduct($productS2020);
//        $manager->persist($offerVSF);
//
//        // Offer
//        $offerVSC = new Offer();
//        $offerVSC->setName('Offer Voorinschrijving Summoning 2020 Crew');
//        $offerVSC->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$offerVSC->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerVSC->setDescription('Voorinschrijving Summoning 2020 Crew');
//        $offerVSC->setPrice(2500);
//        $offerVSC->setPriceCurrency('EUR');
//        $offerVSC->setAudience('internal');
//        $offerVSC->addProduct($productS2020);
//        $manager->persist($offerVSC);
//
//        // Offer
//        $offerVS1215 = new Offer();
//        $offerVS1215->setName('Offer Voorinschrijving Summoning 2020 12-15 jaar');
//        $offerVS1215->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$offerVS1215->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerVS1215->setDescription('Voorinschrijving Summoning 2020 12-15 jaar');
//        $offerVS1215->setPrice(2750);
//        $offerVS1215->setPriceCurrency('EUR');
//        $offerVS1215->setAudience('internal');
//        $offerVS1215->addProduct($productS2020);
//        $manager->persist($offerVS1215);
//
//        // Offer
//        $offerVS12 = new Offer();
//        $offerVS12->setName('Offer Voorinschrijving Summoning 2020 >12');
//        $offerVS12->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$offerVS12->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerVS12->setDescription('Voorinschrijving Summoning 2020 >12');
//        $offerVS12->setPrice(1500);
//        $offerVS12->setPriceCurrency('EUR');
//        $offerVS12->setAudience('internal');
//        $offerVS12->addProduct($productS2020);
//        $manager->persist($offerVS12);
//
//        // Offer
//        $offerSH = new Offer();
//        $offerSH->setName('Offer handelaar Summoning 2020');
//        $offerSH->setOfferedBy($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7b863976-0fc3-4f49-a4f7-0bf7d2f2f535']));
//        //$offerSH->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $offerSH->setDescription('Inschrijving handelaar Summoning 2020');
//        $offerSH->setPrice(5000);
//        $offerSH->setPriceCurrency('EUR');
//        $offerSH->setAudience('internal');
//        $offerSH->addProduct($productS2020);
//        $manager->persist($offerSH);
    }
}
