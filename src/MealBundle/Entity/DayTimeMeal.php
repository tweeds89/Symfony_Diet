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
     * @see DayTimeEnum
     * @var int $dayTime
     * @ORM\Column(name="day_time", type="integer")
     */
    protected $dayTime;

    /**
     * @var DayTimeMeal|Collection
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\Day", inversedBy="dayTimeMeals", cascade={"persist"})
     * @ORM\JoinTable(name="day_day_time_meal_relation",
     *     joinColumns={@ORM\JoinColumn(name="day_time_meal_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="day_id", referencedColumnName="id")}
     * )
     */
    protected $days;

    /**
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\Meal")
     * @ORM\JoinColumn(name="fighter_id", referencedColumnName="id")
     */
    protected $meals;

    /**
     * DayTimeMeal constructor.
     */
    public function __construct()
    {
        $this->days = new ArrayCollection();
        $this->meals = new ArrayCollection();
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
     * @return mixed
     */
    public function getMeals()
    {
        return $this->meals;
    }

    /**
     * @param mixed $meals
     * @return DayTimeMeal
     */
    public function setMeals($meals)
    {
        $this->meals = $meals;
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
    public function setDayTime(?int $dayTime): DayTimeMeal
    {
        $this->dayTime = $dayTime;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    /**
     * @param Day $day
     */
    public function addDay(Day $day): void
    {
        if ($this->days->contains($day)){
            return;
        }
        $this->days->add($day);

        $day->addDayTimeMeal($this);
    }

    /**
     * @param Day $day
     */
    public function removeDay(Day $day): void
    {
        if (!$this->days->contains($day)) {
            return;
        }
        $this->days->removeElement($day);

        $day->removeDayTimeMeal($this);
    }
}
