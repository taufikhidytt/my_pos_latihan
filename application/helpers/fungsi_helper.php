<?php

function on_session_login()
{
    $ci =& get_instance();
    $session = $ci->session->userdata('user_id');
    if($session)
    {
        redirect('dashboard');
    }
}

function off_session_login()
{
    $ci =& get_instance();
    $session = $ci->session->userdata('user_id');
    if(!$session)
    {
        $ci->session->set_flashdata('error', 'Anda Belum Login, Silahkan Login Terlebih Dahulu!');
        redirect('auth');
    }
}

function check_admin()
{
    $ci =& get_instance();
    $ci->load->library('fungsi_user');
    if($ci->fungsi_user->user_login()->level != 1){
        redirect('dashboard');
    }
}

function idr_format($idr)
{
    $idr = number_format($idr,2,",",".");
    return $idr;
}

?>