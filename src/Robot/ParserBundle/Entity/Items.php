<?php

namespace Robot\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Items
 */
class Items
{
    /**
     * @var integer
     */
    private $parserId;

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
     * Set parserId
     *
     * @param integer $parserId
     * @return Items
     */
    public function setParserId($parserId)
    {
        $this->parserId = $parserId;

        return $this;
    }

    /**
     * Get parserId
     *
     * @return integer 
     */
    public function getParserId()
    {
        return $this->parserId;
    }

    /**
     * Set pn
     *
     * @param string $pn
     * @return Items
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
     * @return Items
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
     * @return Items
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
     * @return Items
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
