<?php

namespace Test;

use Test\SimpleEntity;

trait InstanceWrapper {

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
      $instance     = new SimpleEntity();
      $reflection   = new \ReflectionObject($instance);
      $__attributes = $reflection->getProperty('__attributes');
      $__attributes->setAccessible(true);
      $__attributes->setValue($instance, $attributes);
      $parameters[] = $instance;

      return $parameters;
    }, $data);
  }

}
