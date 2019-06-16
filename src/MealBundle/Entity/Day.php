<?php

namespace MealBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * Class Day
 * @package MealBundle\Entity
 * @ORM\Entity(repositoryClass="MealBundle\Repository\DayRepository")
 * @ORM\Table(name="day")
 */
class Day
{
    /**
     * @Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="day", type="datetime")
     */
    protected $day;

    /**
     * @var DayTimeMeal|Collection
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\DayTimeMeal", inversedBy="day", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinTable(name="day_day_time_meal_relation",
     *     joinColumns={@ORM\JoinColumn(name="day_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="day_time_meal_id", referencedColumnName="id")}
     * )
     */
    protected $dayTimeMeals;

    /**
     * Day constructor.
     */
    public function __construct()
    {
        $this->dayTimeMeals = new ArrayCollection();
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
     * @return Day
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDay(): ?\DateTime
    {
        return $this->day;
    }

    /**
     * @param \DateTime $day
     * @return Day
     */
    public function setDay(\DateTime $day): Day
    {
        $this->day = $day;
        return $this;
    }

    /**
     * @return Collection|DayTimeMeal
     */
    public function getDayTimeMeals()
    {
        return $this->dayTimeMeals;
    }

    /**
     * @param Collection|DayTimeMeal $dayTimeMeals
     * @return Day
     */
    public function setDayTimeMeals($dayTimeMeals)
    {
        $this->dayTimeMeals = $dayTimeMeals;
        return $this;
    }
}
