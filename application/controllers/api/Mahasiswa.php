<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Mahasiswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelmodel');
        $this->load->library('form_validation');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
        header("Access-Control-Max-Age", "3600");
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        header("Access-Control-Allow-Credentials", "true");
    }
    public function index_get()
    {
        $id = $this->input->get('id');

        if($id === null){
            $mahasiswa = $this->Modelmodel->showdata("SELECT * from mahasiswa");
        }else{
            $mahasiswa = $this->Modelmodel->showsingle("SELECT * from mahasiswa where id='".$id."'");
        }

        if($mahasiswa){
            $this->response([
                'status'  => true,
                'data'    => $mahasiswa
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'    => false,
                'message'   => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if($id == null){
            $this->response([
                'status'    => false,
                'message'   => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            $mahasiswa = $this->Modelmodel->queryupdate("DELETE from mahasiswa where id='".$id."'");
            if($mahasiswa)             {
                $this->response([
                    'status'    => true,
                    'message'   => 'data terhapus!',
                    'data'      => $id
                ], REST_Controller::HTTP_OK); 
            }else{
                $this->response([
                    'status'    => false,
                    'message'   => 'id not found!'
                ], REST_Controller::HTTP_BAD_REQUEST); 
            }
        }
    }

    public function index_post()
    {
        $config = [
            [
                'field' => 'nrp',
                'label' => 'Nrp',
                'rules' => 'required|min_length[10]',
                'errors' => [
                        'required' => 'Nrp tidak boleh kosong',
                        'min_length' => 'Minimum Password length is 10 characters',
                ],
            ],
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                        'required' => 'nama tidak boleh kosong',
                ],
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                        'required' => 'Email Tidak boleh kosong',
                ],
            ],
            [
                'field' => 'jurusan',
                'label' => 'Jurusan',
                'rules' => 'required',
                'errors' => [
                        'required' => 'jurusan tidak boleh kosong',
                ],
            ],
            
        ];
        
        $data = $this->input->post();
        
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run()==FALSE){
            $this->response([
                'status'    => false,
                'message'   => 'form-error!',
                'data'      => $this->form_validation->error_array()
            ], REST_Controller::HTTP_BAD_REQUEST); 

        }else{
            $cek = $this->Modelmodel->queryhandle("INSERT into mahasiswa (nrp, nama, email, jurusan) VALUES 
            ('".$data['nrp']."','".$data['nama']."','".$data['email']."','".$data['jurusan']."')");
            $detailmahasiswa = $this->Modelmodel->showsingle("SELECT * from mahasiswa where nrp='".$data['nrp']."'");
            $this->response([
                'status'    => true,
                'message'   => 'data mahasiswa berhasil dibuat',
                'data'      => $detailmahasiswa
            ], REST_Controller::HTTP_CREATED);
        }
    }

    public function index_put()
    {
        $config = [
            [
                'field' => 'nrp',
                'label' => 'Nrp',
                'rules' => 'required|min_length[10]',
                'errors' => [
                        'required' => 'Nrp tidak boleh kosong',
                        'min_length' => 'Minimum Password length is 10 characters',
                ],
            ],
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                        'required' => 'nama tidak boleh kosong',
                ],
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                        'required' => 'Email Tidak boleh kosong',
                ],
            ],
            [
                'field' => 'jurusan',
                'label' => 'Jurusan',
                'rules' => 'required',
                'errors' => [
                        'required' => 'jurusan tidak boleh kosong',
                ],
            ],
            
        ];
        
        $data = $this->put();
        
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run()==FALSE){
            $this->response([
                'status'    => false,
                'message'   => 'form-error!',
                'data'      => $this->form_validation->error_array()
            ], REST_Controller::HTTP_BAD_REQUEST); 

        }else{
            $mahasiswa = $this->Modelmodel->queryupdate("UPDATE mahasiswa SET nrp='".$data['nrp']."', nama='".$data['nama']."', email='".$data['email']."', jurusan='".$data['jurusan']."' WHERE id='".$data['id']."'");
            $detailmahasiswa = $this->Modelmodel->showsingle("SELECT * from mahasiswa where nrp='".$data['nrp']."'");
            
            if($mahasiswa){
                $this->response([
                    'status'    => true,
                    'message'   => 'data mahasiswa berhasil diubah',
                    'data'      => $detailmahasiswa
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status'    => false,
                    'message'   => 'data mahasiswa gagaldiubah',
                    'data'      => $detailmahasiswa
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}