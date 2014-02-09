<?php

namespace Test;

use PHPUnit_Framework_TestCase as TestCase;
use Test\SimpleEntity;

class InitializeTest extends TestCase {

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

  /**
   * Object Instance Wrapper
   *
   * adds an object instance to each incoming hash
   *
   * @param   array   attribute data provider configuration
   * @return  array
   */
  public function instance_wrapper($data) {
    return array_map(function($parameters){
      $attributes   = $parameters[count($parameters)-1];
      $instance     = new SimpleEntity();
      $reflection   = new \ReflectionObject($instance);
      $__attributes = $reflection->getProperty('__attributes');
      $__attributes->setAccessible(true);
      $__attributes->setValue($instance, $attributes);
      $parameters[] = $instance;

      return $parameters;
    }, $data);
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

}
