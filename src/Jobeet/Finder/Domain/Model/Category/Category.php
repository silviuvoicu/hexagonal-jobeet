<?php

namespace Jobeet\Finder\Domain\Model\Category;

use Jobeet\Common\Domain\Model\AssertionConcern;

class Category extends AssertionConcern
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * Class constructor
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->assertNotEmpty($name, 'The provided name must not be empty');

        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}