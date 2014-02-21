<?php

namespace Metaphp\Attributes\Constraint;

abstract class AbstractConstraint implements ConstraintInterface
{

    protected $constraintProperty = null;

    public function __construct($constraintProperty)
    {
        $this->constraintProperty = $constraintProperty;
    }

    abstract public function isValid($value);

}
