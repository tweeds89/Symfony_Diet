<?php

namespace MealBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * Class WeightProduct
 * @package MealBundle\Entity
 * @ORM\Entity(repositoryClass="MealBundle\Repository\WeightProductRepository")
 * @ORM\Table(name="weight_product")
 */
class WeightProduct
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
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="weightProducts")
     */
    protected $product;

    /**
     * @var integer
     * @ORM\Column(name="weight", type="integer")
     */
    protected $weight;

    /**
     * @var Collection $meals
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\Meal", inversedBy="weightProducts")
     */
    protected $meals;

    /**
     * WeightProduct constructor.
     */
    public function __construct()
    {
        $this->meals = new ArrayCollection();
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
     * @return WeightProduct
     */
    public function setId(int $id): WeightProduct
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
     * @return WeightProduct
     */
    public function setProduct(Product $product): WeightProduct
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return WeightProduct
     */
    public function setWeight(int $weight): WeightProduct
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    /**
     * @param Meal $meal
     */
    public function addMeal(Meal $meal): void
    {
        if ($this->meals->contains($meal)){
            return;
        }
        $this->meals->add($meal);

        $meal->addWeightProduct($this);
    }

    /**
     * @param Meal $meal
     */
    public function removeMeal(Meal $meal): void
    {
        if (!$this->meals->contains($meal)) {
            return;
        }
        $this->meals->removeElement($meal);

        $meal->removeWeightProduct($this);
    }
}
