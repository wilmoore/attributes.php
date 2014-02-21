<?php

namespace Test;

use PHPUnit_Framework_TestCase as TestCase;

class GetTest extends TestCase {

  use InstanceWrapper;

  /**
   * Attribute Configuration - data provider
   *
   * fields:
   *  - [boolean] expected result
   *  - [string]  attribute name
   *  - [hash]    object instance
   *
   * @return  array
   */
  function provider_attributes_configuration() {
    $data[] = [ null,             'email',            '',               [] ];
    $data[] = [ 'd@example.com',  'email',            'd@example.com',  ['email' => []] ];
    $data[] = [ 'm@example.com',  'email',            '',               ['email' => ['value' => 'm@example.com']] ];
    $data[] = [ ['John', 'Doe'],  ['first', 'last'],  null,             ['first' => ['value' => 'John'], 'last' => ['value' => 'Doe']] ];

    return $this->instance_wrapper($data);
  }

  /**
   * Attribute Configuration - data provider
   *
   * fields:
   *  - [boolean] expected result
   *  - [string]  attribute name
   *  - [hash]    object instance
   *
   * @return  array
   */
  function provider_attributes_configuration_with_types() {
    $data[] = [ true,   'employed', ['employed' => ['type' => 'boolean']] ];
    $data[] = [ false,  'married',  ['married'  => ['type' => 'boolean']] ];

    $data[] = [ 35,     'age',      ['age'      => ['type' => 'integer']] ];
    $data[] = [ 3,      'children', ['children' => ['type' => 'integer']] ];
    $data[] = [ 0,      'pets',     ['pets'     => ['type' => 'integer']] ];

    return $this->instance_wrapper($data);
  }

  /**
   * @test
   * @dataProvider provider_attributes_configuration
   */
  function Returns_Expected_Value($expected, $attribute, $default, $config, $instance) {
    $this->assertEquals($expected, $instance->get($attribute, $default));
  }

  /**
   * @test
   * @dataProvider provider_attributes_configuration_with_types
   */
  function Sets_Typed_Value($expected, $attribute, $config, $instance) {
    $instance->set($attribute, $expected);
    $this->assertEquals($expected, $instance->get($attribute));
  }

}
