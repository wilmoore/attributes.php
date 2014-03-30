<?php

namespace Test\Constraint;

use PHPUnit_Framework_TestCase as TestCase;

class MaximumTest extends TestCase
{

    /**
     * Object Instance Wrapper
     *
     * adds an object instance to each incoming hash
     *
     * @param   array   attribute data provider configuration
     *
     * @return  array
     */
    function instanceWrapper($data)
    {
        return array_map(function($parameters) {
            $constraint = $parameters[0];
            $instance = new \Metaphp\Attributes\Constraint\Maximum($constraint);
            $parameters[] = $instance;

            return $parameters;
        }, $data);
    }

    /**
     * attribute exceeds maximum
     *
     * fields:
     *  - [numeric] maximum constraint
     *  - [mixed] value to test
     *
     * @return array
     */
    public function providerInvalidValues()
    {
        $data[] = [100, '101'];
        $data[] = [100, '100.1'];
        $data[] = [-100, '-99.9'];
        $data[] = [100, 101];
        $data[] = [100, 100.1];
        $data[] = [-100, -99.9];
        $data[] = [0, '0.1'];
        $data[] = [0, 0.1];
//        $data[] = ['^element-property-', 'props'];

        return $this->instanceWrapper($data);
    }

    /**
     * @test
     * @dataProvider providerInvalidValues
     */
    function invalidValues($constraint, $value, $instance)
    {
        $this->assertFalse($instance->isValid($value));
    }

    /**
     * attribute equal to or less than maximum
     *
     * fields:
     *  - [numeric] accepts constraint
     *  - [mixed] value to test
     *
     * @return array
     */
    public function providerValidValues()
    {
        $data[] = [100, '100'];
        $data[] = [100, '100.0'];
        $data[] = [100, '99.9'];
        $data[] = [100, 100];
        $data[] = [100, 100.0];
        $data[] = [100, 99.9];
        $data[] = [-100, '-200'];
        $data[] = [-100, '-100'];
        $data[] = [-100, '-100.0'];
        $data[] = [-100, -200];
        $data[] = [-100, -100];
        $data[] = [-100, -100.0];
        $data[] = [0, '-0.1'];
        $data[] = [0, -0.1];

        return $this->instanceWrapper($data);
    }

    /**
     * @test
     * @dataProvider providerValidValues
     */
    function validValues($constraint, $value, $instance)
    {
        $this->assertTrue($instance->isValid($value));
    }

}
