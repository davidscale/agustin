<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sga_ubicaciones}}".
 *
 * @property int $ubicacion
 * @property string $nombre
 * @property int $ubicacion_tipo
 * @property int $localidad
 * @property string|null $calle
 * @property string|null $numero
 * @property string|null $codigo_postal
 * @property string|null $telefono
 * @property string|null $fax
 * @property string|null $email
 * @property int|null $institucion_araucano
 * @property float|null $latitud
 * @property float|null $longitud
 *
 * @property GdeUbicacione[] $gdeUbicaciones
 * @property GdeHabilitacione[] $habilitacions
 * @property IntArauInstitucione $institucionAraucano
 * @property MugLocalidade $localidad0
 * @property MenDominio[] $menDominios
 * @property SgaPeriodosInscripcion[] $periodoInscripcions
 * @property PreTurnosConfigUbicacion[] $preTurnosConfigUbicacions
 * @property SgaPropuesta[] $propuestas
 * @property SgaAlumno[] $sgaAlumnos
 * @property SgaAlumnosHistUbicacion[] $sgaAlumnosHistUbicacions
 * @property SgaCertificadosResolucione[] $sgaCertificadosResoluciones
 * @property SgaComisione[] $sgaComisiones
 * @property SgaDiasNoLaborable[] $sgaDiasNoLaborables
 * @property SgaEdificacione[] $sgaEdificaciones
 * @property SgaLibrosActasUbicacion[] $sgaLibrosActasUbicacions
 * @property SgaMesasExaman[] $sgaMesasExamen
 * @property SgaPerInscUbicacion[] $sgaPerInscUbicacions
 * @property SgaPreinscripcionPropuestum[] $sgaPreinscripcionPropuesta
 * @property SgaPropuestasAspira[] $sgaPropuestasAspiras
 * @property SgaPropuestasOfertum[] $sgaPropuestasOferta
 * @property SgaPropuestasRegularidad[] $sgaPropuestasRegularidads
 * @property SgaUgPropuesta[] $sgaUgPropuestas
 * @property PreTurnosConfig[] $turnoConfigs
 * @property SgaUbicacionesTipo $ubicacionTipo
 */
class SgaUbicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sga_ubicaciones}}';
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
            [['nombre', 'ubicacion_tipo', 'localidad'], 'required'],
            [['ubicacion_tipo', 'localidad', 'institucion_araucano'], 'default', 'value' => null],
            [['ubicacion_tipo', 'localidad', 'institucion_araucano'], 'integer'],
            [['latitud', 'longitud'], 'number'],
            [['nombre', 'calle', 'email'], 'string', 'max' => 100],
            [['numero'], 'string', 'max' => 20],
            [['codigo_postal'], 'string', 'max' => 15],
            [['telefono', 'fax'], 'string', 'max' => 50],
            [['institucion_araucano'], 'exist', 'skipOnError' => true, 'targetClass' => IntArauInstitucione::className(), 'targetAttribute' => ['institucion_araucano' => 'institucion_araucano']],
            [['localidad'], 'exist', 'skipOnError' => true, 'targetClass' => MugLocalidade::className(), 'targetAttribute' => ['localidad' => 'localidad']],
            [['ubicacion_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => SgaUbicacionesTipo::className(), 'targetAttribute' => ['ubicacion_tipo' => 'ubicacion_tipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ubicacion' => Yii::t('app', 'Ubicacion'),
            'nombre' => Yii::t('app', 'Nombre'),
            'ubicacion_tipo' => Yii::t('app', 'Ubicacion Tipo'),
            'localidad' => Yii::t('app', 'Localidad'),
            'calle' => Yii::t('app', 'Calle'),
            'numero' => Yii::t('app', 'Numero'),
            'codigo_postal' => Yii::t('app', 'Codigo Postal'),
            'telefono' => Yii::t('app', 'Telefono'),
            'fax' => Yii::t('app', 'Fax'),
            'email' => Yii::t('app', 'Email'),
            'institucion_araucano' => Yii::t('app', 'Institucion Araucano'),
            'latitud' => Yii::t('app', 'Latitud'),
            'longitud' => Yii::t('app', 'Longitud'),
        ];
    }

    /**
     * Gets query for [[GdeUbicaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeUbicaciones()
    {
        return $this->hasMany(GdeUbicacione::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[Habilitacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHabilitacions()
    {
        return $this->hasMany(GdeHabilitacione::className(), ['habilitacion' => 'habilitacion'])->viaTable('{{%gde_ubicaciones}}', ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[InstitucionAraucano]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitucionAraucano()
    {
        return $this->hasOne(IntArauInstitucione::className(), ['institucion_araucano' => 'institucion_araucano']);
    }

    /**
     * Gets query for [[Localidad0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidad0()
    {
        return $this->hasOne(MugLocalidade::className(), ['localidad' => 'localidad']);
    }

    /**
     * Gets query for [[MenDominios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenDominios()
    {
        return $this->hasMany(MenDominio::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[PeriodoInscripcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodoInscripcions()
    {
        return $this->hasMany(SgaPeriodosInscripcion::className(), ['periodo_inscripcion' => 'periodo_inscripcion'])->viaTable('{{%sga_per_insc_ubicacion}}', ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[PreTurnosConfigUbicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreTurnosConfigUbicacions()
    {
        return $this->hasMany(PreTurnosConfigUbicacion::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[Propuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPropuestas()
    {
        return $this->hasMany(SgaPropuesta::className(), ['propuesta' => 'propuesta'])->viaTable('{{%sga_propuestas_oferta}}', ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaAlumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaAlumnos()
    {
        return $this->hasMany(SgaAlumno::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaAlumnosHistUbicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaAlumnosHistUbicacions()
    {
        return $this->hasMany(SgaAlumnosHistUbicacion::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaCertificadosResoluciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaCertificadosResoluciones()
    {
        return $this->hasMany(SgaCertificadosResolucione::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaComisiones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaComisiones()
    {
        return $this->hasMany(SgaComisione::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaDiasNoLaborables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaDiasNoLaborables()
    {
        return $this->hasMany(SgaDiasNoLaborable::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaEdificaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaEdificaciones()
    {
        return $this->hasMany(SgaEdificacione::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaLibrosActasUbicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaLibrosActasUbicacions()
    {
        return $this->hasMany(SgaLibrosActasUbicacion::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaMesasExamen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaMesasExamen()
    {
        return $this->hasMany(SgaMesasExaman::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaPerInscUbicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPerInscUbicacions()
    {
        return $this->hasMany(SgaPerInscUbicacion::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaPreinscripcionPropuesta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPreinscripcionPropuesta()
    {
        return $this->hasMany(SgaPreinscripcionPropuestum::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaPropuestasAspiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasAspiras()
    {
        return $this->hasMany(SgaPropuestasAspira::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaPropuestasOferta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasOferta()
    {
        return $this->hasMany(SgaPropuestasOfertum::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaPropuestasRegularidads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasRegularidads()
    {
        return $this->hasMany(SgaPropuestasRegularidad::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[SgaUgPropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaUgPropuestas()
    {
        return $this->hasMany(SgaUgPropuesta::className(), ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[TurnoConfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurnoConfigs()
    {
        return $this->hasMany(PreTurnosConfig::className(), ['turno_config' => 'turno_config'])->viaTable('{{%pre_turnos_config_ubicacion}}', ['ubicacion' => 'ubicacion']);
    }

    /**
     * Gets query for [[UbicacionTipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUbicacionTipo()
    {
        return $this->hasOne(SgaUbicacionesTipo::className(), ['ubicacion_tipo' => 'ubicacion_tipo']);
    }
}