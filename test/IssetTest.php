<?php

namespace Test;

use PHPUnit_Framework_TestCase as TestCase;

class IssetTest extends TestCase {

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
