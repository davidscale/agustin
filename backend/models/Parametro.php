<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%parametros}}".
 *
 * @property int $parametro
 * @property string $facultad
 * @property string $bg_url_img
 */
class Parametro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%parametros}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parametro', 'facultad', 'bg_url_img'], 'required'],
            [['parametro'], 'default', 'value' => null],
            [['parametro'], 'integer'],
            [['facultad'], 'string', 'max' => 100],
            [['bg_url_img'], 'string', 'max' => 255],
            [['parametro'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parametro' => Yii::t('app', 'Parametro'),
            'facultad' => Yii::t('app', 'Facultad'),
            'bg_url_img' => Yii::t('app', 'Bg Url Img'),
        ];
    }
}
