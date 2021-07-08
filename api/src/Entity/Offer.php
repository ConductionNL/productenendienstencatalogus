<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
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
 * An entity representing an offer.
 *
 * This entity represents an offer that bridges products to the OrderRegistratieComponent to be able to change prices without invalidating past orders.
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
 *              "path"="/offers/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/offers/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 *
 * @ApiFilter(OrderFilter::class, properties={"name","dateCreated","dateModified","availabilityEnds","availabilityStarts"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "name": "ipartial",
 *     "description": "ipartial",
 *     "price": "exact",
 *     "priceCurrency": "exact",
 *     "offeredBy": "ipartial",
 *     "audience": "exact",
 *     "products.id": "ipartial",
 *     "products.groups.id": "ipartial",
 *     "products.groups.name": "ipartial",
 *     "products.groups.sourceOrganization": "ipartial",
 *     "products.name": "ipartial",
 *     "products.type": "ipartial",
 *     "products.event": "ipartial"
 * })
 * @ApiFilter(DateFilter::class, properties={"dateCreated","dateModified","availabilityEnds","availabilityStarts"})
 * @ApiFilter(ExistsFilter::class, properties={"availabilityStarts", "availabilityEnds", "recurrence", "notice"})
 */
class Offer
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
     * @var string The name of this offer
     *
     * @example my offer
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     */
    private $name;

    /**
     * @var string An short description of this offer
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
     * @var string The price of this product
     *
     * @example 50.00
     *
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $price;

    /**
     * @var string The currency of this product in an [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) format
     *
     * @example EUR
     *
     * @Gedmo\Versioned
     * @Assert\Currency
     * @Groups({"read","write"})
     * @ORM\Column(type="string")
     */
    private $priceCurrency = 'EUR';

    /**
     * @var int The quantity of this product
     *
     * @example 102
     *
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var int The maximum quantity of this product
     *
     * @example 200
     *
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxQuantity;

    /**
     * @var string The uri for the organisation that offers this offer
     *
     * @example(http://example.org/example/1)
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Url
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     */
    private $offeredBy;

    /**
     * @var string The optional proccces for ordering this product
     *
     * @example(http://example.org/example/1)
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     */
    private $processType;

    /**
     * @var DateTime the date this offer ends
     *
     * @example 20191231
     *
     * @Gedmo\Versioned
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Date
     *
     * @Groups({"read","write"})
     */
    private $availabilityEnds;

    /**
     * @var DateTime the date this offer has started
     *
     * @example 20190101
     *
     * @Gedmo\Versioned
     * @Assert\Date
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read","write"})
     */
    private $availabilityStarts;

    /**
     * @var ArrayCollection The taxes that affect this offer
     *
     *
     * @MaxDepth(1)
     * @Groups({"read", "write"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Tax", mappedBy="offers")
     */
    private $taxes;

    /**
     * @var ArrayCollection The customer types that are eligible for this offer
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\CustomerType", mappedBy="offers")
     * @MaxDepth(1)
     * @Groups({"read","write"})
     */
    private $eligibleCustomerTypes;
    /**
     * @var Datetime The moment this request was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var Datetime The moment this request last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     * @var ArrayCollection The products related to this offer
     * @Assert\NotNull
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(1)
     * @Groups({"read", "write"})
     */
    private $products;

    /**
     * @var string The audience this product is intended for
     *
     * @Groups({"read","write"})
     * @Assert\Choice({"public", "internal", "personal"})
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     */
    private $audience;

    /**
     * @var string The of this offer, only used in combination with subscribtion type products, entered according to the [ISO 8601-standard](https://en.wikipedia.org/wiki/ISO_8601#Durations)
     *
     * @example PT10M
     *
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recurrence;

    /**
     * @var string The the notice period requered to end an subscribtion, entered according to the [ISO 8601-standard](https://en.wikipedia.org/wiki/ISO_8601#Durations)
     *
     * @example PT10M
     *
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notice;

    /**
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="array", nullable=true)
     */
    private $options = [];

    public function __construct()
    {
        $this->eligibleCustomerTypes = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->taxes = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(string $priceCurrency): self
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }

    public function getMaxQuantity(): ?int
    {
        return $this->maxQuantity;
    }

    public function setMaxQuantity(int $maxQuantity): self
    {
        if ($this->getQuantity() != null && $this->getQuantity() > $maxQuantity) {
            $this->setQuantity($maxQuantity);
        }

        $this->maxQuantity = $maxQuantity;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        if ($this->getMaxQuantity() != null && $quantity > $this->getMaxQuantity()) {
            $this->quantity = $this->getMaxQuantity();
        } else {
            $this->quantity = $quantity;
        }

        return $this;
    }

    public function getOfferedBy(): ?string
    {
        return $this->offeredBy;
    }

    public function setOfferedBy(string $offeredBy): self
    {
        $this->offeredBy = $offeredBy;

        return $this;
    }

    public function getProcessType(): ?string
    {
        return $this->processType;
    }

    public function setProcessType(string $processType): self
    {
        $this->processType = $processType;

        return $this;
    }

    public function getAvailabilityEnds(): ?\DateTimeInterface
    {
        return $this->availabilityEnds;
    }

    public function setAvailabilityEnds(\DateTimeInterface $availabilityEnds): self
    {
        $this->availabilityEnds = $availabilityEnds;

        return $this;
    }

    public function getAvailabilityStarts(): ?\DateTimeInterface
    {
        return $this->availabilityStarts;
    }

    public function setAvailabilityStarts(\DateTimeInterface $availabilityStarts): self
    {
        $this->availabilityStarts = $availabilityStarts;

        return $this;
    }

    /**
     * @return Collection|Tax[]
     */
    public function getTaxes(): Collection
    {
        return $this->taxes;
    }

    public function addTax(Tax $tax): self
    {
        if (!$this->taxes->contains($tax)) {
            $this->taxes[] = $tax;
            $tax->addOffer($this);
        }

        return $this;
    }

    public function removeTax(Tax $tax): self
    {
        if ($this->taxes->contains($tax)) {
            $this->taxes->removeElement($tax);
            $tax->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|CustomerType[]
     */
    public function getEligibleCustomerTypes(): Collection
    {
        return $this->eligibleCustomerTypes;
    }

    public function addEligibleCustomerType(CustomerType $eligibleCustomerType): self
    {
        if (!$this->eligibleCustomerTypes->contains($eligibleCustomerType)) {
            $this->eligibleCustomerTypes[] = $eligibleCustomerType;
            $eligibleCustomerType->addOffer($this);
        }

        return $this;
    }

    public function removeEligibleCustomerType(CustomerType $eligibleCustomerType): self
    {
        if ($this->eligibleCustomerTypes->contains($eligibleCustomerType)) {
            $this->eligibleCustomerTypes->removeElement($eligibleCustomerType);
            $eligibleCustomerType->removeOffer($this);
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

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
        }

        return $this;
    }

    public function getAudience(): ?string
    {
        return $this->audience;
    }

    public function setAudience(string $audience): self
    {
        $this->audience = $audience;

        return $this;
    }

    public function getRecurrence(): ?string
    {
        return $this->recurrence;
    }

    public function setRecurrence(string $recurrence): self
    {
        $this->recurrence = $recurrence;

        return $this;
    }

    public function getNotice(): ?string
    {
        return $this->notice;
    }

    public function setNotice(string $notice): self
    {
        $this->notice = $notice;

        return $this;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(?array $options): self
    {
        $this->options = $options;

        return $this;
    }
}
