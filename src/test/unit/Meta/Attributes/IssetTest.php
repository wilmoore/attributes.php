<?php

/**
 * Copyright(c) 2012 Wil Moore III <wil.moore@wilmoore.com>
 * MIT Licensed
 */

namespace Test\Unit\Meta\Attributes;

require_once dirname(__DIR__) . '/TestAsset/SimpleEntity.php';

use PHPUnit_Framework_TestCase as TestCase;
use Test\Unit\Meta\TestAsset\SimpleEntity;

class IssetTest extends TestCase {

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
  public function provider_attributes_configuration_isset() {
    $data[] = [ false, 'email', [] ];
    $data[] = [ false, 'email', ['email' => []] ];
    $data[] = [ true,  'email', ['email' => ['value' => '']] ];
    $data[] = [ true,  'email', ['email' => ['value' => 'metaphp@example.com']] ];

    return $this->instance_wrapper($data);
  }

  /**
   * Attribute Configuration - data provider (empty)
   *
   * fields:
   *  - [boolean] expected result
   *  - [string]  attribute name
   *  - [hash]    object instance
   *
   * @return  array
   */
  public function provider_attributes_configuration_empty() {
    $data[] = [ true,  'email', [] ];
    $data[] = [ true,  'email', ['email' => []] ];
    $data[] = [ true,  'email', ['email' => ['value' => '']] ];
    $data[] = [ false, 'email', ['email' => ['value' => 'metaphp@example.com']] ];

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

  /**
   * @test
   * @dataProvider provider_attributes_configuration_isset
   */
  public function Expected_Attribute_Isset($expected, $attribute, $config, $instance) {
    $this->assertSame($expected, isset($instance->$attribute));
  }

  /**
   * @test
   * @dataProvider provider_attributes_configuration_empty
   */
  public function Expected_Attribute_Empty($expected, $attribute, $config, $instance) {
    $this->assertSame($expected, empty($instance->$attribute));
  }

}
