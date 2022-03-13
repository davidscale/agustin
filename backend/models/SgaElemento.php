<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%sga_elementos}}".
 *
 * @property int $elemento
 * @property string $nombre
 * @property string $nombre_abreviado
 * @property string|null $codigo
 * @property int $entidad_subtipo
 * @property int|null $entidad
 * @property string $compartible
 * @property string $estado
 * @property string|null $disponible_para
 *
 * @property SgaAlumnosCertificadosHa[] $alumnoCertificados
 * @property SgaCatedras[] $catedras
 * @property SgaCategoriasActividadesDet[] $categorias
 * @property SgaCertificadosConfigurarHa[] $certificadoHas
 * @property SgaConvenios[] $convenios
 * @property CtPlanActividades[] $ctPlanActividades
 * @property SgaG3entidades $entidad0
 * @property SgaG3entidadesSubtipos $entidadSubtipo
 * @property SgaElementosEstados $estado0
 * @property GdeActividades[] $gdeActividades
 * @property GdeConcepto[] $gdeConceptos
 * @property GdeElemento[] $gdeElementos
 * @property GdeItems[] $gdeItems
 * @property SgaActividadesGrupos[] $grupoActividads
 * @property GdeHabilitaciones[] $habilitacions
 * @property SgaCertificadosOtorg[] $nroSolicituds
 * @property SgaResponsablesAcademicas[] $responsableAcademicas
 * @property SgaResultadosAprendizaje[] $resultados
 * @property SgaResultadosAprendizaje[] $resultados0
 * @property SgaActivResultados[] $sgaActivResultados
 * @property SgaActividadesXGrupo[] $sgaActividadesXGrupos
 * @property SgaAlumnosElementosHa[] $sgaAlumnosElementosHas
 * @property SgaAlumnosOptativas[] $sgaAlumnosOptativas
 * @property SgaAlumnosOptativas[] $sgaAlumnosOptativas0
 * @property SgaAlumnosOrientMov[] $sgaAlumnosOrientMovs
 * @property SgaAlumnosOrient[] $sgaAlumnosOrients
 * @property SgaCatedrasActividades[] $sgaCatedrasActividades
 * @property SgaCertificadosHaNoElementos[] $sgaCertificadosHaNoElementos
 * @property SgaCertificadosHistacad[] $sgaCertificadosHistacads
 * @property SgaCertificadosOtorgOrie[] $sgaCertificadosOtorgOries
 * @property SgaComisiones[] $sgaComisiones
 * @property SgaCompetenciasXActividad[] $sgaCompetenciasXActividads
 * @property SgaConveniosActividades[] $sgaConveniosActividades
 * @property SgaElementosAtrib $sgaElementosAtrib
 * @property SgaElementosCategoria[] $sgaElementosCategorias
 * @property SgaElementosNoComunes[] $sgaElementosNoComunes
 * @property SgaElementosRa[] $sgaElementosRas
 * @property SgaElementosRevision[] $sgaElementosRevisions
 * @property SgaEquivActividades[] $sgaEquivActividades
 * @property SgaEquivInternas[] $sgaEquivInternas
 * @property SgaEquivOtorgada[] $sgaEquivOtorgadas
 * @property SgaExcepRegularidad[] $sgaExcepRegularidads
 * @property SgaInscCursadaActividad[] $sgaInscCursadaActividads
 * @property SgaIntegradoras[] $sgaIntegradoras
 * @property SgaLibrosActasActividad[] $sgaLibrosActasActividads
 * @property SgaMesasExamen[] $sgaMesasExamens
 * @property SgaReconocimientoAct[] $sgaReconocimientoActs
 * @property SgaRequisitosExcepciones[] $sgaRequisitosExcepciones
 * @property SgaResultadosActividades[] $sgaResultadosActividades
 * @property SgaTesis[] $sgaTeses
 * @property SgaTribunalActividades[] $sgaTribunalActividades
 * @property SgaTribunalExamen[] $tribunals
 */
