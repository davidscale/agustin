<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sga_periodos}}".
 *
 * @property int $periodo
 * @property string $nombre
 * @property string|null $descripcion
 * @property float $anio_academico
 * @property int $periodo_generico
 * @property string $fecha_inicio
 * @property string $fecha_fin
 *
 * @property SgaAniosAcademico $anioAcademico
 * @property SgaPeriodosGenerico $periodoGenerico
 * @property SgaLlamadosTurno[] $sgaLlamadosTurnos
 * @property SgaPeriodosInscripcion[] $sgaPeriodosInscripcions
 * @property SgaPeriodosLectivo[] $sgaPeriodosLectivos
 * @property SgaTurnosExaman[] $sgaTurnosExamen
 */
class SgaPeriodo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sga_periodos}}';
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
            [['nombre', 'anio_academico', 'periodo_generico', 'fecha_inicio', 'fecha_fin'], 'required'],
            [['anio_academico'], 'number'],
            [['periodo_generico'], 'default', 'value' => null],
            [['periodo_generico'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 255],
            [['anio_academico'], 'exist', 'skipOnError' => true, 'targetClass' => SgaAniosAcademico::class, 'targetAttribute' => ['anio_academico' => 'anio_academico']],
            [['periodo_generico'], 'exist', 'skipOnError' => true, 'targetClass' => SgaPeriodosGenerico::class, 'targetAttribute' => ['periodo_generico' => 'periodo_generico']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'periodo' => Yii::t('app', 'Periodo'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'anio_academico' => Yii::t('app', 'Anio Academico'),
            'periodo_generico' => Yii::t('app', 'Periodo Generico'),
            'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
            'fecha_fin' => Yii::t('app', 'Fecha Fin'),
        ];
    }

    /**
     * Gets query for [[AnioAcademico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnioAcademico()
    {
        return $this->hasOne(SgaAniosAcademico::class, ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[PeriodoGenerico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodoGenerico()
    {
        return $this->hasOne(SgaPeriodosGenerico::class, ['periodo_generico' => 'periodo_generico']);
    }

    /**
     * Gets query for [[SgaLlamadosTurnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaLlamadosTurnos()
    {
        return $this->hasMany(SgaLlamadosTurno::class, ['periodo' => 'periodo']);
    }

    /**
     * Gets query for [[SgaPeriodosInscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPeriodosInscripcions()
    {
        return $this->hasMany(SgaPeriodosInscripcion::class, ['periodo' => 'periodo']);
    }

    /**
     * Gets query for [[SgaPeriodosLectivos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPeriodosLectivos()
    {
        return $this->hasMany(SgaPeriodosLectivo::class, ['periodo' => 'periodo']);
    }

    /**
     * Gets query for [[SgaTurnosExamen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaTurnosExamen()
    {
        return $this->hasMany(SgaTurnosExaman::class, ['periodo' => 'periodo']);
    }
}