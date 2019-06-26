<?php

namespace MealBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * Class Meal
 * @package MealBundle\Entity
 * @ORM\Entity(repositoryClass="MealBundle\Repository\MealRepository")
 * @ORM\Table(name="meal")
 */
class Meal
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
     * @var Collection|WeightProduct[]
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\WeightProduct", mappedBy="meals", cascade={"persist"})
     */
    protected $weightProducts;

    /**
     * Meal constructor.
     */
    public function __construct()
    {
        $this->weightProducts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Meal
     */
    public function setId(int $id): Meal
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
     * @return Meal
     */
    public function setName(string $name): Meal
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection|WeightProduct
     */
    public function getWeightProducts(): Collection
    {
        return $this->weightProducts;
    }

    /**
     * @param WeightProduct $weightProduct
     */
    public function addWeightProduct(WeightProduct $weightProduct)
    {
        if ($this->weightProducts->contains($weightProduct)) {

            return;
        }

        $this->weightProducts->add($weightProduct);

        $weightProduct->addMeal($this);
    }

    /**
     * @param WeightProduct $weightProduct
     */
    public function removeWeightProduct(WeightProduct $weightProduct)
    {
        if (!$this->weightProducts->contains($weightProduct)) {
            return;
        }

        $this->weightProducts->removeElement($weightProduct);

        $weightProduct->removeMeal($this);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
