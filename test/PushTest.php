<?php

namespace Test;

use PHPUnit_Framework_TestCase as TestCase;

class PushTest extends TestCase {

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
  public function provider_attributes_lists() {
    $data[] = [ 'name@example.com',  'recipients', ['recipients' => [ 'value' => []]] ];
    $data[] = [ 2007,                'years',      ['years'      => [ 'value' => [1999, 2000, 2001]]] ];

    return $this->instance_wrapper($data);
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
