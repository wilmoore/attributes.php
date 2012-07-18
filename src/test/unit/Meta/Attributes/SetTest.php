<?php

/**
 * Copyright(c) 2012 Wil Moore III <wil.moore@wilmoore.com>
 * MIT Licensed
 */

namespace Test\Unit\Meta\Attributes;
      use PHPUnit_Framework_TestCase as TestCase;
      use Meta\Attributes;

class SetTest extends TestCase {

  /**
   * Attribute Configuration - data provider
   *
   * fields:
   *  - [boolean] expected result
   *  - [string]  attribute name
   *  - [hash]    attribute configuration
   *
   * @return  array
   */
  function provider_attributes() {
    $data[] = [ true,   'employed', ['employed' => []] ];
    $data[] = [ false,  'married',  ['married'  => []] ];

    $data[] = [ 35,     'age',      ['age'      => []] ];
    $data[] = [ 3,      'children', ['children' => []] ];
    $data[] = [ 0,      'pets',     ['pets'     => []] ];

    return $this->instance_wrapper($data);
  }

  /**
   * Attribute Configuration - data provider
   *
   * attribute accepts array
   *
   * fields:
   *  - [boolean] expected result
   *  - [string]  attribute name
   *  - [hash]    attribute configuration
   *
   * @return  array
   */
  function provider_acceptable_values_list_array() {
    $data[] = [ '1',      'employed', ['employed' => [ 'accepts' => [true, false] ]] ];
    $data[] = [ 'false',  'married',  ['married'  => [ 'accepts' => [true, false] ]] ];

    $data[] = [ true,     'cardsuit', ['cardsuit' => [ 'accepts' => ['clubs', 'diamonds', 'hearts', 'spades'] ]] ];
    $data[] = [ 9789,     'days',     ['days'     => [ 'accepts' => ['sun', 'mon', 'tue', 'web', 'thu', 'fri', 'sat'] ]] ];

    $data[] = [ 'props',  'id',       ['id'       => [ 'accepts' => '^element-property-' ]] ];

    return $this->instance_wrapper($data);
  }

  /**
   * Attribute Configuration - data provider
   *
   * attribute accepts range
   *
   * fields:
   *  - [boolean] expected result
   *  - [string]  attribute name
   *  - [hash]    attribute configuration
   *
   * @return  array
   */
  function provider_acceptable_values_range() {
    $data[] = [ 200,  'age',  ['age'  => [ 'accepts' => '1..120'     ]] ];
    $data[] = [ 'Y',  'year', ['year' => [ 'accepts' => '1900..2012' ]] ];

    return $this->instance_wrapper($data);
  }

  /**
   * Attribute Configuration - data provider
   *
   * fields:
   *  - [boolean] expected result
   *  - [string]  attribute name
   *  - [hash]    attribute => value
   *
   * @return  array
   */
  function provider_attributes_hash() {
    $fname  = 'Ricky';
    $lname  = 'Bobby';
    $email  = 'ricky.bobby@example.com';
    $depts  = ['sales', 'marketing', 'tech'];

    $hash   = compact('fname', 'lname', 'email', 'depts');
    $config = ['fname' => [], 'lname' => [], 'email' => [], 'depts' => []];

    $data[] = [$fname, 'fname', $hash, $config];
    $data[] = [$lname, 'lname', $hash, $config];
    $data[] = [$email, 'email', $hash, $config];
    $data[] = [$depts, 'depts', $hash, $config];

    return $this->instance_wrapper($data);
  }

  /**
   * Object Instance Wrapper
   *
   * adds an object instance to each incoming hash
   *
   * @param   array   attribute data provider configuration
   *
   * @return  array
   */
  function instance_wrapper($data) {
    return array_map(function($parameters){
      $attributes   = $parameters[count($parameters)-1];
      $instance     = $this->getObjectForTrait('Meta\Attributes');
      $reflection   = new \ReflectionObject($instance);
      $__attributes = $reflection->getProperty('__attributes');
      $__attributes->setAccessible(true);
      $__attributes->setValue($instance, $attributes);
      $parameters[] = $instance;

      return $parameters;
    }, $data);
  }

  /**
   * @test
   * @dataProvider provider_attributes
   */
  function Can_Set_Value($expected, $attribute, $config, $instance) {
    $instance->set($attribute, $expected);
    $this->assertEquals($expected, $instance->get($attribute));
  }

  /**
   * @test
   * @dataProvider provider_attributes_hash
   */
  function Can_Set_Value_Via_Hash($expected, $attribute, $hash, $config, $instance) {
    $instance->set($hash);
    $this->assertEquals($expected, $instance->get($attribute));
  }

  /**
   * @test
   * @dataProvider      provider_acceptable_values_list_array
   * @expectedException InvalidArgumentException
   */
  function Values_Set_Limited_By_Acceptable_Values_List_Array($expected, $attribute, $config, $instance) {
    $instance->set($attribute, $expected);
  }

  /**
   * @test
   * @dataProvider      provider_acceptable_values_range
   * @expectedException InvalidArgumentException
   */
  function Values_Set_Limited_By_Acceptable_Values_Range($expected, $attribute, $config, $instance) {
    $instance->set($attribute, $expected);
  }

}
