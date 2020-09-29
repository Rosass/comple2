<?php $session = session(); ?>
<div class="container">
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
                <button class="btn btn-success mb-2" data-toggle="modal" data-target="#nuevaInscripcionModal"><i class="fas fa-plus"></i> Nueva inscripción</button>
            </div>
            <div class="table-responsive-sm text-center"> 
                <table class="table table-hover table-dark table-striped shadow-lg" id="tablaInscripciones">
                    <thead class="bg-color-tec-blue border-top-0 table-sm text-center">
                        <tr>
                            <th scope="col" colspan="13" class="border-top-0 p-3"><h3 class="mb-0">INSCRIPCIONES</h3></th>
                        </tr>
                        <tr>
                            <th scope="col" class="border-top-0">#</th>
                            <th scope="col" class="border-top-0">NO CONTROL</th>
                            <th scope="col" class="border-top-0">ALUMNO</th>
                            <th scope="col" class="border-top-0">CARRERA</th>
                            <th scope="col" class="border-top-0">SEMESTRE</th>
                            <th scope="col" class="border-top-0">PERIODO</th>
                            <th scope="col" class="border-top-0">ACTIVIDAD</th>
                            <th scope="col" class="border-top-0">FECHA DE INSCRIPCIÓN</th>
                            <th scope="col" class="border-top-0"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center table-sm">
                        <?php foreach($inscripciones as $key => $inscripcion) : ?>
                            <tr>
                                <th scope="row"><?= $key +1 ?></th>
                                <td><?= $inscripcion->num_control ?></td>
                                <td style="width:30%;"><?= $inscripcion->nombre . " " . $inscripcion->ap_paterno . " " . $inscripcion->ap_materno ?></td>
                                <td><?= $inscripcion->carrera?></td>
                                <td><?= $inscripcion->semestre?></td>
                                <td><?= $inscripcion->descripcion_periodo?></td>
                                <td><?= $inscripcion->nombre_actividad ?></td>
                                <td><?= $inscripcion->fecha_inscripcion ?></td>
                                <td style="width:12%;">
                                    <div class="d-flex flex-column">
                                        <!--  Editar inscripción -->
                                        <a class="btn btn-warning btn-sm btn-block mb-1" href="<?= base_url("division/inscripciones/editar/".$inscripcion->id_inscripcion) ?>"><i class="fas fa-pen"></i> Editar</a>
                                         <!-- Eliminar inscripción -->
                                        <form action="<?= base_url('division/inscripciones/cambiar-estatus') ?>" method="POST">
                                            <input type="hidden" name="id_inscripcion" value="<?= $inscripcion->id_inscripcion ?>">
                                            <button type="submit" class="btn btn-danger btn-sm btn-block btnEnviarFormulario" data-no_control="<?= $inscripcion->num_control ?>" ><i class="fas fa-trash"></i> Eliminar</button>
                                        </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar tipo de actividad-->
<?= view("Division/Inscripciones/agregar"); ?>