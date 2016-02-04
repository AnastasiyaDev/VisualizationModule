<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="values")
 */
class Value extends BaseEntity{

    /**
     * @ORM\Column(type="boolean")
     */
    private $value_float;

    /**
     * @ORM\Column(type="boolean")
     */
    private $value_string;

    /**
     * @ORM\ManyToOne(targetEntity="Table",inversedBy="values")
     * @ORM\JoinColumn(name="table_id", referencedColumnName="id")
     */
    private $table;

    /**
     * @ORM\OneToMany(targetEntity="Column", mappedBy="value", cascade={"all"}, orphanRemoval=true, fetch="LAZY")
     */
    private $columns;

    /**
     * @ORM\OneToMany(targetEntity="Row", mappedBy="value", cascade={"all"}, orphanRemoval=true, fetch="LAZY")
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
     * Set value_float
     *
     * @param boolean $valueFloat
     * @return Value
     */
    public function setValueFloat($valueFloat)
    {
        $this->value_float = $valueFloat;

        return $this;
    }

    /**
     * Get value_float
     *
     * @return boolean 
     */
    public function getValueFloat()
    {
        return $this->value_float;
    }

    /**
     * Set value_string
     *
     * @param boolean $valueString
     * @return Value
     */
    public function setValueString($valueString)
    {
        $this->value_string = $valueString;

        return $this;
    }

    /**
     * Get value_string
     *
     * @return boolean 
     */
    public function getValueString()
    {
        return $this->value_string;
    }

    /**
     * Set table
     *
     * @param \AppBundle\Entity\Table $table
     * @return Value
     */
    public function setTable(\AppBundle\Entity\Table $table = null)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get table
     *
     * @return \AppBundle\Entity\Table 
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Add columns
     *
     * @param \AppBundle\Entity\Column $columns
     * @return Value
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
     * @return Value
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
