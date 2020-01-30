<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An entity representing a product group.
 *
 * This entity represents a product group to differ between various product types.
 *
 * @author Robert Zondervan <robert@conduction.nl>
 *
 * @category Entity
 *
 * @license EUPL <https://github.com/ConductionNL/productenendienstencatalogus/blob/master/LICENSE.md>
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 * @ORM\Table(name="productorservicegroup")
 */
class Group
{
    /**
     * @var UuidInterface The Uuid identifier of this group
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
	 * @var string The icon of this property
	 *
	 * @example My Property
	 *
	 * @Assert\Length(min = 15, max = 255)
	 * @Groups({"read", "write"})
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $icon;

    /**
     * @var string The name of this product group
     *
     * @example My Group
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string An short description of this product group
     *
     * @example This is the best group ever
     *
     * @Assert\Length(
     *      max = 2550
     * )
     * @Groups({"read"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string The logo for this component
     *
     * @example https://www.my-organization.com/logo.png
     *
     * @Assert\Url
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var ArrayCollection The groups that are a part of this product group
     *
     * @MaxDepth(1)
     * @Groups({"read","write"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="groups")
     */
    private $products;

    /**
     * @var string The RSIN of the organization that owns this group
     *
     * @example 002851234
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 8,
     *      max = 11
     * )
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     * @ApiFilter(SearchFilter::class, strategy="exact")
     */
    private $sourceOrganization;

    /**
     * @var Catalogue The Catalogue that this product group belongs to
     *
     * @MaxDepth(1)
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Catalogue", inversedBy="groups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $catalogue;

    /**
     * @Groups({"read", "write"})
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="App\Entity\Group", mappedBy="parent")
     */
    private $children;

    /**
     * @Groups({"read", "write"})
     * @MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="children")
     */
    private $parent;

    /**
     * @var Datetime $dateCreated The moment this request was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var Datetime $dateModified  The moment this request last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->services = new ArrayCollection();
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

    public function getIcon(): ?string
    {
    	return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
    	$this->icon = $icon;

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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

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

    public function getSourceOrganization(): ?string
    {
        return $this->sourceOrganization;
    }

    public function setSourceOrganization(string $sourceOrganization): self
    {
        $this->sourceOrganization = $sourceOrganization;

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
    public function getChildren(): Collection
    {
    	return $this->children;
    }

    public function addChild(self $child): self
    {
    	if (!$this->children->contains($child)) {
    		$this->children[] = $child;
    		$child->setParent($this);
    	}

    	return $this;
    }

    public function removeChild(self $child): self
    {
    	if ($this->children->contains($child)) {
    		$this->children->removeElement($child);
    		// set the owning side to null (unless already changed)
    		if ($child->getParent() === $this) {
    			$child->setParent(null);
    		}
    	}

    	return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
    	return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
    	$this->dateCreated= $dateCreated;

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
}
