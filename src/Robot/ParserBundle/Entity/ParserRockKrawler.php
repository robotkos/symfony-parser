<?php

namespace Robot\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParserBilstein
 */
class ParserRockKrawler
{
    /**
     * @var string
     */
    private $part_number;

    /**
     * @var string
     */
    private $includes;

    /**
     * @var string
     */
    private $notes;


    /**
     * @var integer
     */
    private $id;


    /**
     * Set pn
     *
     * @param string $pn
     * @return ParserBilstein
     */
    public function setpart_number($part_number)
    {
        $this->part_number = $part_number;

        return $this;
    }

    /**
     * Get pn
     *
     * @return string 
     */
    public function getpart_number()
    {
        return $this->part_number;
    }

    /**
     * Set oldPn
     *
     * @param string $oldPn
     * @return ParserBilstein
     */
    public function setincludes($includes)
    {
        $this->oldPn = $includes;

        return $this;
    }

    /**
     * Get oldPn
     *
     * @return string 
     */
    public function getincludes()
    {
        return $this->includes;
    }

    /**
     * Set descr
     *
     * @param string $descr
     * @return ParserBilstein
     */
    public function setnotes($notes)
    {
        $this->descr = $notes;

        return $this;
    }

    /**
     * Get descr
     *
     * @return string 
     */
    public function getnotes()
    {
        return $this->notes;
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
