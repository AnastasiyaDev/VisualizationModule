<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tables")
 */
class Table extends BaseEntity
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $info;

    /**
     * @ORM\Column(type="date")
     */
    private $table_date;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $column_label;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $row_label;

    /**
     * @ORM\Column(type="integer")
     */
    private $column_count;

    /**
     * @ORM\Column(type="integer")
     */
    private $row_count;

    /**
     * @ORM\ManyToOne(targetEntity="Experiment",inversedBy="tables")
     * @ORM\JoinColumn(name="experiment_id", referencedColumnName="id")
     */
    private $experiment;

    /**
     * @ORM\OneToMany(targetEntity="Column", mappedBy="table", cascade={"all"}, orphanRemoval=true, fetch="LAZY")
     */
    private $columns;

    /**
     * @ORM\OneToMany(targetEntity="Row", mappedBy="table", cascade={"all"}, orphanRemoval=true, fetch="LAZY")
     */
    private $rows;

    /**
     * @ORM\OneToMany(targetEntity="CellValue", mappedBy="table", cascade={"all"}, orphanRemoval=true, fetch="LAZY")
     */
    private $values;

    /**
     * @ORM\Column(type="boolean" )
     */
    private $filing = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->columns = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rows = new \Doctrine\Common\Collections\ArrayCollection();
        $this->values = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Table
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Table
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set table_date
     *
     * @param \DateTime $tableDate
     * @return Table
     */
    public function setTableDate($tableDate)
    {
        $this->table_date = $tableDate;

        return $this;
    }

    /**
     * Get table_date
     *
     * @return \DateTime 
     */
    public function getTableDate()
    {
        return $this->table_date;
    }

    /**
     * Set column_label
     *
     * @param string $columnLabel
     * @return Table
     */
    public function setColumnLabel($columnLable)
    {
        $this->column_label = $columnLable;

        return $this;
    }

    /**
     * Get column_label
     *
     * @return string 
     */
    public function getColumnLabel()
    {
        return $this->column_label;
    }

    /**
     * Set row_label
     *
     * @param string $rowLabel
     * @return Table
     */
    public function setRowLabel($rowLable)
    {
        $this->row_label = $rowLable;

        return $this;
    }

    /**
     * Get row_label
     *
     * @return string 
     */
    public function getRowLabel()
    {
        return $this->row_label;
    }

    /**
     * Set column_count
     *
     * @param integer $columnCount
     * @return Table
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
     * @return Table
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
     * Set experiment
     *
     * @param \AppBundle\Entity\Experiment $experiment
     * @return Table
     */
    public function setExperiment(\AppBundle\Entity\Experiment $experiment = null)
    {
        $this->experiment = $experiment;

        return $this;
    }

    /**
     * Get experiment
     *
     * @return \AppBundle\Entity\Experiment 
     */
    public function getExperiment()
    {
        return $this->experiment;
    }

    /**
     * Add columns
     *
     * @param \AppBundle\Entity\Column $columns
     * @return Table
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
     * @return Table
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

    /**
     * Add values
     *
     * @param \AppBundle\Entity\Value $values
     * @return Table
     */
    public function addValue(\AppBundle\Entity\Value $values)
    {
        $this->values[] = $values;

        return $this;
    }

    /**
     * Remove values
     *
     * @param \AppBundle\Entity\Value $values
     */
    public function removeValue(\AppBundle\Entity\Value $values)
    {
        $this->values->removeElement($values);
    }

    /**
     * Get values
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set filing
     *
     * @param boolean $filing
     * @return Table
     */
    public function setFiling($filing)
    {
        $this->filing = $filing;

        return $this;
    }

    /**
     * Get filing
     *
     * @return boolean 
     */
    public function getFiling()
    {
        return $this->filing;
    }
}
