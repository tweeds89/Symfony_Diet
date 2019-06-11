<?php

namespace MealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * Class Product
 * @package MealBundle\Entity
 * @ORM\Entity(repositoryClass="MealBundle\Repository\ProductRepository")
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name = "";

    /**
     * @var int
     * @ORM\Column(name="calories", type="integer")
     */
    protected $calories = 0;

    /**
     * @var ProductsQuantity[]
     * @ORM\OneToMany(targetEntity="ProductsQuantity", mappedBy="product")
     */
    protected $productsQuantity;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Product
     */
    public function setId(int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getCalories(): int
    {
        return $this->calories;
    }

    /**
     * @param int $calories
     * @return Product
     */
    public function setCalories(int $calories): Product
    {
        $this->calories = $calories;
        return $this;
    }

    /**
     * @return ProductsQuantity[]
     */
    public function getProductsQuantity(): array
    {
        return $this->productsQuantity;
    }

    /**
     * @param ProductsQuantity[] $productsQuantity
     * @return Product
     */
    public function setProductsQuantity(array $productsQuantity): Product
    {
        $this->productsQuantity = $productsQuantity;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
