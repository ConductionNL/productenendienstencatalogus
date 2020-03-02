<?php

namespace App\DataFixtures;

use App\Entity\Catalogue;
use App\Entity\Group;
use App\Entity\Product;
use App\Entity\Supplier;
use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LarpingFixtures extends Fixture
{
	private $params;
	
	public function __construct(ParameterBagInterface $params)
	{
		$this->params = $params;
	}

    public function load(ObjectManager $manager)
    {
    	// Lets make sure we only run these fixtures on huwelijksplanner enviroments
    	if(!in_array("larping.eu", $this->params->get('app_domains'))){
    		return false;
    	}
    	
    	// Catalogi
    	$catalogue= new Catalogue();
    	$catalogue->setName('VortexAventures2020');
    	$catalogue->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5'); 
    	$manager->persist($catalogue);
    	
    	
    	// Productgroep
    	$group = new Group();
    	$group->setName('Lidmaatschap');
    	$group->setDescription('Alle producten met betrekking tot burgerzaken');
    	$group->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5'); 
    	$group->setCatalogue($catalogue);
    	$manager->persist($group);    	
    	
    	// Product
    	$product = new Product();
    	$product->setName('Evenementlidmaatschap Moots 2');
    	$product->setSourceOrganization('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5'); 
    	$product->setDescription('Met dit product wordt je lid van Vortex Adventures voor Moots 2 2020 event');
    	$product->setType('ticket');
    	$product->setSku('Eventlid-moots2-2020');
    	$product->setCatalogue($catalogue);
    	$product->addGroup($group);
    	$product->setRequiresAppointment(false);
    	$manager->persist($product);
    	
    	// Offer
    	$offer = new Offer();
    	$offer->setName('Offer Eventlid Moots 1 2020');
    	$offer->setOfferedBy('https://wrc.larping.eu/organizations/0972a00f-1893-4e9b-ac13-0e43f225eca5'); 
    	$offer->setDescription('Evenementlidmaatschap Moots 1 2020');    	
    	$offer->setPrice(500);
    	$offer->setPriceCurrency('EUR');
    	$offer->setAudience("public");
    	$offer->addProduct($product);
    	$manager->persist($offer);
    	    	
        $manager->flush();
    }
}
