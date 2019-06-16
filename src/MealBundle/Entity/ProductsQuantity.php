<?php

namespace MealBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * Class ProductsQuantity
 * @package MealBundle\Entity
 * @ORM\Entity(repositoryClass="MealBundle\Repository\ProductsQuantityRepository")
 * @ORM\Table(name="products_quantity")
 */
class ProductsQuantity
{
    /**
     * @Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Product
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productsQuantity")
     */
    protected $product;

    /**
     * @var integer
     * @ORM\Column(name="amount", type="integer")
     */
    protected $amount;

    /**
     * @var $meal
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\Meal", mappedBy="productsQuantity")
     */
    protected $meal;

    /**
     * ProductsQuantity constructor.
     */
    public function __construct()
    {
        $this->meal = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ProductsQuantity
     */
    public function setId(int $id): ProductsQuantity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return ProductsQuantity
     */
    public function setProduct(Product $product): ProductsQuantity
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getMeal()
    {
        return $this->meal;
    }

    /**
     * @param mixed $meal
     * @return ProductsQuantity
     */
    public function setMeal($meal)
    {
        $this->meal = $meal;
        return $this;
    }
}
