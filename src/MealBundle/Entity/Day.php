<?php

namespace MealBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use MealBundle\Enums\DayTimeEnum;

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
     * @see DayTimeEnum
     * @var int $dayTime
     * @ORM\Column(name="day_time", type="integer")
     */
    protected $dayTime;

    /**
     * @var Meal[]|Collection
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\Meal", inversedBy="day")
     * @ORM\JoinTable(name="day_meal_relation",
     *     joinColumns={@ORM\JoinColumn(name="day_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="meal_id", referencedColumnName="id")}
     * )
     */
    protected $dayMeals;

    /**
     * Day constructor.
     */
    public function __construct()
    {
        $this->dayMeals = new ArrayCollection();
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
     * @return int|null
     */
    public function getDayTime(): ?int
    {
        return $this->dayTime;
    }

    /**
     * @param int $dayTime
     * @return Day
     */
    public function setDayTime(int $dayTime): Day
    {
        $this->dayTime = $dayTime;
        return $this;
    }

    /**
     * @return Collection|Meal[]
     */
    public function getDayMeals()
    {
        return $this->dayMeals;
    }

    /**
     * @param Collection|Meal[] $dayMeals
     * @return Day
     */
    public function setDayMeals($dayMeals)
    {
        $this->dayMeals = $dayMeals;
        return $this;
    }
}
