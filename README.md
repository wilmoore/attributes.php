attributes: Plain object attributes for the rest of us
============================================================


If you are tired of writing or generating getter-setter boilerplate, and you deploy PHP 5.4+, then `attributes` is for you.


Rationale
------------------------------

- 	Writing [Java Beans](http://youtu.be/LH75sJAR0hc) in PHP is not fun nor is it productive.

- 	You shouldn't _have_ rely on your [ORM](http://www.doctrine-project.org/blog/a-doctrine-orm-odm-base-class.html#last-words)
		(no matter how good it is) for simple `attribute` **access** and **mutation**.


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

	class Post {
		protected $__attributes = [
			'id' => [], 'title' => [], 'body'  => []
		];
	}

	$post = new Post(['title' => 'Cool Story...', 'body' => '<div>Yeah, Sure.</div>']);

	echo $post;


Download and Installation
------------------------------

**Composer**

composer.json:

		{
			"require": {
					"metaphp/attributes": "dev-master"
			}
		}

run composer:

		$ curl -s http://getcomposer.org/installer | php
		$ composer.phar install


FAQ
------------------------------

**Why do I need this?**

Compare [this](https://gist.github.com/):

    $...

To [this](https://gist.github.com/):

    $...


Troubleshooting
------------------------------

**...**

-   ...


Alternatives
------------------------------

-   []()


Inspiration
------------------------------

-   []()

Contributors
------------------------------


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

