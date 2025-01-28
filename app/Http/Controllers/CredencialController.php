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

        $pdf = new TCPDF('L', 'mm', array(100, 70), true, 'UTF-8', false);

        // Establecer la información del documento
        // $pdf->SetCreator('Laravel');
        // $pdf->SetAuthor('Tu Empresa');
        // $pdf->SetTitle('Credencial');
        // Asegúrate de que no haya márgenes
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(false, 0);
        $pdf->SetSubject('Credencial de Identificación');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Agregar una página
        $pdf->AddPage();

        // Establecer el contenido de la credencial
        $pdf->SetFont('helvetica', '', 9);

        // Add background image
        $backgroundImagePath = storage_path('app/public/cre1.jpg'); // Path to your background image file
        $pdf->Image($backgroundImagePath, 0, 0, 100, 70, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
        // $backgroundImagePath = storage_path('app/public/cred_A.jpeg'); // Path to your background image file
        // $pdf->Image($backgroundImagePath, 0, 0, 100, 70, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);

        // Agregar la fotografía del registrar
        // if ($registrar->fotografia) {
        //     $fotografiaPath = storage_path('app/public/' . $registrar->fotografia);
        //     if (file_exists($fotografiaPath)) {
        //         // Ajusta estas coordenadas según necesites
        //         $pdf->Image($fotografiaPath, 4.5, 22.5, 39, 39, '', '', '', false, 300, '', false, false, 0);
        //     }
        // }
        // Agregar texto sobre la imagen de fondo
        $pdf->SetXY(46, 20); // Posición inicial del texto
        // $pdf->Cell(0, 10, 'Apellido: ' . htmlspecialchars($registrar['apellido']));
        $pdf->Cell(0, 9, htmlspecialchars($registrar['apellidos']));

        $pdf->SetXY(46, 27.2); // Nueva posición para el siguiente elemento
        $pdf->Cell(0, 9, htmlspecialchars($registrar['nombres']));


        $pdf->SetXY(46, 34.5); // Nueva posición para el siguiente elemento
        $pdf->Cell(0, 9, htmlspecialchars($registrar['centro_infantil']));

        
        
        $pdf->AddPage();
        
        // // Imagen del reverso
        $backgroundImagePath1 = storage_path('app/public/cre2.jpg');
        $pdf->Image($backgroundImagePath1, 0, 0, 100, 70, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
        // $backgroundImagePath1 = storage_path('app/public/cre_R.jpeg');
        // $pdf->Image($backgroundImagePath1, 0, 0, 100, 70, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
        
        // Si hay personas autorizadas, las mostramos en el reverso
        // $pdf->SetXY(10, 12.5); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['persona_autorizada1']));
        // $pdf->SetXY(10, 18.5); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['persona_autorizada2']));
        // $pdf->SetXY(10, 24.5); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['persona_autorizada3']));

        // $pdf->SetXY(60, 12.5); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['parentesco1']));
        // $pdf->SetXY(60, 18.5); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['parentesco2']));
        // $pdf->SetXY(60, 24.5); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['parentesco3']));
        
        // $pdf->SetXY(77, 12.5); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['celular1']));
        // $pdf->SetXY(77, 18.5); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['celular2']));
        // $pdf->SetXY(77, 24.5); // Nueva posición para el siguiente elemento
        // $pdf->Cell(0, 10, htmlspecialchars($registrar['celular3']));


        // Escribir el contenido HTML en el PDF
        // $pdf->writeHTML($html, true, false, true, false, '');

        // Salida del archivo PDF
        // $pdf->Output('credencial_' . $registrar->CI . '.pdf', 'I');
        $pdf->Output('credencial_.pdf', 'I');
    }
}
