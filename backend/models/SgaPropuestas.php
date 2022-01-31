<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sga_propuestas}}".
 *
 * @property int $propuesta
 * @property string $nombre
 * @property string $nombre_abreviado
 * @property string $codigo
 * @property int $propuesta_tipo
 * @property string $publica
 * @property int|null $documento_alta
 * @property string|null $fecha_alta
 * @property int|null $campo_disciplinar
 * @property int|null $escala_cumplimiento
 * @property int|null $documento_baja
 * @property string|null $fecha_baja
 * @property int|null $a_termino
 * @property int|null $entidad
 * @property string $estado
 *
 * @property SgaCampoDisciplinar $campoDisciplinar
 * @property SgaColacione[] $colacions
 * @property SgaCompetenciasIngreso[] $competencias
 * @property SgaDocumento $documentoAlta
 * @property SgaDocumento $documentoBaja
 * @property SgaG3entidade $entidad0
 * @property SgaEscalasCumplimiento $escalaCumplimiento
 * @property SgaPropuestasEstado $estado0
 * @property GdeConcepto[] $gdeConceptos
 * @property GdeElemento[] $gdeElementos
 * @property GdeEncuestaPendientePropuesta[] $gdeEncuestaPendientePropuestas
 * @property GdeItem[] $gdeItems
 * @property GdePropuesta[] $gdePropuestas
 * @property SgaPropuestasGrupo[] $grupoPropuestas
 * @property GdeHabilitacione[] $habilitacions
 * @property MenDominio[] $menDominios
 * @property MdpPersona[] $personas
 * @property SgaPropuestasTipo $propuestaTipo
 * @property SgaResponsablesAcademica[] $responsableAcademicas
 * @property SgaAlumno[] $sgaAlumnos
 * @property SgaColacionesPropuesta[] $sgaColacionesPropuestas
 * @property SgaComisionesPropuesta[] $sgaComisionesPropuestas
 * @property SgaCompetenciasIngPropuestum[] $sgaCompetenciasIngPropuesta
 * @property SgaConvenio[] $sgaConvenios
 * @property SgaConveniosPropuesta[] $sgaConveniosPropuestas
 * @property SgaEquivInterna[] $sgaEquivInternas
 * @property SgaEquivMatrix[] $sgaEquivMatrices
 * @property SgaEquivTramite[] $sgaEquivTramites
 * @property SgaLibrosActasPropuestum[] $sgaLibrosActasPropuesta
 * @property SgaLicenciasPropuesta[] $sgaLicenciasPropuestas
 * @property SgaMesasExamenPropuesta[] $sgaMesasExamenPropuestas
 * @property SgaPeriodosInscripcionAplanado[] $sgaPeriodosInscripcionAplanados
 * @property SgaPeriodosInscripcionCoeficiente[] $sgaPeriodosInscripcionCoeficientes
 * @property SgaPlane[] $sgaPlanes
 * @property SgaPreinscripcionPropuestum[] $sgaPreinscripcionPropuesta
 * @property SgaPropuestasAreasTem[] $sgaPropuestasAreasTems
 * @property SgaPropuestasAspira[] $sgaPropuestasAspiras
 * @property SgaPropuestasOfertum[] $sgaPropuestasOferta
 * @property SgaPropuestasRa[] $sgaPropuestasRas
 * @property SgaPropuestasRegularidad[] $sgaPropuestasRegularidads
 * @property SgaPropuestasRelacion[] $sgaPropuestasRelacions
 * @property SgaPropuestasXGrupo[] $sgaPropuestasXGrupos
 * @property SgaSancione[] $sgaSanciones
 * @property SgaUgPropuesta[] $sgaUgPropuestas
 * @property SgaUbicacione[] $ubicacions
 */
