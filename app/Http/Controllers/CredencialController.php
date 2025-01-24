<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\Registrar;
// use Carbon\Carbon;

class CredencialController extends Controller
{
    public function generarCredencial($id)
    {
        // Obtener los datos del modelo Registrar usando el ID
        $registrar = Registrar::findOrFail($id);
        // Asegúrate de que la fecha sea una instancia de Carbon
        // $fechaNacimiento = Carbon::parse($registrar->fecha_nacimiento);
        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF('L', 'mm', array(215, 270), true, 'UTF-8', false);

        // Establecer la información del documento
        $pdf->SetCreator('Laravel');
        $pdf->SetAuthor('Tu Empresa');
        $pdf->SetTitle('Credencial');
        $pdf->SetSubject('Credencial de Identificación');

        // Agregar una página
        $pdf->AddPage();

        // Establecer el contenido de la credencial
        $pdf->SetFont('helvetica', '', 12);

        // Add background image
        $backgroundImagePath = public_path('storage/cred_A.jpeg'); // Path to your background image file
        $pdf->Image($backgroundImagePath, 20, 60, 100, 70, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);

        $backgroundImagePath1 = public_path('storage/cre_R.jpeg'); // Path to your background image file
        $pdf->Image($backgroundImagePath1, 140, 60, 100, 70, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);

        // Agregar texto sobre la imagen de fondo
        $pdf->SetXY(70, 80); // Posición inicial del texto
        // $pdf->Cell(0, 10, 'Apellido: ' . htmlspecialchars($registrar['apellido']));
        $pdf->Cell(0, 9, htmlspecialchars($registrar['apellidos']));
        
        $pdf->SetXY(70, 87); // Nueva posición para el siguiente elemento
        $pdf->Cell(0, 10, htmlspecialchars($registrar['nombres']));


        $pdf->SetXY(70, 94); // Nueva posición para el siguiente elemento
        $pdf->Cell(0, 10,htmlspecialchars($registrar['centro_infantil']));
        
        $pdf->SetXY(70, 101); // Nueva posición para el siguiente elemento
        $pdf->Cell(0, 10, htmlspecialchars($registrar['parentesco']));

        $pdf->SetXY(70, 108); // Nueva posición para el siguiente elemento
        $pdf->Cell(0, 10, htmlspecialchars($registrar['celular']));

        // $pdf->SetXY(70, 98); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['personas_autorizadas']));
        // $html = "
        //     <h1 style='text-align:center;'>Credencial de Identificación</h1>
        //     <table border='1' cellpadding='5'>
        //         <tr>
        //             <td><strong>Nombre:</strong> {$registrar->nombre}</td>
        //         </tr>
        //         <tr>
        //             <td><strong>Apellido:</strong> {$registrar->apellido}</td>
        //         </tr>
        //         <tr>
        //             <td><strong>C.I.:</strong> {$registrar->CI}</td>
        //         </tr>
        //         <tr>
        //             <td><strong>Celular:</strong> {$registrar->celular}</td>
        //         </tr>
        //         <tr>
        //             <td><strong>Fecha de Nacimiento:</strong> {$fechaNacimiento->format('d-m-Y')}</td>
        //         </tr>
        //     </table>
        // ";

        // Escribir el contenido HTML en el PDF
        // $pdf->writeHTML($html, true, false, true, false, '');

        // Salida del archivo PDF
        // $pdf->Output('credencial_' . $registrar->CI . '.pdf', 'I');
        $pdf->Output('credencial_.pdf', 'I');

    }
}
