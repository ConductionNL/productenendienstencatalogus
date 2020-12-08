<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An entity representing a product.
 *
 * This entity represents a product that can be ordered via the OrderRegistratieComponent.
 *
 * @author Robert Zondervan <robert@conduction.nl>
 *
 * @category Entity
 *
 * @license EUPL <https://github.com/ConductionNL/productenendienstencatalogus/blob/master/LICENSE.md>
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "get_change_logs"={
 *              "path"="/products/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/products/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 *
 * @ApiFilter(OrderFilter::class, properties={"type","sku"})
 * @ApiFilter(SearchFilter::class, properties={"sourceOgranization": "exact","groups.id": "exact","type": "exact","sku": "exact","name": "partial","description": "partial", "id": "exact"})
 * @ApiFilter(DateFilter::class, properties={"dateCreated","dateModified" })
 */
class Product
{
    /**
     * @var UuidInterface The UUID identifier of this object
     *
     * @example e2984465-190a-4562-829e-a8cca81aa35d
     *
     * @Assert\Uuid
     * @Groups({"read"})
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string The human readable reference for this product, also known as Stock Keeping Unit (SKU)
     *
     * @example 6666-2019
     *
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true) //, unique=true
     */
    private $sku;

    /**
     * @var string The auto-incrementing id part of the reference, unique on a organization-year-id basis
     *
     * @example 000000000001
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="integer", length=11, nullable=true)
     */
    private $skuId;

    /**
     * @var string The name of this Product
     *
     * @example My product
     *
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string An short description of this Product
     *
     * @example This is the best product ever
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *      max = 2550
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string The logo of this product
     *
     * @example https://www.my-organization.com/logo.png
     *
     * @Gedmo\Versioned
     * @Assert\Url
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string The movie for this product
     *
     * @example https://www.youtube.com/embed/RkBZYoMnx5w
     *
     * @Gedmo\Versioned
     * @Assert\Url
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $movie;

    /**
     * @var string The WRC Url of the organization that owns this product
     *
     * @example 002851234
     *
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Assert\Url
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $sourceOrganization;

    /**
     * @var string The PTC Url of the procces started by this product e.a. aquire passport
     *
     * @example 002851234
     *
     * @Gedmo\Versioned
     * @Assert\Url
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $procces;

    /**
     * @var ArrayCollection The product groups that this product is a part of
     *
     *
     * @MaxDepth(1)
     * @Groups({"read", "write"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Group", mappedBy="products")
     */
    private $groups;

    /**
     * @var string The price of this product
     *
     * @example 50.00
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     * @Groups({"read","write"})
     *
     * @deprecated
     */
    private $price;

    /**
     *  @var string The currency of this product in an [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) format
     *
     * @example EUR
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="string")
     * @Assert\Currency
     * @Groups({"read","write"})
     *
     * @deprecated
     */
    private $priceCurrency = 'EUR';

    /**
     * @var int The tax percentage for this product as an integer e.g. 9% makes 9
     *
     * @example 9
     *
     * @Gedmo\Versioned
     * @Assert\PositiveOrZero
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $taxPercentage;

    /**
     * @var Product The product that this product is a variation of
     *
     * @MaxDepth(1)
     * @Groups({"write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="variations")
     */
    private $parent;

    /**
     * @var ArrayCollection The different variations that are available of this product
     *
     * @MaxDepth(1)
     * @Groups({"read"})
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="parent")
     */
    private $variations;

    /**
     * @var string The type of this product. **simple**, **set**, **virtual**, **external**, **ticket**, **variable**, **subscription**, **person**, **location**, **service**
     *
     * @example simple
     *
     * @Gedmo\Versioned
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Choice(
     *     choices = { "simple", "set", "virtual","external","ticket","variable","subscription","person","location","service" },
     *     message = "Choose either simple, set, virtual, external, ticket, variable, subscription, person, location or service, got {{ value }}"
     * )
     * @Assert\Length(
     *     max = 15
     * )
     * @Groups({"read", "write"})
     */
    private $type;

    /**
     * @var ArrayCollection If the product type is a **set** this contains the products that are part of that set
     *
     * @MaxDepth(1)
     * @Groups({"read"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="sets")
     */
    private $groupedProducts;

    /**
     * @var ArrayCollection The sets thats this product is a part of
     *
     * @MaxDepth(1)
     * @Groups({"write"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", mappedBy="groupedProducts")
     */
    private $sets;

    /**
     * @var Catalogue The Catalogue that this product belongs to
     *
     * @MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Catalogue", inversedBy="products",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"read","write"})
     */
    private $catalogue;

    /**
     * @var ArrayCollection The offers that refer to this product
     *
     *
     * @MaxDepth(1)
     * @Groups({"read", "write"})
     * @Assert\Valid
     * @ORM\ManyToMany(targetEntity="App\Entity\Offer", mappedBy="products", orphanRemoval=true, cascade="persist")
     */
    private $offers;

    /**
     * @var string The uri referring to the calendar of this product.
     *
     * @example http://example.org/calendar/calendar
     *
     * @Gedmo\Versioned
     * @Assert\Url
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $calendar;

    /**
     * @var bool If the product requires a physical appointment, for example to request travel documents or for the booking of hotel rooms
     *
     * @example false
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     * @Groups({"read", "write"})
     */
    private $requiresAppointment;

    /**
     * @var array An array of URLs pointing to documents related to this product
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="simple_array", nullable=true)
     * @Groups({"read"})
     */
    private $documents = [];

    /**
     * @var array An array of URLs pointing to images related to this product
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="simple_array", nullable=true)
     * @Groups({"read"})
     */
    private $images = [];

    /**
     * @var array An array of URLs pointing to external documents referred to from this product
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="simple_array", nullable=true)
     * @Groups({"read"})
     */
    private $externalDocs = [];

    /**
     * @var string The audience this product is intended for
     *
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @Assert\Choice({"public", "internal"})
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     */
    private $audience = 'internal';

    /**
     * @var ArrayCollection The additional properties this product has
     *
     * @Groups({"read","write"})
     * @MaxDepth(1)
     * @ORM\ManyToMany(targetEntity="App\Entity\PropertyValue", mappedBy="products")
     */
    private $additionalProperties;

    /**
     * @var string The pre duration of this product, entered according to the [ISO 8601-standard](https://en.wikipedia.org/wiki/ISO_8601#Durations)
     *
     * @example PT10M
     *
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $preDuration;

    /**
     * @var string The duration of this product, entered according to the [ISO 8601-standard](https://en.wikipedia.org/wiki/ISO_8601#Durations)
     *
     * @example PT10M
     *
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @var string The post duration of this product, entered according to the [ISO 8601-standard](https://en.wikipedia.org/wiki/ISO_8601#Durations)
     *
     * @example PT10M
     *
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postDuration;

    /**
     * @var Datetime The moment this resource was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var Datetime The moment this resource last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->variations = new ArrayCollection();
        $this->groupedProducts = new ArrayCollection();
        $this->sets = new ArrayCollection();
        $this->offers = new ArrayCollection();
        $this->additionalProperties = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getSkuId(): ?int
    {
        return $this->skuId;
    }

    public function setSkuId(int $skuId): self
    {
        $this->skuId = $skuId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $group->addProduct($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
            $group->removeProduct($this);
        }

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(?string $priceCurrency): self
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getMovie(): ?string
    {
        return $this->movie;
    }

    public function setMovie(?string $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getSourceOrganization(): ?string
    {
        return $this->sourceOrganization;
    }

    public function setSourceOrganization(string $sourceOrganization): self
    {
        $this->sourceOrganization = $sourceOrganization;

        return $this;
    }

    public function getProcces(): ?string
    {
        return $this->procces;
    }

    public function setProcces(string $procces): self
    {
        $this->procces = $procces;

        return $this;
    }

    public function getTaxPercentage(): ?int
    {
        return $this->taxPercentage;
    }

    public function setTaxPercentage(int $taxPercentage): self
    {
        $this->taxPercentage = $taxPercentage;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getVariations(): Collection
    {
        return $this->variations;
    }

    public function addVariation(self $variation): self
    {
        if (!$this->variations->contains($variation)) {
            $this->variations[] = $variation;
            $variation->setParent($this);
        }

        return $this;
    }

    public function removeVariation(self $variation): self
    {
        if ($this->variations->contains($variation)) {
            $this->variations->removeElement($variation);
            // set the owning side to null (unless already changed)
            if ($variation->getParent() === $this) {
                $variation->setParent(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGroupedProducts(): Collection
    {
        return $this->groupedProducts;
    }

    public function addGroupedProduct(self $groupedProduct): self
    {
        if (!$this->groupedProducts->contains($groupedProduct)) {
            $this->groupedProducts[] = $groupedProduct;
        }

        return $this;
    }

    public function removeGroupedProduct(self $groupedProduct): self
    {
        if ($this->groupedProducts->contains($groupedProduct)) {
            $this->groupedProducts->removeElement($groupedProduct);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSets(): Collection
    {
        return $this->sets;
    }

    public function addSet(self $set): self
    {
        if (!$this->sets->contains($set)) {
            $this->sets[] = $set;
            $set->addGroupedProduct($this);
        }

        return $this;
    }

    public function removeSet(self $set): self
    {
        if ($this->sets->contains($set)) {
            $this->sets->removeElement($set);
            $set->removeGroupedProduct($this);
        }

        return $this;
    }

    public function getCatalogue(): ?Catalogue
    {
        return $this->catalogue;
    }

    public function setCatalogue(?Catalogue $catalogue): self
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->addProduct($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->contains($offer)) {
            $this->offers->removeElement($offer);
            // set the owning side to null (unless already changed)
            if ($offer->getProducts() === $this) {
                $offer->getProducts(null);
            }
        }

        return $this;
    }

    public function getCalendar(): ?string
    {
        return $this->calendar;
    }

    public function setCalendar(?string $calendar): self
    {
        $this->calendar = $calendar;

        return $this;
    }

    public function getRequiresAppointment(): ?bool
    {
        return $this->requiresAppointment;
    }

    public function setRequiresAppointment(bool $requiresAppointment): self
    {
        $this->requiresAppointment = $requiresAppointment;

        return $this;
    }

    public function getDocuments(): ?array
    {
        return $this->documents;
    }

    public function setDocuments(?array $documents): self
    {
        $this->documents = $documents;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getExternalDocs(): ?array
    {
        return $this->externalDocs;
    }

    public function setExternalDocs(?array $externalDocs): self
    {
        $this->externalDocs = $externalDocs;

        return $this;
    }

    public function getAudience(): ?string
    {
        return $this->audience;
    }

    public function setAudience(?string $audience): self
    {
        $this->audience = $audience;

        return $this;
    }

    /**
     * @return Collection|PropertyValue[]
     */
    public function getAdditionalProperties(): Collection
    {
        return $this->additionalProperties;
    }

    public function addAdditionalProperty(PropertyValue $additionalProperty): self
    {
        if (!$this->additionalProperties->contains($additionalProperty)) {
            $this->additionalProperties[] = $additionalProperty;
            $additionalProperty->addProduct($this);
        }

        return $this;
    }

    public function removeAdditionalProperty(PropertyValue $additionalProperty): self
    {
        if ($this->additionalProperties->contains($additionalProperty)) {
            $this->additionalProperties->removeElement($additionalProperty);
            $additionalProperty->removeProduct($this);
        }

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getPreDuration(): ?string
    {
        return $this->preDuration;
    }

    public function setPreDuration(?string $preDuration): self
    {
        $this->preDuration = $preDuration;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPostDuration(): ?string
    {
        return $this->postDuration;
    }

    public function setPostDuration(?string $postDuration): self
    {
        $this->postDuration = $postDuration;

        return $this;
    }

    public function createOffer(?string $price = '0.00', ?string $priceCurrency = 'EUR', ?string $name = null, ?string $description = null): self
    {
        $offer = new Offer();
        if ($name) {
            $offer->setName($name);
        } else {
            $offer->setName($this->getName());
        }
        if ($description) {
            $offer->setDescription($description);
        } else {
            $offer->setDescription($this->getDescription());
        }
        $offer->setPrice($price);
        $offer->setPriceCurrency($priceCurrency);
        $offer->setOfferedBy($this->getSourceOrganization());
        $offer->setAudience('public');

        if ($this->getType() == 'subscription') {
            $offer->setRecurrence('P1M');
            $offer->setNotice('P1M');
        }

        $offer->addProduct($this);

        return $this;
    }
}
