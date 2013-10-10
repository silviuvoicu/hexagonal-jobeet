<?php

namespace Jobeet\Common\Domain\Model;

class EmailAddress extends AssertionConcern
{
    /**
     * @var string
     */
    private $anAddress;

    public function __construct($anAddress)
    {
        $this->assertNotEmpty($anAddress, 'The provided e-mail address is empty');
        $this->assertLengthIsLowerOrEqualThan($anAddress, 100, 'The provided e-mail address should lower than or equal to 100 characters');
        $this->assertSatisfiesFilters($anAddress, FILTER_VALIDATE_EMAIL, 'The provided address does not seem an email address');

        $this->anAddress = $anAddress;
    }

    /**
     * @param string $anAddress
     *
     * @return EmailAddress
     */
    public function setAddress($anAddress)
    {
        return new EmailAddress($anAddress);
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->anAddress;
    }

    public function __toString()
    {
        return $this->anAddress;
    }
}