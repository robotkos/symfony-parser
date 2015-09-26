<?php

namespace Robot\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parsers
 */
class Parsers
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $parts;

    /**
     * @var boolean
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $dateStart;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     * @return Parsers
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set parts
     *
     * @param string $parts
     * @return Parsers
     */
    public function setParts($parts)
    {
        $this->parts = $parts;

        return $this;
    }

    /**
     * Get parts
     *
     * @return string 
     */
    public function getParts()
    {
        return $this->parts;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Parsers
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Parsers
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
