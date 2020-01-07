<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', 'Menu Added!');
            redirect('menu');
        }
    }

    public function edit_menu($id)
    {
        $menu = $this->input->post('menu');
        $this->db->set('menu', $menu);
        $this->db->where('id', $id);
        $this->db->update('user_menu');
        $this->session->set_flashdata('message', 'Menu Edited!');
        redirect('menu/');
    }

    public function edit_submenu($id)
    {
    }

    public function subMenu()
    {
        $data['title'] = 'SubMenu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', 'Sub Menu Added!');
            redirect('menu/submenu');
        }
    }

    public function deletemenu($id)
    {
        $delete = $this->db->delete('user_menu', array('id' => $id));
        if ($delete) {
            $this->session->set_flashdata('message', 'Menu has been Successfully Deleted!');
            redirect('menu/');
        }
    }

    public function deletesubmenu($id)
    {
        $delete = $this->db->delete('user_sub_menu', array('id' => $id));
        if ($delete) {
            $this->session->set_flashdata('message', 'Submenu has been Successfully Deleted!');
            redirect('menu/submenu');
        }
    }
}
