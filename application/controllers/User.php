<?php
class User extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Beranda - User';
        $data['id'] = '1';
        $data['active'] = 'active';
        // Hapus User
        $this->LWD_model->hapusDataInactive();
        $this->load->view('user/templates/header', $data);
        if ($this->ion_auth->logged_in()) {
            if ($this->ion_auth->is_admin()) {
                redirect('adminlwd', 'refresh');
            } else {
                $id = $_SESSION['user_id'];
                $data['id_login'] = $_SESSION['user_id'];
                $data['login'] = $this->LWD_model->getLogin($id);
                $this->load->view('user/templates/navbar_login', $data);
            }
        } else {
            $this->load->view('user/templates/navbar', $data);
        }
        $this->load->view('user/index');
        $this->load->view('user/templates/footer');
    }
    public function projectku()
    {
        $data['judul'] = 'Tentang Saya - User';
        $data['id'] = '2';
        $data['active'] = 'active';
        // Hapus User
        $this->LWD_model->hapusDataInactive();
        $data['project'] = $this->LWD_model->getProject();
        $this->load->view('user/templates/header', $data);
        if ($this->ion_auth->logged_in()) {
            if ($this->ion_auth->is_admin()) {
                redirect('adminlwd', 'refresh');
            } else {
                $id = $_SESSION['user_id'];
                $data['login'] = $this->LWD_model->getLogin($id);
                $data['id_login'] = $_SESSION['user_id'];
                $this->load->view('user/templates/navbar_login', $data);
            }
        } else {
            $this->load->view('user/templates/navbar', $data);
        }
        $this->load->view('user/about');
        $this->load->view('user/templates/footer');
    }
    public function directory()
    {
        $data['judul'] = 'Directory Download - User';
        $data['id'] = '3';
        $data['active'] = 'active';
        // Hapus User
        $this->LWD_model->hapusDataInactive();
        $data['category'] = $this->LWD_model->getCategory();
        $data['komentar'] = $this->LWD_model->getKomentar();
        if ($this->ion_auth->logged_in()) {
            $id = $_SESSION['user_id'];
            $data['id_login'] = $_SESSION['user_id'];
            $data['login'] = $this->LWD_model->getLogin($id);
            if ($this->ion_auth->is_admin()) {
                redirect('adminlwd', 'refresh');
            } else {
                $this->form_validation->set_rules('komentar', 'Komentar', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('user/templates/header', $data);
                    $this->load->view('user/templates/navbar_login', $data);
                    $this->load->view('user/directory', $data);
                    $this->load->view('user/templates/footer');
                } else {
                    $this->LWD_model->inputKomentar();
                    $this->session->set_flashdata('flash', 'Success Sending Message');
                    redirect('user/directory');
                }
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    public function detail_berkas($id)
    {
        $data['judul'] = 'Detail Berkas - User';
        $data['id'] = '3';
        $data['active'] = 'active';
        // Hapus User
        $this->LWD_model->hapusDataInactive();
        $data['category'] = $this->LWD_model->getCategoryId($id);
        $data['detail_category'] = $this->LWD_model->getDetailCategoryId($id);
        if ($this->ion_auth->logged_in()) {
            $id = $_SESSION['user_id'];
            $data['login'] = $this->LWD_model->getLogin($id);
            $data['id_login'] = $_SESSION['user_id'];
            if ($this->ion_auth->is_admin()) {
                redirect('adminlwd', 'refresh');
            } else {
                $this->load->view('user/templates/header', $data);
                $this->load->view('user/templates/navbar_login', $data);
                $this->load->view('user/detail', $data);
                $this->load->view('user/templates/footer');
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    public function artikel()
    {
        $data['judul'] = 'Kumpulan Artikel - User';
        $data['id'] = '4';
        $data['active'] = 'active';
        // Hapus User
        $this->LWD_model->hapusDataInactive();
        $this->LWD_model->getArticle();
        $this->load->view('user/templates/header', $data);
        if ($this->ion_auth->logged_in()) {
            if ($this->ion_auth->is_admin()) {
                redirect('adminlwd', 'refresh');
            } else {
                $id = $_SESSION['user_id'];
                $data['id_login'] = $_SESSION['user_id'];
                $data['login'] = $this->LWD_model->getLogin($id);
                $this->load->view('user/templates/navbar_login', $data);
            }
        } else {
            $this->load->view('user/templates/navbar', $data);
        }
        $this->load->view('user/article', $data);
        $this->load->view('user/templates/footer');
    }
}