<?php

namespace MealBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DayTimeMeal
 * @package MealBundle\Entity
 * @ORM\Entity(repositoryClass="MealBundle\Repository\DayTimeMeal")
 * @ORM\Table(name="day_time_meal")
 */
class DayTimeMeal
{
    /**
     * @Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Meal[]|Collection
     * @ORM\JoinColumn(name="meal_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Meal", inversedBy="dayTimeMeal")
     */
    protected $meal;

    /**
     * @see DayTimeEnum
     * @var int $dayTime
     * @ORM\Column(name="day_time", type="integer")
     */
    protected $dayTime;

    /**
     * @var $day
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\Day", mappedBy="dayTimeMeal")
     */
    protected $day;

    /**
     * DayTimeMeal constructor.
     */
    public function __construct()
    {
        $this->day = new ArrayCollection();
        $this->meal = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return DayTimeMeal
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Meal[]|Collection
     */
    public function getMeal()
    {
        return $this->meal;
    }

    /**
     * @param Meal[] $meal
     * @return DayTimeMeal
     */
    public function setMeal($meal)
    {
        $this->meal = $meal;
        return $this;
    }

    /**
     * @return int
     */
    public function getDayTime(): ?int
    {
        return $this->dayTime;
    }

    /**
     * @param int $dayTime
     * @return DayTimeMeal
     */
    public function setDayTime(int $dayTime): DayTimeMeal
    {
        $this->dayTime = $dayTime;
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
     * @return DayTimeMeal
     */
    public function setDay($day)
    {
        $this->day = $day;
        return $this;
    }
}
