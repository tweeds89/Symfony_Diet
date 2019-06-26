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
     * @var DayTimeMeal|Collection $dayTimeMeals
     * @ORM\ManyToMany(targetEntity="MealBundle\Entity\DayTimeMeal", mappedBy="days", cascade={"persist"})
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
    public function getDayTimeMeals(): Collection
    {
        return $this->dayTimeMeals;
    }

    /**
     * @param DayTimeMeal $dayTimeMeal
     */
    public function addDayTimeMeal(DayTimeMeal $dayTimeMeal)
    {
        if ($this->dayTimeMeals->contains($dayTimeMeal)) {

            return;
        }

        $this->dayTimeMeals->add($dayTimeMeal);

        $dayTimeMeal->addDay($this);
    }

    /**
     * @param DayTimeMeal $dayTimeMeal
     */
    public function removeDayTimeMeal(DayTimeMeal $dayTimeMeal)
    {
        if (!$this->dayTimeMeals->contains($dayTimeMeal)) {
            return;
        }

        $this->dayTimeMeals->removeElement($dayTimeMeal);

        $dayTimeMeal->removeDay($this);
    }
}
