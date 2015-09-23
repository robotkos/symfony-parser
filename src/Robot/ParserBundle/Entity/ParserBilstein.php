<?php

namespace Robot\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParserBilstein
 */
class ParserBilstein
{
    /**
     * @var string
     */
    private $pn;

    /**
     * @var string
     */
    private $oldPn;

    /**
     * @var string
     */
    private $descr;

    /**
     * @var string
     */
    private $img;

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
    public function setPn($pn)
    {
        $this->pn = $pn;

        return $this;
    }

    /**
     * Get pn
     *
     * @return string 
     */
    public function getPn()
    {
        return $this->pn;
    }

    /**
     * Set oldPn
     *
     * @param string $oldPn
     * @return ParserBilstein
     */
    public function setOldPn($oldPn)
    {
        $this->oldPn = $oldPn;

        return $this;
    }

    /**
     * Get oldPn
     *
     * @return string 
     */
    public function getOldPn()
    {
        return $this->oldPn;
    }

    /**
     * Set descr
     *
     * @param string $descr
     * @return ParserBilstein
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;

        return $this;
    }

    /**
     * Get descr
     *
     * @return string 
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return ParserBilstein
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
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
