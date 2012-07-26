PHP object attributes without the setter, getter boilerplate
============================================================

Non-trivial PHP applications tend to accumulate cruft and ceremony becomes the norm; however, with PHP 5.4 and `Meta\attributes`, this doesn't have to be the case. Win back a bit of conciseness and still turn-out maintainable/testable code.

`Meta\attributes` does require you to define attributes; however, the definition syntax is much lighter than typing the following for every property:

    protected $property = null;
    public function setProperty(){}
    public function getProperty(){}

That's not all...you will start to see a significant reduction in boilerplate code when you start to use the `accept` syntax which will `throw` out unacceptable values. This mitigates the need to wrap your methods with:

    protected $types = [ '' => '', '' => '' ];

    public function setType($type) {
      // canonical type checking here: throw exeception if invalid
    }

Not to mention, PHP doesn't allow the following definition:

    protected $range = range(0, 100);

Finally, gaining access to default property values requires boilerplate code (usually copied and pasted) as well as [reflection-based meta-programming](http://php.net/reflectionclass.getdefaultproperties).


Rationale
------------------------------

**In case you need further rhetoric (i.e. evidence)**:

-   PHP lacks intrinsic property get/set syntax; to compensate, we ceremoniously add setter/getter methods even when not needed.
- 	Using `__get` and `__set` interceptors to avoid setter/getter cruft is not a good solution to the underlying problem.
- 	Using a common base object to handle object attributes is not a good solution to the underlying problem.
-   Leaning on [complex IDEs](http://goo.gl/tUh9j) to produce the setter/getter cruft is not a good solution to the underlying problem.
- 	Leaning on an [ORM](http://www.doctrine-project.org/blog/a-doctrine-orm-odm-base-class.html#last-words) is not a good solution since not every object in your domain needs to be persisted.


Features
------------------------------

-   Omit `getter`, `setter` methods until needed.
-   Access object `attributes` as `$object->firstName` or `$object->get('firstName')`; no getter method needed.
-   Set values of object `attributes` as `$object->firstName = 'My Name'` or `$object->set('firstName', 'My Name')`; no setter method needed.
- 	JSON or Array representation of object attributes.
- 	Expect `isset`, `empty`, and `unset` to work predictably.
- 	[OPTIONAL] Define **acceptable** values for any `attribute`.
- 	[OPTIONAL] Define default `attribute` values.


Usage Examples
------------------------------

SEE: https://gist.github.com/3027238

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

