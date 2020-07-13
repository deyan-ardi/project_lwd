<?php
defined('BASEPATH') or exit('No direct script access allowed');
class LWD_model extends CI_Model
{
    public function getLogin($id)
    {
        return $this->db->where('id =' . $id)->select('first_name')->from('users')->get()->result_array();
    }
    public function inputKomentar()
    {
        $query = [
            "user" => htmlspecialchars($this->input->post('nama', true)),
            "date" => "0000-00-00 00:00:00",
            "isi" => $this->input->post('komentar', true)
        ];
        $this->db->insert('komentar', $query);
    }
    public function getKomentar()
    {
        return $this->db->get('komentar')->result_array();
    }
    public function getCategory()
    {
        return $this->db->get('category')->result_array();
    }
    public function getCategoryId($id)
    {
        return $this->db->where('id_category=' . $id)->get('category')->result_array();
    }
    public function getDetailCategory($id)
    {
        $this->db->select('*');
        $this->db->from('detail_category');
        $this->db->join('category', 'category.id_category = detail_category.id_category');
        $this->db->where('id_user =', $id);
        return $this->db->get()->result_array();
    }
    public function getDetailCategoryId($id)
    {
        $this->db->select('*');
        $this->db->from('detail_category');
        $this->db->join('category', 'category.id_category = detail_category.id_category');
        return $this->db->where('detail_category.id_category=' . $id)->get()->result_array();
    }
    public function hapusKomentar($id)
    {
        $this->db->delete('komentar', array('id' => $id));
    }
    public function hapusProject($id)
    {
        $this->db->delete('about_me', array('id' => $id));
    }
    public function hapusCategory($id)
    {
        $this->db->select('*');
        $this->db->from('detail_category');
        $this->db->join('category', 'category.id_category = detail_category.id_category', 'inner');
        $data = $this->db->get()->result_array();
        if ($this->db->delete('category', array('id_category' => $id))) {
            foreach ($data as $dt) {
                unlink('upload/file/' . $dt['file_name']);
            }
        }
    }
    public function inputProject()
    {
        $query = [
            "project_name" => $this->input->post('project_name', true),
            "description" => $this->input->post('description', true),
            "link" => $this->input->post('link', true)
        ];
        $this->db->insert('about_me', $query);
    }
    public function inputCategory()
    {
        $query = [
            "category_name" => $this->input->post('category', true),
            "category_description" => $this->input->post('description', true),
            "category_date" => "0000-00-00 00:00:00",
            "category_by" => $this->input->post('nama', true)
        ];
        $this->db->insert('category', $query);
    }
    public function getProject()
    {
        return $this->db->get('about_me')->result_array();
    }
    public function editProject($id)
    {
        return $this->db->where('id=' . $id)->get('about_me')->result_array();
    }
    public function editCategory($id)
    {
        return $this->db->where('id_category=' . $id)->get('category')->result_array();
    }
    public function editFile($id)
    {
        $this->db->select('*');
        $this->db->where('id=' . $id);
        $this->db->from('detail_category');
        $this->db->join('category', 'category.id_category = detail_category.id_category');
        return $this->db->get()->result_array();
        // return $this->db->where('id=' . $id)->get('detail_category')->result_array();
    }
    public function prosesEditProject($id)
    {
        $query = [
            "project_name" => $this->input->post('project_name', true),
            "description" => $this->input->post('description', true),
            "link" => $this->input->post('link', true)
        ];
        $this->db->where('id=' . $id)->update('about_me', $query);
    }
    public function prosesEditCategory($id)
    {
        $query = [
            "category_name" => $this->input->post('category', true),
            "category_description" => $this->input->post('description', true),
            "category_date" => "0000-00-00 00:00:00",
            "category_by" => $this->input->post('nama', true)
        ];
        $this->db->where('id_category=' . $id)->update('category', $query);
    }
    // Fungsi untuk melakukan proses upload file  
    public function uploadFile($nama)
    {
        $config['upload_path'] = './upload/file';
        $config['allowed_types'] = 'zip';
        $config['max_size']  = '10048';
        $config['file_name'] = $nama;
        $config['remove_space'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        // Load konfigurasi uploadnya    
        if ($this->upload->do_upload('file')) {
            // Lakukan upload dan Cek jika proses upload berhasil      
            // Jika berhasil :      
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :      
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
    public function uploadFileEdit($nama, $id)
    {
        $row = $this->db->where('id=', $id)->get('detail_category')->row();
        unlink('upload/file/' . $row->file_name);
        $config['upload_path'] = './upload/file';
        $config['allowed_types'] = 'zip';
        $config['max_size']  = '10048';
        $config['file_name'] = $nama;
        $config['remove_space'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        // Load konfigurasi uploadnya    
        if ($this->upload->do_upload('file')) {
            // Lakukan upload dan Cek jika proses upload berhasil      
            // Jika berhasil :      
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :      
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
    // Fungsi untuk menyimpan data ke database  
    public function save($upload, $id)
    {
        $data = $this->input->post('file_name', true);
        $new_data = strtolower($data);
        $query = [
            "id_category" => $this->input->post('category', true),
            "name" => $new_data,
            "description" => $this->input->post('description', true),
            "date" => "0000-00-00 00:00:00",
            "file_protection" => $this->input->post('protection', true),
            "created_by" => $this->input->post('nama', true),
            "file_name" => $upload['file']['file_name'],
            "size" => $upload['file']['file_size'],
            "id_user" => $id
        ];
        $this->db->insert('detail_category', $query);
    }
    public function prosesEditFileDiubah($upload, $id)
    {
        $data = $this->input->post('file_name', true);
        $new_data = strtolower($data);
        $query = [
            "id_category" => $this->input->post('category', true),
            "name" => $new_data,
            "description" => $this->input->post('description', true),
            "date" => "0000-00-00 00:00:00",
            "file_protection" => $this->input->post('protection', true),
            "created_by" => $this->input->post('nama', true),
            "file_name" => $upload['file']['file_name'],
            "size" => $upload['file']['file_size']
        ];
        return $this->db->where('id=' . $id)->update('detail_category', $query);
    }
    public function prosesEditNamaDiubah($upload, $id)
    {
        $data = $this->input->post('file_name', true);
        $new_data = strtolower($data);
        $query = [
            "id_category" => $this->input->post('category', true),
            "name" => $new_data,
            "description" => $this->input->post('description', true),
            "date" => "0000-00-00 00:00:00",
            "file_protection" => $this->input->post('protection', true),
            "created_by" => $this->input->post('nama', true),
            "file_name" => $upload['file']['file_name'],
            "size" => $upload['file']['file_size']
        ];
        return $this->db->where('id=' . $id)->update('detail_category', $query);
    }
    public function prosesEditFileTidakDiubah($id)
    {
        $data = $this->input->post('file_name', true);
        $new_data = strtolower($data);
        $query = [
            "id_category" => $this->input->post('category', true),
            "name" => $new_data,
            "description" => $this->input->post('description', true),
            "date" => "0000-00-00 00:00:00",
            "file_protection" => $this->input->post('protection', true),
            "created_by" => $this->input->post('nama', true),
            "file_name" => $this->input->post('old_file', true),
            "size" => $this->input->post('old_file_size', true)
        ];
        return $this->db->where('id=' . $id)->update('detail_category', $query);
    }
    public function cekNamaFile($nama)
    {
        return $this->db->get_where('detail_category', array('name' => $nama))->num_rows();
    }
    public function hapusFile($id)
    {
        $row = $this->db->where('id=', $id)->get('detail_category')->row();
        if ($this->db->delete('detail_category', array('id' => $id))) {
            unlink('upload/file/' . $row->file_name);
        }
    }
    public function hapusDataInactive()
    {
        $waktu = 30;
        $active = 0;
        $this->db->where('TIMESTAMPDIFF(MINUTE, created_on, NOW()) >=', $waktu);
        $this->db->where('active =', $active);
        return $this->db->delete('users');
        // return var_dump(CURDATE());
    }
}