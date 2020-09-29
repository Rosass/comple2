<?php $session = session(); ?>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-md-12">
            <!-- Mensajes de error -->
			<?php if($session->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $session->getFlashdata('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
			<?php endif ?>
			<!-- Mensajes satisfactorios -->
			<?php if($session->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $session->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
			<?php endif ?>
            <div class="text-right">
                <button class="btn btn-success mb-2" data-toggle="modal" data-target="#nuevaActividadModal"><i class="fas fa-plus"></i> Nueva actividad</button>
            </div>
            <div class="table-responsive-sm text-center">
                <table class="table table-hover table-dark table-striped shadow-lg" id="tablaActividades">
                    <thead class="bg-color-tec-blue border-top-0 table-sm text-center">
                        <tr>
                            <th scope="col" colspan="13" class="border-top-0 p-2"><h3 class="mb-0">ACTIVIDADES ACTIVAS</h3></th>
                        </tr>
                        <tr>
                            <th scope="col" class="border-top-0">#</th>
                            <th scope="col" class="border-top-0">NOMBRE</th>
                            <th scope="col" class="border-top-0">DICTAMEN</th>
                            <th scope="col" class="border-top-0">CRED.</th>
                            <th scope="col" class="border-top-0">CAPACIDAD</th>
                            <th scope="col" class="border-top-0">AREA</th>
                            <th scope="col" class="border-top-0">PERIODO</th>
                            <th scope="col" class="border-top-0">TIPO</th>
                            <th scope="col" class="border-top-0">RESPONSABLE</th>
                            <th scope="col" class="border-top-0">HORAS</th>
                            <th scope="col" class="border-top-0">HORARIO</th>
                            <th scope="col" class="border-top-0">ESTATUS</th>
                            <th scope="col" class="border-top-0"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center table-sm">
                        <?php foreach($actividades as $key => $actividad) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><?= $actividad->nombre_actividad ?></td>
                                <td><?= $actividad->numero_dictamen ?></td>
                                <td><?= $actividad->creditos ?></td>
                                <td><?= $actividad->capacidad ?></td>
                                <td><?= $actividad->nombre_area ?></td>
                                <td><?= $actividad->periodo_descripcion ?></td>
                                <td><?= $actividad->tipo_actividad ?></td>
                                <td><?= $actividad->rfc_responsable ?></td>
                                <td><?= $actividad->horas ?></td>
                                <td><?= $actividad->horario ?></td>
                                <td>
                                    <?php if($actividad->estatus == true) : ?>
                                        <span class="bg-success p-1 rounded small">Activo</span>
                                    <?php else : ?>
                                        <span class="bg-danger p-1 rounded small">Inactivo</span>
                                    <?php endif ?>
                                </td>
                                <td style="width:8%;">
                                    <div class="d-flex flex-column">
                                        <!--  Editar responsable-->
                                        <a class="btn btn-warning btn-sm btn-block mb-1" href="<?= base_url("division/actividades/editar/".$actividad->id_actividad) ?>"><i class="fas fa-pen"></i> Editar</a>
                                        <?php if($actividad->estatus == true) : ?>
                                            <form action="<?= base_url('division/actividades/cambiar-estatus') ?>" method="POST">
                                                <input type="hidden" name="id_actividad" value="<?= $actividad->id_actividad ?>">
                                                <button type="submit" class="btn btn-danger btn-sm btn-block btnEnviarFormulario"><i class="fas fa-ban"></i> Inhabilitar</button>
                                            </form>
                                        <?php else : ?>
                                            <form action="<?= base_url('division/actividades/cambiar-estatus') ?>" method="POST">
                                                <input type="hidden" name="id_actividad" value="<?= $actividad->id_actividad ?>">
                                                <button type="submit" class="btn btn-success btn-sm btn-block btnEnviarFormulario"><i class="fas fa-check"></i> Habilitar</button>
                                            </form>
                                        <?php endif ?>
                                    </div>
							    </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Responsable-->
<?= view("Division/Actividades/agregar"); ?>