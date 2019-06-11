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
     * @var ProductsQuantity[]|Collection
     * @ORM\ManyToMany(targetEntity="ProductsQuantity", inversedBy="meal", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinTable(name="meal_products_quantity_relation",
     *     joinColumns={@ORM\JoinColumn(name="meal_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="products_quantity_id", referencedColumnName="id")}
     * )
     */
    protected $productsQuantity;

    /**
     * @var $day
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\Day", mappedBy="dayMeals")
     */
    protected $day;

    /**
     * Meal constructor.
     */
    public function __construct()
    {
        $this->productsQuantity = new ArrayCollection();
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
     * @return Collection|ProductsQuantity[]
     */
    public function getProductsQuantity()
    {
        return $this->productsQuantity;
    }

    /**
     * @param Collection|ProductsQuantity[] $productsQuantity
     * @return Meal
     */
    public function setProductsQuantity($productsQuantity)
    {
        $this->productsQuantity = $productsQuantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     * @return Meal
     */
    public function setDay($day)
    {
        $this->day = $day;
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
