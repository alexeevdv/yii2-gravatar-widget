<?php

namespace alexeevdv\yii\gravatar;

/**
 * Class Model
 * @package alexeevdv\yii\gravatar
 */
class Model extends \yii\base\Model
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var int
     */
    public $size;

    /**
     * @var string
     */
    public $rating;

    /**
     * @var string
     */
    public $defaultImage;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'trim'],
            [['email'], 'filter', 'filter' => 'strtolower'],
            [['email'], 'required'],
            [['email'], 'email'],
            [['size'], 'number', 'min' => 1, 'max' => 2048],
            [['rating'], 'in', 'range' => ['g', 'pg', 'r', 'x']],
            [
                'defaultImage',
                'url',
                'when' => function (Model $model) {
                    return strpos($model->defaultImage, 'http') === 0;
                },
            ],
            [
                'defaultImage',
                'in',
                'range' => ['404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'blank'],
                'when' => function (Model $model) {
                    return strpos($model->defaultImage, 'http') === false;
                },
            ],
        ];
    }
}
