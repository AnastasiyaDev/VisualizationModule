<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="experiments")
 */
class Experiment extends NameEntity{

    /**
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\Column(type="date")
     */
    private $exp_date;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $processor;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="experiments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Table", mappedBy="experiment", cascade={"all"}, orphanRemoval=true, fetch="LAZY")
     */
    private $tables;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tables = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Experiment
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set exp_date
     *
     * @param \DateTime $expDate
     * @return Experiment
     */
    public function setExpDate($expDate)
    {
        $this->exp_date = $expDate;

        return $this;
    }

    /**
     * Get exp_date
     *
     * @return \DateTime 
     */
    public function getExpDate()
    {
        return $this->exp_date;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Experiment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Experiment
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add tables
     *
     * @param \AppBundle\Entity\Table $tables
     * @return Experiment
     */
    public function addTable(\AppBundle\Entity\Table $tables)
    {
        $this->tables[] = $tables;

        return $this;
    }

    /**
     * Remove tables
     *
     * @param \AppBundle\Entity\Table $tables
     */
    public function removeTable(\AppBundle\Entity\Table $tables)
    {
        $this->tables->removeElement($tables);
    }

    /**
     * Get tables
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * Add every_table
     *
     * @param \AppBundle\Entity\Table $everyTable
     * @return Experiment
     */
    public function addEveryTable(\AppBundle\Entity\Table $everyTable)
    {
        $this->every_table[] = $everyTable;

        return $this;
    }

    /**
     * Remove every_table
     *
     * @param \AppBundle\Entity\Table $everyTable
     */
    public function removeEveryTable(\AppBundle\Entity\Table $everyTable)
    {
        $this->every_table->removeElement($everyTable);
    }

    /**
     * Get every_table
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEveryTable()
    {
        return $this->every_table;
    }

    /**
     * Set processor
     *
     * @param string $processor
     * @return Experiment
     */
    public function setProcessor($processor)
    {
        $this->processor = $processor;

        return $this;
    }

    /**
     * Get processor
     *
     * @return string 
     */
    public function getProcessor()
    {
        return $this->processor;
    }
}
