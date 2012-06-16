<?php

/**
 * @copyright Copyright(c) 2012 Wil Moore III <wil.moore@wilmoore.com>
 * @license   MIT Licensed
 */

namespace Meta;
      use DateTime, DateTimezone;

/** a light-weight alternative to "Bean"-like getter, setters. */
trait Attributes
{

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
   * @param   string  $attribute  attribute name
   *
   * @api     public
   * @return  boolean
   */
  function has($attribute) {
    return array_key_exists($attribute, $this->__attributes);
  }

  /**
   * `propertyExists` determines if an attribute property has been set.
   *
   * @param   string  $attribute  attribute name
   * @param   string  $property   property name
   *
   * @api     public
   * @return  boolean
   */
  function propertyExists($attribute, $property) {
    return array_key_exists($attribute, $this->__attributes)
        && array_key_exists($property,  $this->__attributes[$attribute]);
  }

  /**
   * `__isset` determines if an attribute:
   * (1) has been defined
   * (2) has been set
   * (3) is not NULL
   *
   * @param   string  $attribute
   *
   * @return  boolean
   */
  function __isset($attribute) {
    return $this->propertyExists($attribute,  'value')
        && $this->getPropertyFor($attribute,  'value') !== null;
  }

  /**
   * `get` returns attributes value or, if attribute value is null, returns default value if given
   *
   * @param   string  $name     attribute name
   * @param   mixed   $default  [optional] default return value
   *
   * @return  mixed
   */
  function get($name, $default=null) {
    $map = array_map(function($name) use($default){
      if ($this->__isset($name)) {
        return $this->__attributes[$name]['value'];
      }

      return (null === $default) ? null : $default;
    }, (array) $name);

    return count($map) > 1 ? $map : $map[0];
  }

  /**
   * `__get` is an alias of `get`
   *
   * @param   string  $name     attribute name
   *
   * @return  mixed
   */
  function __get($name) {
    return $this->get($name);
  }

  /**
   * `set` attributes value
   *
   * @param   string  $attribute  attribute name
   * @param   mixed   $value      attribute value
   *
   * @return  $this
   */
  function set($attribute, $value) {
    $this->setPropertyFor($attribute, 'value', $value, 'set');
    return $this;
  }

  /**
   * `__set` is an alias of `set`
   *
   * @param   string  $attribute  attribute name
   * @param   mixed   $value      attribute value
   *
   * @return  $this->set()
   */
  function __set($name, $value) {
    return $this->set($name, $value);
  }

  /**
   * `__unset` clears an attribute's value
   *
   * @param   string  $attribute  attribute name
   *
   * @return  $this
   */
   function __unset($attribute) {
    $this->setPropertyFor($attribute, 'value', null, 'unset');
    return $this;
  }

  /**
   * `getPropertyFor` returns an attribute property by name
   *
   * @param   string  $attribute  attribute name
   * @param   string  $property   property name
   *
   * @return  boolean
   */
  private function getPropertyFor($attribute, $property) {
    return $this->propertyExists($attribute, $property)
         ? $this->__attributes[$attribute][$property]
         : null;
  }

  /**
   * `setPropertyFor` sets an attribute property value
   *
   * @param   string  $attribute  attribute name
   * @param   string  $property   property name
   * @param   mixed   $value      property value
   *
   * @return  boolean
   */
  private function setPropertyFor($attribute, $property, $value, $action) {
    if (! $this->has($attribute)) {return;}

    $this->__attributes[$attribute]['changes'][] = [
      'action' => $action,
      'from'   => $this->get($attribute),
      'to'     => $value,
      'when'   => $this->now()
    ];

    $this->__attributes[$attribute][$property]   = $value;
  }

  /**
   * `now` returns a DateTime object for "now" in the UTC timezone
   *
   * @return  DateTime
   */
   private function now() {
    return new DateTime('now', new DateTimezone('UTC'));
  }

}
