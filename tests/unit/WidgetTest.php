<?php

namespace tests\unit;

use alexeevdv\yii\gravatar\Widget;
use yii\base\InvalidConfigException;

class WidgetTest extends \Codeception\Test\Unit
{
    public function testEmailIsRequired()
    {
        $this->expectException(InvalidConfigException::class);
        Widget::widget([]);
    }

    public function testEmailIsValidated()
    {
        $this->expectException(InvalidConfigException::class);
        Widget::widget([
            'email' => 'email',
        ]);
    }

    public function testWithCorrectEmail()
    {
        $img = Widget::widget(['email' => 'mail@mail.org']);
        $this->assertEquals('<img src="https://secure.gravatar.com/avatar/390e1e48373645905d803ebc1b6e84eb.jpg" alt="">', $img);
    }

    public function testWithoutExtension()
    {
        $img = Widget::widget([
            'email' => 'mail@mail.org',
            'extension' => false,
        ]);
        $this->assertEquals('<img src="https://secure.gravatar.com/avatar/390e1e48373645905d803ebc1b6e84eb" alt="">', $img);
    }

    public function testWrongSize()
    {
        $this->expectException(InvalidConfigException::class);
        Widget::widget([
            'email' => 'mail@mail.org',
            'size' => 3000,
        ]);
    }

    public function testCorrectSize()
    {
        $img = Widget::widget([
            'email' => 'mail@mail.org',
            'size' => 2000,
        ]);
        $this->assertEquals('<img src="https://secure.gravatar.com/avatar/390e1e48373645905d803ebc1b6e84eb.jpg?s=2000" alt="">', $img);
    }

    public function testWrongRating()
    {
        $this->expectException(InvalidConfigException::class);
        Widget::widget([
            'email' => 'mail@mail.org',
            'rating' => 'hz',
        ]);
    }

    public function testCorrectRating()
    {
        $img = Widget::widget([
            'email' => 'mail@mail.org',
            'rating' => 'pg',
        ]);
        $this->assertEquals('<img src="https://secure.gravatar.com/avatar/390e1e48373645905d803ebc1b6e84eb.jpg?r=pg" alt="">', $img);
    }

    public function testWrongDefaultImageLink()
    {
        $this->expectException(InvalidConfigException::class);
        Widget::widget([
            'email' => 'mail@mail.org',
            'defaultImage' => 'httpss://asdf/aer.jpg',
        ]);
    }

    public function testCorrectDefaultImageLink()
    {
        $img = Widget::widget([
            'email' => 'mail@mail.org',
            'defaultImage' => 'http://domain.org/image.jpg',
        ]);
        $this->assertEquals('<img src="https://secure.gravatar.com/avatar/390e1e48373645905d803ebc1b6e84eb.jpg?d=http%3A%2F%2Fdomain.org%2Fimage.jpg" alt="">', $img);
    }

    public function testWrongDefaultImage()
    {
        $this->expectException(InvalidConfigException::class);
        Widget::widget([
            'email' => 'mail@mail.org',
            'defaultImage' => 'asdfasdf',
        ]);
    }

    public function testCorrectDefaultImage()
    {
        $img = Widget::widget([
            'email' => 'mail@mail.org',
            'defaultImage' => 'monsterid',
        ]);
        $this->assertEquals('<img src="https://secure.gravatar.com/avatar/390e1e48373645905d803ebc1b6e84eb.jpg?d=monsterid" alt="">', $img);
    }

    public function testAllTogether()
    {
        $img = Widget::widget([
            'email' => 'mail@mail.org',
            'size' => 1000,
            'rating' => 'pg',
            'defaultImage' => '404',
            'extension' => false,
            'forceDefault' => true,
            'options' => [
                'alt' => 'xxx'
            ],
        ]);
        $this->assertEquals('<img src="https://secure.gravatar.com/avatar/390e1e48373645905d803ebc1b6e84eb?s=1000&f=y&d=404&r=pg" alt="xxx">', $img);
    }
}
