yii2-gravatar-widget
====================

[![Build Status](https://travis-ci.com/alexeevdv/yii2-gravatar-widget.svg?branch=master)](https://travis-ci.com/alexeevdv/yii2-gravatar-widget) 
[![codecov](https://codecov.io/gh/alexeevdv/yii2-gravatar-widget/branch/master/graph/badge.svg)](https://codecov.io/gh/alexeevdv/yii2-gravatar-widget)
![PHP 5.6](https://img.shields.io/badge/PHP-5.6-green.svg) 
![PHP 7.0](https://img.shields.io/badge/PHP-7.0-green.svg) 
![PHP 7.1](https://img.shields.io/badge/PHP-7.1-green.svg) 
![PHP 7.2](https://img.shields.io/badge/PHP-7.2-green.svg)
![PHP 7.2](https://img.shields.io/badge/PHP-7.3-green.svg)

Yii2 wrapper for [Gravatar](https://gravatar.com) service.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require alexeevdv/yii2-gravatar-widget
```

or add

```
"alexeevdv/yii2-gravatar-widget": "^1.0"
```

to the ```require``` section of your `composer.json` file.

## Usage

```php
echo \alexeevdv\yii\gravatar\Widget([
    "email" => "mail@example.com", // required
]);
```

## Params

```php
/**
 * User email address
 */
string $email;

/**
 * Use HTTPS connection?
 */
bool $secure = true;

/**
 * Append .jpg extension?
 */
bool $extension = true;

/**
 * Avatar width and height. Must be beetween 1 and 2048
 */
integer $size;

/**
 * Default image if avatar is not available. Must be valid image URI or one of the following strings:
 * "404", "mm", "identicon", "monsterid", "wavatar", "retro", "blank"
 */
string $defaultImage;

/**
 * Force default image even if the avatar is available?
 */
bool $forceDefault = false;

/**
 * Allowed avatar rating. Must be one of the following strings:
 * "g", "pg", "r", "x"
 */
string $rating;

/**
 * Additional HTML attributes to img tag
 */
array $options = [];

```

For more information see [Gravatar manual](https://ru.gravatar.com/site/implement/).
