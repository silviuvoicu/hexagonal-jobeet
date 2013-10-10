<?php

namespace Jobeet\Common\Domain\Model;

use DomainException;

class AssertionConcern
{
    public function assertNotEmpty($value, $message)
    {
        if(empty($value)) {
            throw new DomainException($message);
        }
    }

    public function assertTrue($condition, $message)
    {
        if(!$condition) {
            throw new DomainException($message);
        }
    }

    public function assertSatisfiesFilters($value, $filters, $message)
    {
        if (!filter_var($value, $filters)) {
            throw new DomainException($message);
        }
    }

    public function assertLengthIsLowerOrEqualThan($string, $expectedLength, $message)
    {
        if (strlen($string) > $expectedLength) {
            throw new DomainException($message);
        }
    }
}