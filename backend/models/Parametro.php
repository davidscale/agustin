<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%parametros}}".
 *
 * @property int $parametro
 * @property string|null $background
 * @property string|null $facultad
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
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_guarani');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parametro'], 'required'],
            [['parametro'], 'default', 'value' => null],
            [['parametro'], 'integer'],
            [['background'], 'string', 'max' => 255],
            [['facultad'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parametro' => Yii::t('app', 'Parametro'),
            'background' => Yii::t('app', 'Background'),
            'facultad' => Yii::t('app', 'Facultad'),
        ];
    }
}
