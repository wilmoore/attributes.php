<?php

namespace Test;

use PHPUnit_Framework_TestCase as TestCase;
use Test\SimpleEntity;

class PushTest extends TestCase {

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
  public function provider_attributes_lists() {
    $data[] = [ 'name@example.com',  'recipients', ['recipients' => [ 'value' => []]] ];
    $data[] = [ 2007,                'years',      ['years'      => [ 'value' => [1999, 2000, 2001]]] ];

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
   * @dataProvider provider_attributes_lists
   */
  public function Pushed_Value_Into_Array_Attributes($expected, $attribute, $config, $instance) {
    $instance->push($attribute, $expected);

    $value  = $instance->get($attribute);
    $actual = array_pop($value);

    $this->assertEquals($expected, $actual);
  }

}
