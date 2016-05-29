<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './fpdf/fpdf.php';

class PDF extends FPDF {

//Cabecera de página
    function Header() {
        $this->Image('./image/logoITV.jpg', 10, 8, 5);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Centro de Idioma', 0, 0, 'R');
    }

//Pie de página
    function Footer() {
        $this->SetY(-20);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 4, utf8_decode('Calz. Miguel Ángel de Quevedo 2779, Col. Formando Hogar '), 0, 1, 'C');
        $this->Cell(0, 4, 'C.P. 91897, H. Veracruz, Ver.,', 0, 1, 'C');
        $this->Cell(0, 4, 'Tel.: (229) 934 1500', 0, 1, 'C');
        $this->Cell(0, 4, 'www.itver.edu.mx', 0, 1, 'C');
    }

}

