<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tables")
 */
class Table extends BaseEntity{

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $column_lable;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $row_lable;

    /**
     * @ORM\ManyToMany(targetEntity="User",mappedBy="experiments",fetch="LAZY")
     */
    private $users;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set column_lable
     *
     * @param string $columnLable
     * @return Table
     */
    public function setColumnLable($columnLable)
    {
        $this->column_lable = $columnLable;

        return $this;
    }

    /**
     * Get column_lable
     *
     * @return string 
     */
    public function getColumnLable()
    {
        return $this->column_lable;
    }

    /**
     * Set row_lable
     *
     * @param string $rowLable
     * @return Table
     */
    public function setRowLable($rowLable)
    {
        $this->row_lable = $rowLable;

        return $this;
    }

    /**
     * Get row_lable
     *
     * @return string 
     */
    public function getRowLable()
    {
        return $this->row_lable;
    }

    /**
     * Add users
     *
     * @param \AppBundle\Entity\User $users
     * @return Table
     */
    public function addUser(\AppBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \AppBundle\Entity\User $users
     */
    public function removeUser(\AppBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
