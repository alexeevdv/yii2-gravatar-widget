<?php

namespace alexeevdv\gravatar;

class Widget extends \yii\base\Widget
{
    public $secure = true;

    public $email = false;

    public $size;

    const URL_HTTPS = "https://secure.gravatar.com/avatar/";

    const URL_HTTP = "http://www.gravatar.com/avatar/";

    public function run()
    {

        $hash = md5(strtolower(trim($this->email)));
      
        return ($this->secure ? self::URL_HTTPS : self::URL_HTTP).$hash;

    }
}
