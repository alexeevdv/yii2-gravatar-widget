yii2-gravatar-widget
====================

Yii2 wrapper for [Gravatar](https://gravatar.com) service.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require alexeevdv/yii2-gravatar-widget "dev-master"
```

or add

```
"alexeevdv/yii2-gravatar-widget": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage

```php
echo \alexeevdv\gravatar\Widget([
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
