<?php

/**
 * Copyright(c) 2012 Wil Moore III <wil.moore@wilmoore.com>
 * MIT Licensed
 */

namespace Meta;
      use OutOfBoundsException;

class KeyException extends OutOfBoundsException {

  static function notSetNoDefaultNoFallback($attribute) { 
    throw new self("Attribute '$attribute' has not been set, has no default value, and no fallback default was given.");
  }

}

trait Attributes {
  /**
   * @var []
   *
   * val
   * default
   * accepts
   * regex
   * validator
   * changes
   */
  private $__attributes = [];

  /**
   * `has` determins if an attribute "has" been defined
   *
   * @param   string  $name     attribute name
   *
   * @api     public
   * @return  boolean
   */
  function has($name) { return array_key_exists($name, $this->__attributes); }

  /**
   * `propertySet` determins if an attribute property has been set.
   *
   * @param   string  $name   attribute name
   * @param   string  $key    [optional] attribute property name
   *
   * @api     public
   * @return  boolean
   */
  function propertySet($name, $key) {
    return array_key_exists($name, $this->__attributes)
        && array_key_exists($key,  $this->__attributes[$name]);
  }

  /**
   * `__isset` determines if an attribute:
   * (1) has been defined
   * (2) has benn set
   * (3) is not NULL
   *
   * @param   string  $name
   *
   * @return  boolean
   */
  function __isset($name) {
    return $this->propertySet($name,  'value')
        && $this->__attributes[$name]['value'] !== null;
  }

  function __get($name) {
    return ($this->__isset($name))
         ? $this->__attributes[$name]['value']
         : null;
  }

  function __unset($name) {
  }

  function __set($name, $value) {
  }

}
