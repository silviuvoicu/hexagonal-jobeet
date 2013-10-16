<?php

namespace Jobeet\Finder\Domain\Model\Job;

use DateTime;
use Jobeet\Common\Domain\Model\AssertionConcern;
use Jobeet\Common\Domain\Model\EmailAddress;
use Jobeet\Finder\Domain\Model\Category\Category;

class Job extends AssertionConcern
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $position;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $how_to_apply;

    /**
     * @var string
     */
    private $token;

    /**
     * @var bool
     */
    private $is_public;

    /**
     * @var bool
     */
    private $is_activated = false;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var DateTime
     */
    private $expires_at;

    /**
     * @var DateTime
     */
    private $created_at;

    /**
     * @var DateTime
     */
    private $updated_at;

    /**
     * Class constructor
     *
     * @param Category $category
     * @param string   $company
     * @param string   $description
     * @param string   $email
     * @param DateTime $expiresAt
     * @param string   $howToApply
     * @param string   $location
     * @param string   $type
     * @param string   $logo
     * @param string   $url
     * @param string   $position
     * @param bool     $isPublic
     * @param bool     $isActivated
     * @param string   $token
     */
    public function __construct($category, $company, $description, $email, $expiresAt, $howToApply, $location, $type, $logo, $url, $position = null, $isPublic = true, $isActivated = false, $token = null)
    {
        $this->assertNotEmpty($company, 'The provided company name is empty');
        $this->assertNotEmpty($description, 'The provided description is empty');
        $this->assertLengthIsLowerOrEqualThan($description, 500, 'The description should be a text with a length of 500 chars');
        $this->assertNotEmpty($howToApply, 'The provided "how to apply" description is empty');
        $this->assertNotEmpty($location, 'The provided location is empty');
        $this->assertNotEmpty($type, 'The provided job type is empty');
        $this->assertNotEmpty($logo, 'The provided logo is empty');

        $this->category         = $category;
        $this->company          = $company;
        $this->description      = $description;
        $this->email            = new EmailAddress($email);
        $this->expires_at       = $expiresAt;
        $this->how_to_apply     = $howToApply;
        $this->is_public        = $isPublic;
        $this->is_activated     = $isActivated;
        $this->location         = $location;
        $this->type             = $type;
        $this->logo             = $logo;
        $this->url              = $url;
        $this->position         = $position;
        $this->token            = $token;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * @return string
     */
    public function getHowToApply()
    {
        return $this->how_to_apply;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * @return boolean
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Job
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Job
     */
    public function setCompany($company)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Job
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Job
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return Job
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Job
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Set how_to_apply
     *
     * @param string $howToApply
     * @return Job
     */
    public function setHowToApply($howToApply)
    {
        $this->how_to_apply = $howToApply;
    
        return $this;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Job
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

    /**
     * Set is_public
     *
     * @param boolean $isPublic
     * @return Job
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;
    
        return $this;
    }

    /**
     * Set is_activated
     *
     * @param boolean $isActivated
     * @return Job
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Job
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Set expires_at
     *
     * @param \DateTime $expiresAt
     * @return Job
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expires_at = $expiresAt;
    
        return $this;
    }

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return Job
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }
}