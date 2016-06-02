<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="benchmarks")
 */
class Benchmark extends NameEntity{

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $processor;

    /**
     * @ORM\Column(type="date")
     */
    private $bench_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $column_count;

    /**
     * @ORM\Column(type="integer")
     */
    private $row_count;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="benchmarks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

        /**
     * @ORM\OneToMany(targetEntity="Column", mappedBy="benchmark", cascade={"all"}, orphanRemoval=true, fetch="LAZY")
     */
    private $columns;

    /**
     * @ORM\OneToMany(targetEntity="Row", mappedBy="benchmark", cascade={"all"}, orphanRemoval=true, fetch="LAZY")
     */
    private $rows;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->columns = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rows = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Benchmark
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
     * Set processor
     *
     * @param string $processor
     * @return Benchmark
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

    /**
     * Set bench_date
     *
     * @param \DateTime $benchDate
     * @return Benchmark
     */
    public function setBenchDate($benchDate)
    {
        $this->bench_date = $benchDate;

        return $this;
    }

    /**
     * Get bench_date
     *
     * @return \DateTime 
     */
    public function getBenchDate()
    {
        return $this->bench_date;
    }

    /**
     * Set column_count
     *
     * @param integer $columnCount
     * @return Benchmark
     */
    public function setColumnCount($columnCount)
    {
        $this->column_count = $columnCount;

        return $this;
    }

    /**
     * Get column_count
     *
     * @return integer 
     */
    public function getColumnCount()
    {
        return $this->column_count;
    }

    /**
     * Set row_count
     *
     * @param integer $rowCount
     * @return Benchmark
     */
    public function setRowCount($rowCount)
    {
        $this->row_count = $rowCount;

        return $this;
    }

    /**
     * Get row_count
     *
     * @return integer 
     */
    public function getRowCount()
    {
        return $this->row_count;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Benchmark
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
     * Add columns
     *
     * @param \AppBundle\Entity\Column $columns
     * @return Benchmark
     */
    public function addColumn(\AppBundle\Entity\Column $columns)
    {
        $this->columns[] = $columns;

        return $this;
    }

    /**
     * Remove columns
     *
     * @param \AppBundle\Entity\Column $columns
     */
    public function removeColumn(\AppBundle\Entity\Column $columns)
    {
        $this->columns->removeElement($columns);
    }

    /**
     * Get columns
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Add rows
     *
     * @param \AppBundle\Entity\Row $rows
     * @return Benchmark
     */
    public function addRow(\AppBundle\Entity\Row $rows)
    {
        $this->rows[] = $rows;

        return $this;
    }

    /**
     * Remove rows
     *
     * @param \AppBundle\Entity\Row $rows
     */
    public function removeRow(\AppBundle\Entity\Row $rows)
    {
        $this->rows->removeElement($rows);
    }

    /**
     * Get rows
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRows()
    {
        return $this->rows;
    }
}
