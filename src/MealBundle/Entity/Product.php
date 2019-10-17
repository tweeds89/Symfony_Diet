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
    protected $calories;

    /**
     * @var WeightProduct[]
     * @ORM\OneToMany(targetEntity="WeightProduct", mappedBy="product")
     */
    protected $weightProducts;

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
     * @return int|null
     */
    public function getCalories(): ?int
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
     * @return WeightProduct[]
     */
    public function getWeightProducts(): array
    {
        return $this->weightProducts;
    }

    /**
     * @param WeightProduct[] $weightProducts
     * @return Product
     */
    public function setWeightProducts(array $weightProducts): Product
    {
        $this->weightProducts = $weightProducts;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s (%s %s)", $this->getName(), $this->getCalories(), 'kcal/100g');
    }
}
