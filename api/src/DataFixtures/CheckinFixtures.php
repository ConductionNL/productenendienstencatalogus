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

class CheckinFixtures extends Fixture
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
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'zuiddrecht.nl' && strpos($this->params->get('app_domain'), 'zuiddrecht.nl') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Catalogi
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

        $manager->flush();
    }
}
