<?php

namespace alexeevdv\yii\gravatar;

use \yii\helpers\Html;

class Widget extends \yii\base\Widget {

    /**
     * Use HTTPS?
     * @var bool
     */
    public $secure = true;

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
     * Must be beetween 1 and 2048
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

    const URL_HTTP = "http://www.gravatar.com/avatar/";
    const URL_HTTPS = "https://secure.gravatar.com/avatar/";

    public function run() {

        $this->_validateParams();

        $params = [];

        if (!empty($this->size)) {
            $params["s"] = $this->size;
        }

        if ($this->forceDefault) {
            $params["f"] = "y";
        }

        if (!empty($this->defaultImage)) {
            // urlencode will be made by yii Html helper
            $params["d"] = $this->defaultImage;
        }

        if (!empty($this->rating)) {
            $params["r"] = $this->rating;
        }

        $hash = md5(strtolower(trim($this->email)));

        $url = ($this->secure ? self::URL_HTTPS : self::URL_HTTP).$hash.($this->extension ? ".jpg" : "");

        if (count($params))
        {
            $url .= "?".http_build_query($params);
        }

        return Html::img($url, $this->options);
    }

    private function _validateParams()
    {
        // Email
        if (empty($this->email)) {
            throw new \yii\base\InvalidConfigException("`email` param is required");
        } else {
            $validator = new \yii\validators\EmailValidator;
            if (!$validator->validate($this->email, $error)) {
                throw new \yii\base\InvalidConfigException($error);
            }
        }

        // Size
        if (!empty($this->size)) {
            $validator = new \yii\validators\NumberValidator([
                "min" => 1,
                "max" => 2048,
            ]);
            if (!$validator->validate($this->size, $error)) {
                throw new \yii\base\InvalidConfigException($error);
            }
        }

        // Rating
        if (!empty($this->rating)) {
            $validator = new \yii\validators\RangeValidator([
                "range" => ["g", "pg", "r", "x"],
            ]);
            if (!$validator->validate($this->rating, $error)) {
                throw new \yii\base\InvalidConfigException($error);
            }
        }

        // Default image
        if (!empty($this->defaultImage)) {
            $validator = new \yii\validators\UrlValidator;
            if (!$validator->validate($this->defaultImage, $error)) {
                $validator = new \yii\validators\RangeValidator([
                    "range" => ["404", "mm", "identicon", "monsterid", "wavatar", "retro", "blank"],
                ]);
                if (!$validator->validate($this->defaultImage, $error)) {
                    throw new \yii\base\InvalidConfigException($error);
                }
            }
        }
    }
}
