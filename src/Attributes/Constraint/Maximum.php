<?php

namespace Metaphp\Attributes\Constraint;

class Maximum extends AbstractConstraint implements ConstraintInterface
{

    public function isValid($value)
    {
        return ($value <= $this->constraintProperty);
    }

}
