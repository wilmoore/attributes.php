<?php

namespace Metaphp\Attributes\Constraint;

class Accepts extends AbstractConstraint implements ConstraintInterface
{

    public function isValid($value)
    {
        $accepts = $this->constraintProperty;

        // array list
        if (is_array($accepts)) {
            return in_array($value, $accepts, true);
        } elseif (is_string($accepts)) {
            // numeric range
            if (preg_match('/^(?P<start>-*\d+)[.][.](?P<limit>-*\d+)$/', $accepts, $matches)) {
//$range = range($matches['start'], $matches['limit'], 1);
//echo "Range: " . print_r($range, true) . PHP_EOL;
//exit;
                return in_array($value, range($matches['start'], $matches['limit'], 1), true);
            } else {
                return preg_match("/{$accepts}/u", $value);
            }
        }

        // static class constant
        // class contant prefix

        return true;
    }

}
