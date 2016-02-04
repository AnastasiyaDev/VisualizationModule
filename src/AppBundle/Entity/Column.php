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
     * @ORM\ManyToOne(targetEntity="Value",inversedBy="columns")
     * @ORM\JoinColumn(name="value_id", referencedColumnName="id")
     */
    private $value;



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
}
