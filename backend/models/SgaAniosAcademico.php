<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sga_anios_academicos}}".
 *
 * @property float $anio_academico
 *
 * @property SgaAlumno[] $alumnos
 * @property GdeAniosAcademico[] $gdeAniosAcademicos
 * @property GdeHabilitacione[] $gdeHabilitaciones
 * @property GdeItem[] $gdeItems
 * @property GdeHabilitacione[] $habilitacions
 * @property MenDominio[] $menDominios
 * @property SgaAniosAcademicosFecha[] $sgaAniosAcademicosFechas
 * @property SgaConvenio[] $sgaConvenios
 * @property SgaLicencia[] $sgaLicencias
 * @property SgaMesasExaman[] $sgaMesasExamen
 * @property SgaPerdidaRegularidad[] $sgaPerdidaRegularidads
 * @property SgaPeriodo[] $sgaPeriodos
 * @property SgaPeriodosInscripcionPropuestum[] $sgaPeriodosInscripcionPropuesta
 * @property SgaPropuestasAspira[] $sgaPropuestasAspiras
 * @property SgaPropuestasRelacion[] $sgaPropuestasRelacions
 * @property SgaReadmisione[] $sgaReadmisiones
 * @property SgaReadmisionesSolicitud[] $sgaReadmisionesSolicituds
 * @property SgaReinscripcione[] $sgaReinscripciones
 */
class SgaAniosAcademico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sga_anios_academicos}}';
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
            [['anio_academico'], 'required'],
            [['anio_academico'], 'number'],
            [['anio_academico'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'anio_academico' => Yii::t('app', 'Año Academico'),
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(SgaAlumno::className(), ['alumno' => 'alumno'])->viaTable('{{%sga_reinscripciones}}', ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[GdeAniosAcademicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeAniosAcademicos()
    {
        return $this->hasMany(GdeAniosAcademico::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[GdeHabilitaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeHabilitaciones()
    {
        return $this->hasMany(GdeHabilitacione::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[GdeItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeItems()
    {
        return $this->hasMany(GdeItem::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[Habilitacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHabilitacions()
    {
        return $this->hasMany(GdeHabilitacione::className(), ['habilitacion' => 'habilitacion'])->viaTable('{{%gde_anios_academicos}}', ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[MenDominios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenDominios()
    {
        return $this->hasMany(MenDominio::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaAniosAcademicosFechas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaAniosAcademicosFechas()
    {
        return $this->hasMany(SgaAniosAcademicosFecha::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaConvenios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaConvenios()
    {
        return $this->hasMany(SgaConvenio::className(), ['anio_academico_vigencia' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaLicencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaLicencias()
    {
        return $this->hasMany(SgaLicencia::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaMesasExamen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaMesasExamen()
    {
        return $this->hasMany(SgaMesasExaman::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaPerdidaRegularidads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPerdidaRegularidads()
    {
        return $this->hasMany(SgaPerdidaRegularidad::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaPeriodos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPeriodos()
    {
        return $this->hasMany(SgaPeriodo::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaPeriodosInscripcionPropuesta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPeriodosInscripcionPropuesta()
    {
        return $this->hasMany(SgaPeriodosInscripcionPropuestum::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaPropuestasAspiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasAspiras()
    {
        return $this->hasMany(SgaPropuestasAspira::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaPropuestasRelacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasRelacions()
    {
        return $this->hasMany(SgaPropuestasRelacion::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaReadmisiones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaReadmisiones()
    {
        return $this->hasMany(SgaReadmisione::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaReadmisionesSolicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaReadmisionesSolicituds()
    {
        return $this->hasMany(SgaReadmisionesSolicitud::className(), ['anio_academico' => 'anio_academico']);
    }

    /**
     * Gets query for [[SgaReinscripciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaReinscripciones()
    {
        return $this->hasMany(SgaReinscripcione::className(), ['anio_academico' => 'anio_academico']);
    }
}
