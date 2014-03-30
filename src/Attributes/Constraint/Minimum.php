<?php

namespace Metaphp\Attributes\Constraint;

class Minimum extends AbstractConstraint implements ConstraintInterface
{

    public function isValid($value)
    {
        return ($value >= $this->constraintProperty);
    }

}
