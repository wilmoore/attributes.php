<?php

/**
 * Copyright(c) 2012 Wil Moore III <wil.moore@wilmoore.com>
 * MIT Licensed
 */

namespace Test\Unit\Meta\Attributes;
      use PHPUnit_Framework_TestCase as TestCase;
      use Meta\Attributes;

class SetTest extends TestCase {

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
    $data[] = [ true, 	'employed', 		['employed' => []] ];
    $data[] = [ false, 	'married', 			['married' 	=> []] ];

    $data[] = [ 35, 		'age', 					['age' 			=> []] ];
    $data[] = [ 3, 			'children', 		['children' => []] ];
    $data[] = [ 0, 			'pets', 				['pets' 		=> []] ];

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
  function Can_Set_Value($expected, $attribute, $config, $instance) {
		$instance->set($attribute, $expected);
    $this->assertEquals($expected, $instance->get($attribute));
  }

}