class SgaPropuestas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sga_propuestas}}';
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
            [['nombre', 'nombre_abreviado', 'codigo', 'propuesta_tipo', 'estado'], 'required'],
            [['propuesta_tipo', 'documento_alta', 'campo_disciplinar', 'escala_cumplimiento', 'documento_baja', 'a_termino', 'entidad'], 'default', 'value' => null],
            [['propuesta_tipo', 'documento_alta', 'campo_disciplinar', 'escala_cumplimiento', 'documento_baja', 'a_termino', 'entidad'], 'integer'],
            [['fecha_alta', 'fecha_baja'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre_abreviado'], 'string', 'max' => 50],
            [['codigo'], 'string', 'max' => 10],
            [['publica', 'estado'], 'string', 'max' => 1],
            [['codigo'], 'unique'],
            [['campo_disciplinar'], 'exist', 'skipOnError' => true, 'targetClass' => SgaCampoDisciplinar::className(), 'targetAttribute' => ['campo_disciplinar' => 'campo_disciplinar']],
            [['documento_alta'], 'exist', 'skipOnError' => true, 'targetClass' => SgaDocumento::className(), 'targetAttribute' => ['documento_alta' => 'documento']],
            [['documento_baja'], 'exist', 'skipOnError' => true, 'targetClass' => SgaDocumento::className(), 'targetAttribute' => ['documento_baja' => 'documento']],
            [['escala_cumplimiento'], 'exist', 'skipOnError' => true, 'targetClass' => SgaEscalasCumplimiento::className(), 'targetAttribute' => ['escala_cumplimiento' => 'escala_cumplimiento']],
            [['entidad'], 'exist', 'skipOnError' => true, 'targetClass' => SgaG3entidade::className(), 'targetAttribute' => ['entidad' => 'entidad']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => SgaPropuestasEstado::className(), 'targetAttribute' => ['estado' => 'estado']],
            [['propuesta_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => SgaPropuestasTipo::className(), 'targetAttribute' => ['propuesta_tipo' => 'propuesta_tipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'propuesta' => Yii::t('app', 'Propuesta'),
            'nombre' => Yii::t('app', 'Nombre'),
            'nombre_abreviado' => Yii::t('app', 'Nombre Abreviado'),
            'codigo' => Yii::t('app', 'Codigo'),
            'propuesta_tipo' => Yii::t('app', 'Propuesta Tipo'),
            'publica' => Yii::t('app', 'Publica'),
            'documento_alta' => Yii::t('app', 'Documento Alta'),
            'fecha_alta' => Yii::t('app', 'Fecha Alta'),
            'campo_disciplinar' => Yii::t('app', 'Campo Disciplinar'),
            'escala_cumplimiento' => Yii::t('app', 'Escala Cumplimiento'),
            'documento_baja' => Yii::t('app', 'Documento Baja'),
            'fecha_baja' => Yii::t('app', 'Fecha Baja'),
            'a_termino' => Yii::t('app', 'A Termino'),
            'entidad' => Yii::t('app', 'Entidad'),
            'estado' => Yii::t('app', 'Estado'),
        ];
    }

    /**
     * Gets query for [[CampoDisciplinar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCampoDisciplinar()
    {
        return $this->hasOne(SgaCampoDisciplinar::className(), ['campo_disciplinar' => 'campo_disciplinar']);
    }

    /**
     * Gets query for [[Colacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColacions()
    {
        return $this->hasMany(SgaColacione::className(), ['colacion' => 'colacion'])->viaTable('{{%sga_colaciones_propuestas}}', ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[Competencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetencias()
    {
        return $this->hasMany(SgaCompetenciasIngreso::className(), ['competencia' => 'competencia'])->viaTable('{{%sga_competencias_ing_propuesta}}', ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[DocumentoAlta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoAlta()
    {
        return $this->hasOne(SgaDocumento::className(), ['documento' => 'documento_alta']);
    }

    /**
     * Gets query for [[DocumentoBaja]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoBaja()
    {
        return $this->hasOne(SgaDocumento::className(), ['documento' => 'documento_baja']);
    }

    /**
     * Gets query for [[Entidad0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntidad0()
    {
        return $this->hasOne(SgaG3entidade::className(), ['entidad' => 'entidad']);
    }

    /**
     * Gets query for [[EscalaCumplimiento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEscalaCumplimiento()
    {
        return $this->hasOne(SgaEscalasCumplimiento::className(), ['escala_cumplimiento' => 'escala_cumplimiento']);
    }

    /**
     * Gets query for [[Estado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(SgaPropuestasEstado::className(), ['estado' => 'estado']);
    }

    /**
     * Gets query for [[GdeConceptos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeConceptos()
    {
        return $this->hasMany(GdeConcepto::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[GdeElementos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeElementos()
    {
        return $this->hasMany(GdeElemento::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[GdeEncuestaPendientePropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeEncuestaPendientePropuestas()
    {
        return $this->hasMany(GdeEncuestaPendientePropuesta::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[GdeItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeItems()
    {
        return $this->hasMany(GdeItem::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[GdePropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdePropuestas()
    {
        return $this->hasMany(GdePropuesta::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[GrupoPropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoPropuestas()
    {
        return $this->hasMany(SgaPropuestasGrupo::className(), ['grupo_propuesta' => 'grupo_propuesta'])->viaTable('{{%sga_propuestas_x_grupo}}', ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[Habilitacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHabilitacions()
    {
        return $this->hasMany(GdeHabilitacione::className(), ['habilitacion' => 'habilitacion'])->viaTable('{{%gde_propuestas}}', ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[MenDominios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenDominios()
    {
        return $this->hasMany(MenDominio::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[Personas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(MdpPersona::className(), ['persona' => 'persona'])->viaTable('{{%sga_alumnos}}', ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[PropuestaTipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPropuestaTipo()
    {
        return $this->hasOne(SgaPropuestasTipo::className(), ['propuesta_tipo' => 'propuesta_tipo']);
    }

    /**
     * Gets query for [[ResponsableAcademicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableAcademicas()
    {
        return $this->hasMany(SgaResponsablesAcademica::className(), ['responsable_academica' => 'responsable_academica'])->viaTable('{{%sga_propuestas_ra}}', ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaAlumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaAlumnos()
    {
        return $this->hasMany(SgaAlumno::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaColacionesPropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaColacionesPropuestas()
    {
        return $this->hasMany(SgaColacionesPropuesta::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaComisionesPropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaComisionesPropuestas()
    {
        return $this->hasMany(SgaComisionesPropuesta::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaCompetenciasIngPropuesta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaCompetenciasIngPropuesta()
    {
        return $this->hasMany(SgaCompetenciasIngPropuestum::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaConvenios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaConvenios()
    {
        return $this->hasMany(SgaConvenio::className(), ['propuesta_base' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaConveniosPropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaConveniosPropuestas()
    {
        return $this->hasMany(SgaConveniosPropuesta::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaEquivInternas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaEquivInternas()
    {
        return $this->hasMany(SgaEquivInterna::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaEquivMatrices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaEquivMatrices()
    {
        return $this->hasMany(SgaEquivMatrix::className(), ['propuesta_origen' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaEquivTramites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaEquivTramites()
    {
        return $this->hasMany(SgaEquivTramite::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaLibrosActasPropuesta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaLibrosActasPropuesta()
    {
        return $this->hasMany(SgaLibrosActasPropuestum::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaLicenciasPropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaLicenciasPropuestas()
    {
        return $this->hasMany(SgaLicenciasPropuesta::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaMesasExamenPropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaMesasExamenPropuestas()
    {
        return $this->hasMany(SgaMesasExamenPropuesta::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPeriodosInscripcionAplanados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPeriodosInscripcionAplanados()
    {
        return $this->hasMany(SgaPeriodosInscripcionAplanado::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPeriodosInscripcionCoeficientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPeriodosInscripcionCoeficientes()
    {
        return $this->hasMany(SgaPeriodosInscripcionCoeficiente::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPlanes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPlanes()
    {
        return $this->hasMany(SgaPlane::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPreinscripcionPropuesta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPreinscripcionPropuesta()
    {
        return $this->hasMany(SgaPreinscripcionPropuestum::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPropuestasAreasTems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasAreasTems()
    {
        return $this->hasMany(SgaPropuestasAreasTem::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPropuestasAspiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasAspiras()
    {
        return $this->hasMany(SgaPropuestasAspira::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPropuestasOferta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasOferta()
    {
        return $this->hasMany(SgaPropuestasOfertum::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPropuestasRas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasRas()
    {
        return $this->hasMany(SgaPropuestasRa::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPropuestasRegularidads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasRegularidads()
    {
        return $this->hasMany(SgaPropuestasRegularidad::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPropuestasRelacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasRelacions()
    {
        return $this->hasMany(SgaPropuestasRelacion::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaPropuestasXGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaPropuestasXGrupos()
    {
        return $this->hasMany(SgaPropuestasXGrupo::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaSanciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaSanciones()
    {
        return $this->hasMany(SgaSancione::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[SgaUgPropuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaUgPropuestas()
    {
        return $this->hasMany(SgaUgPropuesta::className(), ['propuesta' => 'propuesta']);
    }

    /**
     * Gets query for [[Ubicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUbicacions()
    {
        return $this->hasMany(SgaUbicacione::className(), ['ubicacion' => 'ubicacion'])->viaTable('{{%sga_propuestas_oferta}}', ['propuesta' => 'propuesta']);
    }
}