class SgaElemento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sga_elementos}}';
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
            [['nombre', 'nombre_abreviado', 'entidad_subtipo', 'estado'], 'required'],
            [['entidad_subtipo', 'entidad'], 'default', 'value' => null],
            [['entidad_subtipo', 'entidad'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre_abreviado'], 'string', 'max' => 50],
            [['codigo'], 'string', 'max' => 20],
            [['compartible', 'estado', 'disponible_para'], 'string', 'max' => 1],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => SgaElementosEstados::className(), 'targetAttribute' => ['estado' => 'estado']],
            [['entidad'], 'exist', 'skipOnError' => true, 'targetClass' => SgaG3entidades::className(), 'targetAttribute' => ['entidad' => 'entidad']],
            [['entidad_subtipo'], 'exist', 'skipOnError' => true, 'targetClass' => SgaG3entidadesSubtipos::className(), 'targetAttribute' => ['entidad_subtipo' => 'entidad_subtipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'elemento' => Yii::t('app', 'Elemento'),
            'nombre' => Yii::t('app', 'Nombre'),
            'nombre_abreviado' => Yii::t('app', 'Nombre Abreviado'),
            'codigo' => Yii::t('app', 'Codigo'),
            'entidad_subtipo' => Yii::t('app', 'Entidad Subtipo'),
            'entidad' => Yii::t('app', 'Entidad'),
            'compartible' => Yii::t('app', 'Compartible'),
            'estado' => Yii::t('app', 'Estado'),
            'disponible_para' => Yii::t('app', 'Disponible Para'),
        ];
    }

    /**
     * Gets query for [[AlumnoCertificados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnoCertificados()
    {
        return $this->hasMany(SgaAlumnosCertificadosHa::className(), ['alumno_certificado' => 'alumno_certificado'])->viaTable('{{%sga_alumnos_elementos_ha}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[Catedras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatedras()
    {
        return $this->hasMany(SgaCatedras::className(), ['catedra' => 'catedra'])->viaTable('{{%sga_catedras_actividades}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[Categorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategorias()
    {
        return $this->hasMany(SgaCategoriasActividadesDet::className(), ['categoria' => 'categoria', 'valor' => 'valor'])->viaTable('{{%sga_elementos_categoria}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[CertificadoHas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCertificadoHas()
    {
        return $this->hasMany(SgaCertificadosConfigurarHa::className(), ['certificado_ha' => 'certificado_ha'])->viaTable('{{%sga_certificados_ha_no_elementos}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[Convenios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConvenios()
    {
        return $this->hasMany(SgaConvenios::className(), ['convenio' => 'convenio'])->viaTable('{{%sga_convenios_actividades}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[CtPlanActividades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtPlanActividades()
    {
        return $this->hasMany(CtPlanActividades::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[Entidad0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntidad0()
    {
        return $this->hasOne(SgaG3entidades::className(), ['entidad' => 'entidad']);
    }

    /**
     * Gets query for [[EntidadSubtipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntidadSubtipo()
    {
        return $this->hasOne(SgaG3entidadesSubtipos::className(), ['entidad_subtipo' => 'entidad_subtipo']);
    }

    /**
     * Gets query for [[Estado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(SgaElementosEstados::className(), ['estado' => 'estado']);
    }

    /**
     * Gets query for [[GdeActividades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeActividades()
    {
        return $this->hasMany(GdeActividades::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[GdeConceptos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeConceptos()
    {
        return $this->hasMany(GdeConcepto::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[GdeElementos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeElementos()
    {
        return $this->hasMany(GdeElemento::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[GdeItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGdeItems()
    {
        return $this->hasMany(GdeItems::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[GrupoActividads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoActividads()
    {
        return $this->hasMany(SgaActividadesGrupos::className(), ['grupo_actividad' => 'grupo_actividad'])->viaTable('{{%sga_actividades_x_grupo}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[Habilitacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHabilitacions()
    {
        return $this->hasMany(GdeHabilitaciones::className(), ['habilitacion' => 'habilitacion'])->viaTable('{{%gde_actividades}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[NroSolicituds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNroSolicituds()
    {
        return $this->hasMany(SgaCertificadosOtorg::className(), ['nro_solicitud' => 'nro_solicitud'])->viaTable('{{%sga_certificados_otorg_orie}}', ['orientacion' => 'elemento']);
    }

    /**
     * Gets query for [[ResponsableAcademicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableAcademicas()
    {
        return $this->hasMany(SgaResponsablesAcademicas::className(), ['responsable_academica' => 'responsable_academica'])->viaTable('{{%sga_elementos_ra}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[Resultados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResultados()
    {
        return $this->hasMany(SgaResultadosAprendizaje::className(), ['resultado' => 'resultado'])->viaTable('{{%sga_activ_resultados}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[Resultados0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResultados0()
    {
        return $this->hasMany(SgaResultadosAprendizaje::className(), ['resultado' => 'resultado'])->viaTable('{{%sga_resultados_actividades}}', ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaActivResultados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaActivResultados()
    {
        return $this->hasMany(SgaActivResultados::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaActividadesXGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaActividadesXGrupos()
    {
        return $this->hasMany(SgaActividadesXGrupo::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaAlumnosElementosHas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaAlumnosElementosHas()
    {
        return $this->hasMany(SgaAlumnosElementosHa::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaAlumnosOptativas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaAlumnosOptativas()
    {
        return $this->hasMany(SgaAlumnosOptativas::className(), ['optativa' => 'elemento']);
    }

    /**
     * Gets query for [[SgaAlumnosOptativas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaAlumnosOptativas0()
    {
        return $this->hasMany(SgaAlumnosOptativas::className(), ['generica' => 'elemento']);
    }

    /**
     * Gets query for [[SgaAlumnosOrientMovs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaAlumnosOrientMovs()
    {
        return $this->hasMany(SgaAlumnosOrientMov::className(), ['orientacion' => 'elemento']);
    }

    /**
     * Gets query for [[SgaAlumnosOrients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaAlumnosOrients()
    {
        return $this->hasMany(SgaAlumnosOrient::className(), ['orientacion' => 'elemento']);
    }

    /**
     * Gets query for [[SgaCatedrasActividades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaCatedrasActividades()
    {
        return $this->hasMany(SgaCatedrasActividades::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaCertificadosHaNoElementos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaCertificadosHaNoElementos()
    {
        return $this->hasMany(SgaCertificadosHaNoElementos::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaCertificadosHistacads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaCertificadosHistacads()
    {
        return $this->hasMany(SgaCertificadosHistacad::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaCertificadosOtorgOries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaCertificadosOtorgOries()
    {
        return $this->hasMany(SgaCertificadosOtorgOrie::className(), ['orientacion' => 'elemento']);
    }

    /**
     * Gets query for [[SgaComisiones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaComisiones()
    {
        return $this->hasMany(SgaComisiones::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaCompetenciasXActividads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaCompetenciasXActividads()
    {
        return $this->hasMany(SgaCompetenciasXActividad::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaConveniosActividades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaConveniosActividades()
    {
        return $this->hasMany(SgaConveniosActividades::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaElementosAtrib]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaElementosAtrib()
    {
        return $this->hasOne(SgaElementosAtrib::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaElementosCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaElementosCategorias()
    {
        return $this->hasMany(SgaElementosCategoria::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaElementosNoComunes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaElementosNoComunes()
    {
        return $this->hasMany(SgaElementosNoComunes::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaElementosRas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaElementosRas()
    {
        return $this->hasMany(SgaElementosRa::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaElementosRevisions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaElementosRevisions()
    {
        return $this->hasMany(SgaElementosRevision::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaEquivActividades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaEquivActividades()
    {
        return $this->hasMany(SgaEquivActividades::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaEquivInternas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaEquivInternas()
    {
        return $this->hasMany(SgaEquivInternas::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaEquivOtorgadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaEquivOtorgadas()
    {
        return $this->hasMany(SgaEquivOtorgada::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaExcepRegularidads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaExcepRegularidads()
    {
        return $this->hasMany(SgaExcepRegularidad::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaInscCursadaActividads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaInscCursadaActividads()
    {
        return $this->hasMany(SgaInscCursadaActividad::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaIntegradoras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaIntegradoras()
    {
        return $this->hasMany(SgaIntegradoras::className(), ['actividad' => 'elemento']);
    }

    /**
     * Gets query for [[SgaLibrosActasActividads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaLibrosActasActividads()
    {
        return $this->hasMany(SgaLibrosActasActividad::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaMesasExamens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaMesasExamens()
    {
        return $this->hasMany(SgaMesasExamen::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaReconocimientoActs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaReconocimientoActs()
    {
        return $this->hasMany(SgaReconocimientoAct::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaRequisitosExcepciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaRequisitosExcepciones()
    {
        return $this->hasMany(SgaRequisitosExcepciones::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaResultadosActividades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaResultadosActividades()
    {
        return $this->hasMany(SgaResultadosActividades::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[SgaTeses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaTeses()
    {
        return $this->hasMany(SgaTesis::className(), ['actividad' => 'elemento']);
    }

    /**
     * Gets query for [[SgaTribunalActividades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgaTribunalActividades()
    {
        return $this->hasMany(SgaTribunalActividades::className(), ['elemento' => 'elemento']);
    }

    /**
     * Gets query for [[Tribunals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTribunals()
    {
        return $this->hasMany(SgaTribunalExamen::className(), ['tribunal' => 'tribunal'])->viaTable('{{%sga_tribunal_actividades}}', ['elemento' => 'elemento']);
    }
}
