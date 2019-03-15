<?php

namespace alexeevdv\yii\gravatar;

use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * Class Widget
 * @package alexeevdv\yii\gravatar
 */
class Widget extends \yii\base\Widget
{
    /**
     * Append .jpg extension?
     * @var bool
     */
    public $extension = true;

    /**
     * Email address
     * @var string
     */
    public $email;

    /**
     * Image size in pixels
     * Must be between 1 and 2048
     * @var integer
     */
    public $size;

    /**
     * Default image
     * Must be valid URI or one of this values: 404, mm, identicon, monsterid, wavatar, retro, blank
     * @var string
     */
    public $defaultImage;

    /**
     * Force default image to be displayed?
     * @var bool
     */
    public $forceDefault = false;

    /**
     * Avatar rating level
     * Allowed values: g, pg, r, x
     * @var string
     */
    public $rating;

    /**
     * Additional options to Html::img method
     * @var array
     */
    public $options = [];

    /**
     * Base URL for avatars
     * @var string
     */
    public $baseUrl =  'https://secure.gravatar.com/avatar/';

    /**
     * @var Model
     */
    private $_model;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->_model = new Model([
            'email' => $this->email,
            'size' => $this->size,
            'rating' => $this->rating,
            'defaultImage' => $this->defaultImage,
        ]);
        if (!$this->_model->validate()) {
            $validationErrors = $this->_model->getFirstErrors();
            throw new InvalidConfigException(reset($validationErrors));
        }
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function run()
    {
        $params = array_filter([
            's' => $this->_model->size,
            'f' => $this->forceDefault ? 'y' : null,
            'd' => $this->_model->defaultImage,
            'r' => $this->_model->rating,
        ], 'strlen');

        $url = $this->baseUrl . md5($this->_model->email) . ($this->extension ? '.jpg' : '');

        if (count($params)) {
            $url .= '?' . http_build_query($params);
        }

        return strtr(Html::img('{url}', $this->options), ['{url}' => $url]);
    }
}
