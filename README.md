# minimal object attributes trait for PHP

[![Build Status](https://secure.travis-ci.org/wilmoore/attributes.php.png?branch=master)](http://travis-ci.org/wilmoore/attributes.php)

The `Attributes` trait helps to avoid having to manually write getter/setter boilerplate:

## Features

-   Omit **setter/getter** methods until needed.
-   JSON or Array representation of object attributes.
-   Get values via `$object->firstName` or `$object->get('firstName')`
-   Set values via `$object->firstName = 'My Name';` or `$object->set('firstName', 'My Name')`
-   `isset`, `empty`, and `unset` work as expected.
-   Define _acceptable_ input values like `'seconds' => ['accepts' => '0..59']`
-   Define _default_ values like `'score' => ['default' => 0]`

## Anti-Features

-   Leaning on [complex IDEs](http://goo.gl/tUh9j) to produce setter/getter cruft is not a good solution to the underlying problem.
-   Leaning on an [ORM](http://www.doctrine-project.org/blog/a-doctrine-orm-odm-base-class.html#last-words) is not a good solution since not every object in your domain needs to be persisted.
-   Leaning on [reflection-based meta-programming](http://php.net/reflectionclass.getdefaultproperties).

## Examples

    class Game {
      use Attributes;

      protected $__attributes = [
        'gameName'  => [],
        'userName'  => [],
        'score'     => ['accepts' => '0..100']
      ];
    }

    $game = new Game;
    $game->set([
      'gameName' => 'pacman',
      'userName' => 'manny.pacquiao',
      'score'    => 95
    ]);

    assert(95 === $game->score);

## Installation

### Composer

    "require": {
        "wilmoore/attributes.php": "*"
    }

## Requirements

-   PHP 5.4+
-   [optional] PHPUnit 3.6+ to execute the test suite (phpunit --version)

## Resources

- [Issues](https://github.com/metaphp/attributes/issues)
- [Contributors](https://github.com/metaphp/attributes/contributors)
- [Contributor Guide](https://github.com/wilmoore/attributes.php/wiki/Contributor-Guide)
- [Request for Comments: Property Accessors](https://wiki.php.net/rfc/propertygetsetsyntax-as-implemented)

## Changelog

- (0.0.2) 20120726: Added Travis Integration.
- (0.0.1) 20120726: Initial Usable Release.

## LICENSE

  MIT

