<?php

namespace Test;

use PHPUnit_Framework_TestCase as TestCase;
use Test\SimpleEntity;

class InitializeTest extends TestCase {

  use InstanceWrapper;

  /**
   * Attribute Configuration - data provider (isset)
   *
   * fields:
   *  - [boolean] expected result
   *  - [string]  attribute name
   *  - [hash]    object instance
   *
   * @return  array
   */
  public function provider_attributes_configuration() {
    $data[] = [ false, 'email', 'value', [] ];
    $data[] = [ false, 'email', 'value', ['email' => []] ];
    $data[] = [ true,  'email', 'value', ['email' => ['value' => '']] ];
    $data[] = [ true,  'email', 'value', ['email' => ['value' => 'metaphp@example.com']] ];

    return $this->instance_wrapper($data);
  }

  /** @test */
  public function Initial_Attributes_Hash_Is_Empty() {
    $instance = new SimpleEntity();
    $this->assertAttributeEmpty('__attributes', $instance);

    return $instance;
  }

  /**
   * @test
   * @dataProvider provider_attributes_configuration
   */
  public function Expected_Attribute_Isset($expected, $attribute, $property, $config, $instance) {
    $this->assertSame($expected, $instance->propertyExists($attribute, $property));
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
