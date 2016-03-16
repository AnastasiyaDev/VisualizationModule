<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cell_values")
 */
class CellValue extends BaseEntity{

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $value_float;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $value_string;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $value;

//    /**
//     * @ORM\ManyToOne(targetEntity="Table",inversedBy="values")
//     * @ORM\JoinColumn(name="table_id", referencedColumnName="id")
//     */
//    private $table;

    /**
     * @ORM\ManyToOne(targetEntity="Column",inversedBy="values")
     * @ORM\JoinColumn(name="col_id", referencedColumnName="id")
     */
    private $column;

    /**
     * @ORM\ManyToOne(targetEntity="Row",inversedBy="values")
     * @ORM\JoinColumn(name="row_id", referencedColumnName="id")
     */
    private $row;

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
     * Set value
     *
     * @param string $value
     * @return Value
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set column
     *
     * @param \AppBundle\Entity\Column $column
     * @return CellValue
     */
    public function setColumn(\AppBundle\Entity\Column $column = null)
    {
        $this->column = $column;

        return $this;
    }

    /**
     * Get column
     *
     * @return \AppBundle\Entity\Column 
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Set row
     *
     * @param \AppBundle\Entity\Row $row
     * @return CellValue
     */
    public function setRow(\AppBundle\Entity\Row $row = null)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * Get row
     *
     * @return \AppBundle\Entity\Row 
     */
    public function getRow()
    {
        return $this->row;
    }
//
//    public function valFloatOrString(){
//
//        if ( gettype( $this->value ) == "double")
//            return  $value_float = 1;
//        else if ( gettype( $this->value ) == "string")
//            return  $value_string = 1;
//        else return $value_float = 0 && $value_string = 0;
//    }
}
