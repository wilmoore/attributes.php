<?php

/**
 * attributes
 * Copyright(c) 2012 Wil Moore III <wil.moore@wilmoore.com>
 * MIT Licensed
 */

namespace Test\Unit\Meta\Attributes;
      use PHPUnit_Framework_TestCase as TestCase;
      use Meta\Attributes;

class HasTest extends TestCase {

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
  public function provider_attributes_configuration() {
    $data[] = [ false, 'email', [] ];
    $data[] = [ true,  'email', ['email' => []] ];
    $data[] = [ true,  'email', ['email' => ['value' => 'metaphp@example.com']] ];

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
  public function instance_wrapper($data) {
    return array_map(function($parameters){
      $attributes   = $parameters[2];
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
  public function Has_Expected_Attributes($expected, $attribute, $config, $instance) {
    $this->assertSame($expected, $instance->has($attribute));
  }

}
