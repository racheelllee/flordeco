<?php

#namespace App\Shell;
#use Cake\Console\Shell;

class CustomPDF extends \TCPDF {
    public function Header() {
        $this->Image(WWW_ROOT . 'templates/pdf/header.png', 25, 20, 150, '', 'png', '', 'C');
    }
    public function Footer() {
        $this->Image(WWW_ROOT . 'templates/pdf/footer.png', 0, 272, 210, '', 'png', '', 'C');
    }
}