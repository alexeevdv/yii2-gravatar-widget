<?php

namespace alexeevdv\gravatar;

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

    const URL_HTTP = "http://www.gravatar.com/avatar/";
    const URL_HTTPS = "https://secure.gravatar.com/avatar/";

    public function run() {
        
        // Email is required
        if (empty($this->email)) {
            throw new \yii\base\InvalidConfigException("`email` param is required");
        } else {
            // Email validation
            $validator = new \yii\validators\EmailValidator;
            if (!$validator->validate($this->email, $error)) {
                throw new \yii\base\InvalidConfigException($error);
            }            
        }    
        
        $params = [];
        
        if (!empty($this->size)) {
            // Size validation
            $validator = new \yii\validators\RangeValidator;
            $validator->range = [1, 2048];
            if (!$validator->validate($this->size, $error)) {
                throw new \yii\base\InvalidConfigException($error);
            }
            
            $params['s'] = $this->size;
        }        
        
        $hash = md5(strtolower(trim($this->email)));
      
        $url = ($this->secure ? self::URL_HTTPS : self::URL_HTTP).$hash.($this->extension ? ".jpg" : "");

        if (count($params))
        {
            $url .= "?".http_build_query($params);
        }
        
        return Html::img($url);
        
    }
}
