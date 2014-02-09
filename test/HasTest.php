<?php

namespace Test;

use PHPUnit_Framework_TestCase as TestCase;

class HasTest extends TestCase {

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
  public function provider_attributes_configuration() {
    $data[] = [ false, 'email', [] ];
    $data[] = [ true,  'email', ['email' => []] ];
    $data[] = [ true,  'email', ['email' => ['value' => 'metaphp@example.com']] ];

    return $this->instance_wrapper($data);
  }

  /**
   * @test
   * @dataProvider provider_attributes_configuration
   */
  public function Has_Expected_Attributes($expected, $attribute, $config, $instance) {
    $this->assertSame($expected, $instance->has($attribute));
  }

}
