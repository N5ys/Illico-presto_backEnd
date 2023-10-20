<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource(
    normalizationContext: ['groups' => ['read:orders']],
    denormalizationContext: ['groups' => ['write:orders']],
    mercure: [
        'private' => false,
        'topics' => ['order'],
    ],


)]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:orders'])]
    private ?int $id = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['read:orders','write:orders'])]
    private ?\DateTimeInterface $orderTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['read:orders','write:orders'])]
    private ?\DateTimeInterface $serviceTime = null;



    #[ORM\Column]
    #[Groups(['read:orders', 'write:orders'])]
    #[ApiFilter(BooleanFilter::class, properties: ['isServed' => 'eq'])]
    private ?bool $isServed = null;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'orders')]
    #[Groups(['read:orders', 'write:orders'])]
    private Collection $products;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:orders','write:orders'])]
    private ?Table $orderTable = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'orders')]
    #[Groups(['read:orders','write:orders'])]
    private ?Product $currentProduct = null;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderTime(): ?\DateTimeInterface
    {
        return $this->orderTime;
    }

    public function setOrderTime(\DateTimeInterface $orderTime): static
    {
        $this->orderTime = $orderTime;

        return $this;
    }

    public function getServiceTime(): ?\DateTimeInterface
    {
        return $this->serviceTime;
    }

    public function setServiceTime(?\DateTimeInterface $serviceTime): static
    {
        $this->serviceTime = $serviceTime;

        return $this;
    }



    public function isIsServed(): ?bool
    {
        return $this->isServed;
    }

    public function setIsServed(bool $isServed): static
    {
        $this->isServed = $isServed;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getOrderTable(): ?Table
    {
        return $this->orderTable;
    }

    public function setOrderTable(?Table $orderTable): static
    {
        $this->orderTable = $orderTable;

        return $this;
    }

    public function getCurrentProduct(): ?Product
    {
        return $this->currentProduct;
    }

    public function setCurrentProduct(?Product $currentProduct): static
    {
        $this->currentProduct = $currentProduct;

        return $this;
    }
}
