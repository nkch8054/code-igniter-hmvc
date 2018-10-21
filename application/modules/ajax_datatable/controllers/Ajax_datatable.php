<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_datatable extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data["titles"] = "Codeigniter Ajax CRUDE with Data Table and Bootstrap models";
        $this->load->view('ajax_datatable', $data);
    }

    function fetch_user() {
        $this->load->model("ajax_model");
        $fetch_data = $this->ajax_model->make_datatable();
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $row->first_name;
            $sub_array[] = $row->last_name;
            $sub_array[] = '<button type="button" name="update" id="' . $row->id . '" class="btn btn-warning btn-xs">update</button>';
            $sub_array[] = '<button type="button" name="delete" id="' . $row->id . '" class="btn btn-danger btn-xs">delete</button>';
            $data = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->ajax_model->get_all_data(),
            "recordsFiltered" => $this->ajax_model->get_filter_data(),
            "data" => $data
        );
        //echo json_encode($output);
        return json_encode($output);
    }

    function getData() {
        $this->load->model("ajax_model");
        $data = $this->ajax_model->getData();
        echo $this->ajax_model->get_all_data();
        echo $this->ajax_model->get_filter_data();

        foreach ($data->result() as $row) {
            echo $row->last_name . " ";
            echo $row->first_name . '<br>';
        }
    }

}
