<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="columns")
 */
class Column extends NameEntity{

    /**
     * @ORM\ManyToOne(targetEntity="Table",inversedBy="columns")
     * @ORM\JoinColumn(name="table_id", referencedColumnName="id")
     */
    private $table;


    /**
     * @ORM\OneToMany(targetEntity="CellValue", mappedBy="column", cascade={"all"}, orphanRemoval=true, fetch="LAZY")
     */
    private $values;



    /**
     * Set table
     *
     * @param \AppBundle\Entity\Table $table
     * @return Column
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
     * Set value
     *
     * @param \AppBundle\Entity\Value $value
     * @return Column
     */
    public function setValue(\AppBundle\Entity\Value $value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return \AppBundle\Entity\Value 
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->values = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add values
     *
     * @param \AppBundle\Entity\CellValue $values
     * @return Column
     */
    public function addValue(\AppBundle\Entity\CellValue $values)
    {
        $this->values[] = $values;

        return $this;
    }

    /**
     * Remove values
     *
     * @param \AppBundle\Entity\CellValue $values
     */
    public function removeValue(\AppBundle\Entity\CellValue $values)
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
}
