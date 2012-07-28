<?php

/**
 * Copyright(c) 2012 Wil Moore III <wil.moore@wilmoore.com>
 * MIT Licensed
 */

namespace Test\Unit\Meta\Attributes;
      use PHPUnit_Framework_TestCase as TestCase;
      use Meta\Attributes;

class GetTest extends TestCase {

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
