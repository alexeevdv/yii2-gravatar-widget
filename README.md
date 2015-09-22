yii2-gravatar-widget
====================

## Description

[Yii2 wrapper for Gravatar service](https://gravatar.com)

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

### Params

 - *email* 
 - *secure*
 - *extension*
 - *size*
 - *defaultImage*
 - *forceDefault*
 - *rating*
 - *options* - additional HTML attributes to img tag.

