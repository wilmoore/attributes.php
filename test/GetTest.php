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
  function provider_attributes_default() {
    $data[] = [ 'm@example.com', null, 'email', ['email' => ['default' => 'm@example.com']] ];
    $data[] = [ 'm@example.com', 'm@md.com', 'email', ['email' => ['default' => 'm@example.com', 'value' => 'm@md.com']] ];

    return $this->instance_wrapper($data);
  }

  /**
   * @test
   * @dataProvider provider_attributes_default
   * 
   * @todo I'm not liking how this test is written. Look to improve.
   */
  function Returns_Default_Value($default, $initialValue, $attribute, $config, $instance) {
    // Attribute is set to initial value, or default if initial value is null
    $this->assertTrue((isset($instance->$attribute) ? ($initialValue === $instance->$attribute) : ($default === $instance->$attribute)));

    $newValue = 'some.new.value';

    // The new value is not the same as the default or initial values
    $this->assertNotSame($newValue, $default);
    $this->assertNotSame($newValue, $initialValue);

    // Set and check the new value
    $instance->set($attribute, $newValue);
    $this->assertSame($newValue, $instance->get($attribute));

    // Unset and check that new value is no longer set, no value is set, and default is now returned
    unset($instance->$attribute);
    $this->assertNotSame($newValue, $instance->get($attribute));
    $this->assertFalse(isset($instance->$attribute));
    $this->assertSame($default, $instance->get($attribute));
  }

}
