<?php

namespace Test;

use PHPUnit_Framework_TestCase as TestCase;

class SetTest extends TestCase {

  use InstanceWrapper;

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

  /**
   * Attribute Configuration - data provider
   *
   * initial attribute values
   *
   * fields:
   *  - [boolean] expected result
   *  - [string]  attribute name
   *  - [hash]    attribute configuration
   *
   * @return  array
   */
  function provider_initial_values() {
    $data[] = [ 20,  'age',  ['age'  => [ 'value' => 20]] ];
    $data[] = [ ['an', 'array', 'of', 'strings'],  'arrayProperty',  ['arrayProperty'  => [ 'value' => ['an', 'array', 'of', 'strings']]] ];

    return $this->instance_wrapper($data);
  }

  /**
   * @test
   * @dataProvider provider_initial_values
   */
  function Sets_Initial_Values($expected, $attribute, $config, $instance) {
    $this->assertSame($expected, $instance->$attribute);
  }

}
