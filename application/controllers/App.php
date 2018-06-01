<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class App extends CI_Controller {

    function __construct() {
      parent::__construct();

      $loggedIn=$this->session->userdata('logged-in');

      if(!isset($loggedIn) || $loggedIn!=true) {
        show_404();
      }
    }

    function index() {
      // $data['todos']=$this->model->read_todos();
      $data['todos']=$this->model->ra_object('todo','idAccess',$this->session->userdata('id'));

      foreach ($data['todos'] as $todo) {
        $attachments=$this->model->ra_object('attachment','idTodo',$todo->id);
        if($attachments) {
          $todo->attachments=$attachments;
        }
      }
      $this->load->view('header');
      $this->load->view('list',$data);
      $this->load->view('footer');
    }

    function todo() {
      $id=$this->uri->segment(3);
      // $data['todo']=$this->model->read_todo($id);
      $data['todo']=$this->model->r_object('todo',$id,$this->session->userdata('id'));
      if($data['todo']) {
        $this->load->view('header');
        $this->load->view('single_todo',$data);
        $this->load->view('footer');
      } else {
        show_404();
      }
    }

    function new_todo() {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('todo','Todo Text', 'trim|required');

      if($this->form_validation->run()==FALSE) {
        $this->index();
      } else {
        $data=array(
          'idAccess'=> $this->session->userdata('id'),
          'text'=>$this->input->post('todo'),
          'createdAt'=>date('Y-m-d H:i:s')
        );

        // $this->model->create_todo($data);
        $this->model->c_object('todo',$data);
        redirect('app/index');
      }
    }

    function check() {
      //questa funzione va ad assegnare alla variabile $id il valore che è contenuto nel terzo segmento dell'url
      //es: http://localhost/project/index.php/app/check/3 allora $id=3
      $id=$this->uri->segment(3);
      $data=array(
        'completed'=>1
      );
      // $this->model->update_todo($id,$data);
        $this->model->u_object('todo',$id,$data,$this->session->userdata('id'));
      redirect('app');
    }

    function uncheck() {
      //questa funzione va ad assegnare alla variabile $id il valore che è contenuto nel terzo segmento dell'url
      //es: http://localhost/project/index.php/app/check/3 allora $id=3
      $id=$this->uri->segment(3);
      $data=array(
        'completed'=>0
      );
      // $this->model->update_todo($id,$data);
      $this->model->u_object('todo',$id,$data,$this->session->userdata('id'));
      redirect('app');
    }

    // function destroy_todo() {
    //   $id=$this->uri->segment(3);
    //   // $this->model->delete_todo($id);
    //   $this->model->d_object('todo',$id,$this->session->userdata('id'));
    //   redirect('app');
    // }
    function destroy_todo() {
      $id=$this->uri->segment(3);
      // $this->model->delete_todo($id);
      $this->model->d_object('todo',$id,$this->session->userdata('id'));
      //   redirect('app');
      $data['todos']=$this->model->ra_object('todo','idAccess',$this->session->userdata('id'));
      // questo foreach serve per prelevare tutti gli allegati dei to-do che stiamo visualizzando
      foreach ($data['todos'] as $todo) {
          $attachments=$this->model->ra_object('attachment','idTodo',$todo->id);
          if($attachments) {
              $todo->attachments=$attachments;
          }
      }
      $this->load->view('ajax/list',$data);
    }

    function upd_todo() {
      $id=$this->input->post('id');
      $data=array(
        'text'=>$this->input->post('todo')
      );
      // $this->model->update_todo($id,$data);
      $this->model->u_object('todo',$id,$data,$this->session->userdata('id'));
      redirect('app');
    }



    // Upload
    function new_attachment() {
      // $_FILES è una variabile globale che essendo un array tiene tutti i dati dei file che vengono uploadati
      // Eseguo l'if se la dimensione del file è diversa da zero
      if(!($_FILES['file']['size']==0)) {
        // Carichiamo la libreria 'upload'
        $this->load->library('upload');

        // Configuriamo la nostra libreria di 'upload'
        $config['upload_path']="./resources/attachments"; // i file caricati andranno salvati in ../resources/attachments
        $config['allowed_types']="jpg|png"; // impostiamo quali tipi di dati sono accettati
        $config['file_ext_tolower']=true; // serve per file.JPG->file.jpg
        $config['overwrite']=false; // per evitare che un nuovo file con un nome di uno già esistente, venga sovrascritto a file già esistente
        $this->upload->initialize($config); // per far si che la libreria 'upload' faccia le configurazioni precedenti

        if($this->upload->do_upload('file')) { // Eseguo l'if se la libreria upload ha caricato bene il file
          $file=$this->upload->data(); // Creo una variabile che conterrà tutti i file del file appena caricato
          // Salvare i dati del db, usando un array associativo chiamato 'data'
          $data=array(
            'idTodo'=>$this->uri->segment(3),
            'attachment'=>$file['raw_name'],
            'type'=>$file['file_ext']
          );
          $this->model->c_object('attachment',$data); // Salviamo i dati nella tabella 'attachment' nel db
          // reindirizzare l'utente alla pagina principale
          redirect('app');
        } else {
          // Error
        }
      } else {
        // No file
      }
    }


  }

?>
