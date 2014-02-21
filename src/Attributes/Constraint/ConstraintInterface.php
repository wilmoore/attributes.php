<?php

namespace Metaphp\Attributes\Constraint;

interface ConstraintInterface
{
    public function isValid($value);

}
