<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Preview');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="report-view bg-color">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="container text-center py-2">

        <div class="table-responsive">
            <table class="table">

                <?php if ($model->report_name == 0) { ?>
                    <thead>
                        <tr>
                            <th scope="col">Nº Doc</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Cond</th>
                            <th scope="col">Res</th>
                            <th scope="col">Nota</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Libro</th>
                            <th scope="col">Acta</th>
                            <th scope="col">Fo</th>
                            <th scope="col">Re</th>
                            <th scope="col">Re. F</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data as $r) { ?>
                            <tr>
                                <th scope="row"><?php echo $r['nro_documento'] ?></th>
                                <td><?php echo $r['code_subject'] ?></td>
                                <td><?php echo $r['cond_regularidad'] ?></td>
                                <td><?php echo $r['resultado'] ?></td>
                                <td><?php echo $r['nota'] ?></td>
                                <td><?php echo $r['fecha'] ?></td>
                                <td><?php echo $r['nro_libro'] ?></td>
                                <td><?php echo $r['nro_acta'] ?></td>
                                <td><?php echo $r['folio'] ?></td>
                                <td><?php echo $r['renglon'] ?></td>
                                <td><?php echo $r['renglones_folio'] ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>

                <?php } else if ($model->report_name == 1) { ?>

                    <thead>
                        <tr>
                            <th scope="col">Materia</th>
                            <th scope="col">Catedra</th>
                            <th scope="col">Aprobados</th>
                            <th scope="col">Reprobados</th>
                            <th scope="col">Ausentes</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data as $r) { ?>
                            <tr>
                                <th scope="row"><?php echo $r['code_subject'] ?></th>
                                <td><?php echo $r['catedra'] ?></td>
                                <td><?php echo $r['aprob'] ?></td>
                                <td><?php echo $r['repro'] ?></td>
                                <td><?php echo $r['ausen'] ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                <?php } else if ($model->report_name == 2) { ?>

                    <thead>
                        <tr>
                            <th scope="col">Comision</th>
                            <th scope="col">Catedra</th>
                            <th scope="col">Nº Doc</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Materia</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data as $r) { ?>
                            <tr>
                                <th scope="row"><?php echo $r['comision'] ?></th>
                                <td><?php echo $r['catedra'] ?></td>
                                <td><?php echo $r['nro_documento'] ?></td>
                                <td><?php echo $r['apellido'] ?></td>
                                <td><?php echo $r['nombres'] ?></td>
                                <td><?php echo $r['materia'] ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                <?php } ?>

            </table>
        </div>

    </div>

</div>