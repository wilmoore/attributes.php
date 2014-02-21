<?php

namespace Test\Constraint;

use PHPUnit_Framework_TestCase as TestCase;

class AcceptsTest extends TestCase
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
            $instance = new \Metaphp\Attributes\Constraint\Accepts($constraint);
            $parameters[] = $instance;

            return $parameters;
        }, $data);
    }

    /**
     * attribute accepts array
     *
     * fields:
     *  - [array] accepts constraint
     *  - [mixed] value to test
     *
     * @return array
     */
    public function providerInvalidValuesAgainstListArray()
    {
        $data[] = [[true, false], '1'];
        $data[] = [[true, false], 'false'];
        $data[] = [[true, false], 'true'];
        $data[] = [['clubs', 'diamonds', 'hearts', 'spades'], true];
        $data[] = [['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'], 9789];
//        $data[] = ['^element-property-', 'props'];

        return $this->instanceWrapper($data);
    }

    /**
     * @test
     * @dataProvider providerInvalidValuesAgainstListArray
     */
    function invalidValuesAgainstListArray($constraint, $value, $instance)
    {
        $this->assertFalse($instance->isValid($value));
    }

    /**
     * attribute accepts array
     *
     * fields:
     *  - [array] accepts constraint
     *  - [mixed] value to test
     *
     * @return array
     */
    public function providerValidValuesAgainstListArray()
    {
        $data[] = [[true, false], true];
        $data[] = [[true, false], false];
        $data[] = [['clubs', 'diamonds', 'hearts', 'spades'], 'clubs'];
        $data[] = [['clubs', 'diamonds', 'hearts', 'spades'], 'spades'];
        $data[] = [['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'], 'wed'];

        return $this->instanceWrapper($data);
    }

    /**
     * @test
     * @dataProvider providerValidValuesAgainstListArray
     */
    function validValuesAgainstListArray($constraint, $value, $instance)
    {
        $this->assertTrue($instance->isValid($value));
    }

    /**
     * attribute accepts array
     *
     * fields:
     *  - [array] accepts constraint
     *  - [mixed] value to test
     *
     * @return array
     */
    public function providerInvalidValuesAgainstRange()
    {
        $data[] = ['0..120', -50];
        $data[] = ['1900..2014', 2500];
        $data[] = ['1900..2014', 2014.0]; // strict type checking...
        $data[] = ['1900..2014', '1950']; // strict type checking...

        return $this->instanceWrapper($data);
    }

    /**
     * @test
     * @dataProvider providerInvalidValuesAgainstRange
     */
    function invalidValuesAgainstRange($constraint, $value, $instance)
    {
        $this->assertFalse($instance->isValid($value));
    }

    /**
     * attribute accepts array
     *
     * fields:
     *  - [array] accepts constraint
     *  - [mixed] value to test
     *
     * @return array
     */
    public function providerValidValuesAgainstRange()
    {
        $data[] = ['0..120', 0];
        $data[] = ['1900..2014', 2014];
        $data[] = ['-100..100', -100];
        $data[] = ['-100..100', 0];
        $data[] = ['-100..100', 100];
        $data[] = ['-100..-10', -55];

        return $this->instanceWrapper($data);
    }

    /**
     * @test
     * @dataProvider providerValidValuesAgainstRange
     */
    function validValuesAgainstRange($constraint, $value, $instance)
    {
        $this->assertTrue($instance->isValid($value));
    }

}
