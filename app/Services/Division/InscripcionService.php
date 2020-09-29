<?php
namespace App\Services\Division;

class InscripcionService
{

    protected $inscripcionModel;
    protected $alumnoModel;

    function __construct()
    {
        $this->inscripcionModel = new \App\Models\Division\InscripcionModel();
        $this->alumnoModel = new \App\Models\AlumnoModel();
    }

    /**
     * Obtiene las inscripciónes por estatus de la BD
     * @return object
     */
    public function getInscripcionesPorEstatus($estatus)
	{   
       return $this->inscripcionModel->getInscripcionesPorEstatus($estatus);
    }

    /**
     * Guarda una nueva inscripción en la BD
     * @param array $datos
     * @return array
     */
    public function guardar($datos)
    {
        $alumno = $this->alumnoModel->getAlumnoPorNoControl($datos['num_control']);

        if($alumno != NULL)
        {
            $inscripcion = $this->inscripcionModel->getInscripcionPorNoControlPeriodoYActividad($datos['num_control'], $datos['periodo'], $datos['id_actividad']);

            if($inscripcion == NULL)
            {
                if ($this->inscripcionModel->guardar($datos))
                    return ["exito" => true, "msj" => "Inscripción agregada con exito."];
                else
                    return ["exito" => false, "msj" => "Algo salio mal, intentalo de nuevo."];
            }
            else 
            {
                return ["exito" => false, "msj" => "Ya se encuentra registrada una inscripción con la actividad selecionada!."];
            }
        }
        else
        {
            return ["exito" => false, "msj" => "No se encontro el número de control proporcionado."];
        }

    }

    /**
     * Actualiza los datos de una inscripción en la BD
     * @param array $datos
     * @return array
     */
    public function actualizar($id_inscripcion, $datos)
    {
        $inscripcion = $this->inscripcionModel->getInscripcionPorId($id_inscripcion);

        if($inscripcion != NULL)
        {
            $inscripcion_aux = $this->inscripcionModel->getInscripcionPorNoControlPeriodoYActividad($inscripcion->num_control, $datos['periodo'], $datos['id_actividad']);

            if($inscripcion_aux == NULL)
            {
                if ($this->inscripcionModel->actualizar($id_inscripcion, $datos))
                    return ["exito" => true, "msj" => "Datos actualizados con exito."];
                else
                    return ["exito" => false, "msj" => "No se actualizó ningun campo."];
            }
            else
            {
                return ["exito" => false, "msj" => "Ya se encuentra registrada una inscripción con la actividad selecionada!."];
            }
        }
        else 
        {
            return ["exito" => false, "msj" => "Id de actividad no válido!."];
        }
       
    }

    public function cambiarEstatus($id_inscripcion)
    {
        $inscripcion = $this->inscripcionModel->getInscripcionPorId($id_inscripcion);

        $nuevo_estatus = ($inscripcion->estatus == true) ? false : true;
        $datos = [ 'estatus' => $nuevo_estatus ];

        if ($this->inscripcionModel->actualizar($id_inscripcion, $datos))
            return ["exito" => true, "msj" => "Datos actualizados con exito."];
        else
            return ["exito" => false, "msj" => "No se actualizó ningun campo."];
    }

    public function getInscripcionPorId($id_inscripcion)
    {
        return $this->inscripcionModel->getInscripcionPorId($id_inscripcion);
    }

    /**
     * Esta función une registros de 2 BD mediante el numero de control del alumno
     * @param $array1
     * @param $array2
     * @return array
     */
    function unirRegistros($inscripciones)
    {
        if(count($inscripciones) > 0)
        {
            for($r = 0; $r < count($inscripciones); $r++)
            {
                $array1 = (array) $this->alumnoModel->getAlumnoPorNoControl($inscripciones[$r]->num_control);
                $array2 = (array) $inscripciones[$r];
                $array_merge[$r] = (object) array_merge($array1, $array2);
            }
            return $array_merge;
        }
        else
        {
            return $inscripciones;
        }
    }
}