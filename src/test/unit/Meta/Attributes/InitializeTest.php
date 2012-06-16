<?php

/**
 * Copyright(c) 2012 Wil Moore III <wil.moore@wilmoore.com>
 * MIT Licensed
 */

namespace Test\Unit\Meta\Attributes;
      use PHPUnit_Framework_TestCase as TestCase;
      use Meta\Attributes;

class InitializeTest extends TestCase {

  /** @test */
  public function Initial_Attributes_Hash_IsEmpty() {
    $instance = $this->getObjectForTrait('Meta\Attributes');
    $this->assertAttributeEmpty('__attributes', $instance);

    return $instance;
  }

}
