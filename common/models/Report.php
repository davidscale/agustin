<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Report form
 */
class ReportForm extends Model
{
    public $propuesta;
    public $anio;
    public $ubicacion;
    public $periodo;
    public $more_info = false;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['propuesta', 'anio', 'ubicacion', 'periodo', 'more_info'], 'required'],
        ];
    }

    /**
     * Finds report by report selected
     *
     * @return Report|null
     */
    protected function getByKynd()
    {
        if ($this->username) {
            $this->_user = User::findByUsername($this->username);
        }

        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->username);
        }

        return $this->_user;
    }
}
