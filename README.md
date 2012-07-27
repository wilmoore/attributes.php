PHP object attributes without the setter, getter boilerplate
============================================================

[![Build Status](https://secure.travis-ci.org/metaphp/attributes.png?branch=master)](http://travis-ci.org/metaphp/attributes)

For non-trivial PHP applications, ceremony and cruft accumulation can be difficult to mitigate. `Meta\attributes` (**attributes**) eliminates some of the ceremony while still allowing for maintainable/testable code.

**Attributes** does require some definition; however, the syntax is much lighter than typing the following for every property:

    protected $property = null;
    public function setProperty(){}
    public function getProperty(){}

That's not all...you will start to see a significant code reduction when using functionality such as the `accepts` syntax which will `throw` out unacceptable values. This mitigates the need for the following boilerplate:

    protected $days = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

    /**
     * super-detailed docblock
     */
    public function setDay($type) {
      // canonical validation (not to mention type and/or value coersion):

      is value in_array?
      YEP:  throw exception
      NOPE: set property

      return $this; // can't forget about that fluent interface right :)
    }

Allowing for the validation to be defined in place as:

        protected $__attributes = [
          'type' => ['accepts' => ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat']]
        ];

Not to mention, PHP doesn't allow the following definition:

    protected $range = range(0, 100);

Finally, gaining access to default property values requires boilerplate code (usually copied and pasted) as well as [reflection-based meta-programming](http://php.net/reflectionclass.getdefaultproperties).


Rationale
------------------------------

**In case you need further rhetoric (i.e. evidence)**:

-   PHP lacks intrinsic property get/set syntax; to compensate, we ceremoniously add setter/getter methods even when not needed.
- 	Using `__get` and `__set` interceptors to avoid setter/getter cruft is not a good solution to the underlying problem.
- 	Using a common base object to handle object attributes is not a good solution to the underlying problem.
-   Leaning on [complex IDEs](http://goo.gl/tUh9j) to produce setter/getter cruft is not a good solution to the underlying problem.
- 	Leaning on an [ORM](http://www.doctrine-project.org/blog/a-doctrine-orm-odm-base-class.html#last-words) is not a good solution since not every object in your domain needs to be persisted.


Features
------------------------------

-   Omit **setter/getter** methods until needed.

- 	JSON or Array representation of object attributes.

-   Access `attributes` as (**no getter method needed**):

        $object->firstName;

        // optionally use this instead
        $object->get('firstName')`;

-   Set `attributes` values as (**no setter method needed**):

        $object->firstName = 'My Name';

        // optionally use this instead
        $object->set('firstName', 'My Name')`;

- 	Expect `isset`, `empty`, and `unset` to work predictably.

        assert(true  === isset($object->firstName));
        assert(false === empty($object->firstName));
        unset($object->firstName);
        assert(false === isset($object->firstName));

- 	Define **acceptable** values for any `attribute`.

        protected $__attributes = [
          'second' => ['accepts' => '0..59']
        ];
   
- 	Define **default** `attribute` values.

        protected $__attributes = [
          'score' => ['default' => 0]
        ];
 

Usage Examples
------------------------------

    class Game {
      use Meta\Attributes;
      
      protected $__attributes = [
        'gameName'  => [],
        'userName'  => [],
        'score'     => ['accepts' => '0..100']
      ];
    }
    
    $game = new Game;
    $game->set([
      'gameName' => 'pacman',
      'userName' => 'manny.pacquiao'
      'score'    => 95;
    ]);

    assert(95 === $game->score);


Installation (Composer)
------------------------------

**Composer (step I)**

	$ cat > composer.json
    {
      "require": {
        "metaphp/attributes": "*"
      }
    }

**Composer (step II)**

	$ composer install


Follow the [composer Installation instructions](http://getcomposer.org/doc/00-intro.md#installation) if you don't have `composer` installed.


Requirements
------------------------------

-   PHP 5.4+
-   [optional] PHPUnit 3.6+ to execute the test suite (phpunit --version)


Submitting bugs and feature requests
------------------------------

Bugs and feature request are [tracked on GitHub](https://github.com/Seldaek/jsonlint/issues)


Alternatives
------------------------------

-   [Ruby](http://ruby-lang.org/)
-   [Scala](http://scala-lang.org/)


Inspiration
------------------------------

-   [Virtus](https://github.com/solnic/virtus)
-   [Smart Properties](https://github.com/t6d/smart_properties)
-   [C# Properties](http://msdn.microsoft.com/en-us/library/x9fsa0sw)
-   [BackboneJs Model Attributes](http://backbonejs.org/#Model-attributes)
-   [YUI3: Attribute](http://yuilibrary.com/yui/docs/attribute/index.html)


Contributors
------------------------------

[contributor](https://github.com/metaphp/attributes/contributors) info:

    project: attributes
    commits: 33
    active : 5 days
    files  : 14
    authors: 
      33	Wil Moore III           100.0%


Contributors Guide
------------------------------

**Unit Test Style Method Names**

-   Data Provider Methods

        // Because we want to be clear that this is distinctly a data provider
        function provider_description_of_provider() {}

-   Test Methods

        /**
         * Because this is easy to read and it produces what you'd expect when you run `phpunit --testdox`
         * @test
         */
        function Sentance_Friendly_Description() {}


Changelog
------------------------------

-   (0.0.2) 20120726: Added Travis Integration.
-   (0.0.1) 20120726: Initial Usable Release.


LICENSE
------------------------------

		(The MIT License)

		Copyright (c) 2012 Wil Moore III <wil.moore@wilmoore.com>

		Permission is hereby granted, free of charge, to any person obtaining a copy
		of this software and associated documentation files (the "Software"), to deal
		in the Software without restriction, including without limitation the rights
		to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
		copies of the Software, and to permit persons to whom the Software is furnished
		to do so, subject to the following conditions:

		The above copyright notice and this permission notice shall be included in all
		copies or substantial portions of the Software.

		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.

