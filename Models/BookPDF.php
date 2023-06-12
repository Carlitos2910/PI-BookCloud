<?php

    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;

    class BookPDF extends FPDF{

        // function Header() {
        //     // Encabezado de página
        //     $this->SetFont('Arial', 'B', 14);
        //     $this->Cell(0, 10, $this->titulo, 0, 1, 'C');
        //     $this->Ln(5);
        // }
        
        function Footer() {
            // Pie de página
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
        }
        
        function ChapterTitle($title) {
            // Título del capítulo
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, $title, 0, 1, 'L');
            $this->Ln(4);
        }
        
        function ChapterContent($content) {
            // Contenido del capítulo
            $this->SetFont('Arial', '', 11);
            $this->MultiCell(0, 8, $content);
            $this->Ln(8);
        }

    }