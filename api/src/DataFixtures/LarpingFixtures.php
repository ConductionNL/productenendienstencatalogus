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
    	if(!in_array("larping.eu",$this->params->get('app_domains'))){
    		return false;
    	}
    	
    	// Catalogi
    	$catalogue= new Catalogue();
    	$catalogue->setName('Vereniging Nederlandse Gemeenten');
    	$catalogue->setSourceOrganization('0000'); // dit zou beter een wrc organisation kunnen zijn eigenlijk
    	$manager->persist($vng);
    	
    	
    	// Productgroep
    	$group = new Group();
    	$group->setName('Burgerzaken');
    	$group->setDescription('Alle producten met betrekking tot burgerzaken');
    	$group->setSourceOrganization('001709124'); // dit zou beter een wrc organisation kunnen zijn eigenlijk
    	$group->setCatalogue($catalogue);
    	$manager->persist($group);    	
    	
    	// Product
    	$product = new Product();
    	$product->setName('Trouwen / Partnerschap');
    	$product->setSourceOrganization('002220647'); // dit zou beter een wrc organisation kunnen zijn eigenlijk
    	$product->setDescription('Trouwen');
    	$product->setType('set');
    	$product->setCatalogue($catalogue);
    	$product->setRequiresAppointment(false);
    	$product->setAudience("public");
    	$manager->persist($product);
    	
    	// Offer
    	$offer = new Offer();
    	$offer->setName('Trouwen / Partnerschap');
    	$offer->setOfferedBy('002220647'); // dit zou beter een wrc organisation kunnen zijn eigenlijk
    	$offer->setDescription('Trouwen');    	
    	$offer->setPrice('627.00');
    	$offer->setPriceCurrency('EUR');
    	$offer->setAudience("public");
    	$offer->addProduct($product);
    	$manager->persist($offer);
    	    	
        $manager->flush();
    }
}
