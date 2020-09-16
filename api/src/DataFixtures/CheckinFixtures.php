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
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false &&
            $this->params->get('app_domain') != 'checking.nu' && strpos($this->params->get('app_domain'), 'checking.nu') == false
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
        $product->addGroup($groupCheckin);
        $manager->persist($product);

        $offer = new Offer();
        $offer->setName('Normaal abbonement');
        $offer->setPriceCurrency('EUR');
        $offer->setPrice('35.00');
        $offer->setOfferedBy($product->getSourceOrganization());
        $offer->setAudience('public');
        $offer->setRecurrence('P1M');
        $offer->setNotice('P1M');
        $offer->addProduct($product);

        $product->addOffer($offer);

        $offer = new Offer();
        $offer->setName('Branche lid abbonement');
        $offer->setPriceCurrency('EUR');
        $offer->setPrice('30.00');
        $offer->setOfferedBy($product->getSourceOrganization());
        $offer->setAudience('public');
        $offer->setRecurrence('P1M');
        $offer->setNotice('P1M');
        $offer->addProduct($product);

        $product->addOffer($offer);

        $manager->flush();
    }
}
