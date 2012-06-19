PHP object attributes without the setter, getter boilerplate
============================================================

Because...
------------------------------

- 	You shouldn't (by default) write or generate setter/getter method boilerplate.
- 	PHP shouldn't borrow the [Bean](http://youtu.be/LH75sJAR0hc) pattern from Java.
- 	You shouldn't _have_ rely on your [ORM](http://www.doctrine-project.org/blog/a-doctrine-orm-odm-base-class.html#last-words)
		(no matter how good it is) for simple `attribute` **access** and **mutation**.
- 	Magic method (`__get`, `__set`) copy + paste is a kludge.
- 	The common base object pattern is a kludge.


Features
------------------------------

-   no need to write or generate `getter` or `setter` methods unless needed.

-   **get** `attribute` values as depicted below with or without having
		an **accessor** method defined:

		echo $user->firstName;
		echo $user->get('firstName');

-   **set** `attribute` values as depicted below with or without having
		a **mutator** method defined:

		$user->firstName = 'Freddy';
		$user->set('firstName') = 'Freddy';

- 	optionally define **validation** methods for all, some, or none of your object `attributes`.

- 	optionally define **acceptable** values for any `attribute`

- 	optionally receive a default value when an `attribute` would return null.

- 	retrieve a JSON representation of your object instance.

- 	`isset`, `empty`, and `unset` work as you'd expect them to.


Usage Examples
------------------------------

	class Person {
		use Meta\Attributes;
		protected $__attributes = ['firstName' => [], 'lastName'  => []];
	}

	$person = new Person;
	$person.set('firstName', 'Senae');
	$person.set('lastName',  'Moore');


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

	$ composer.phar install


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

	 authors: 
			 9	Wil Moore III           100.0%


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

