<?php

class Fungsi_user
{
    protected $ci;

    function __construct()
    {
        $this->ci =& get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('user_model');
        $user_id = $this->ci->session->userdata('user_id');
        $data = $this->ci->user_model->get($user_id)->row();
        return $data;
    }

    function pdfgenerator($html, $filename, $paper, $orientation)
    {
        // dari github composer require dompdf/dompdf

        // instantiate and use the dompdf class
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename, array('Attachment' => 0));
    }
}
?>