<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Model extends CI_Model {
    // LOGIN
    function validate_credentials($email,$password) {
      $this->db->select('*');
      $this->db->from('access');
      $this->db->where('email',$email);
      $this->db->where('password',sha1($password));
      $query=$this->db->get();

      if($query && $query->num_rows()==1) {
        return $query->result()[0];
      } else {
        return null;
      }
    }


    // CRUD: C-Create, R-Read, U-Update, D-Delete
    // C-CREATE
    // function create_todo($data) {
    //   $this->db->insert('todo',$data);
    // }
    function c_object($table,$data) {
      $this->db->insert($table,$data);
    }

    // R-READ
    // function read_todos() {
    //   // $query=$this->db->query('SELECT * FROM todo');
    //   $this->db->select('*');
    //   $this->db->from('todo');
    //   $query=$this->db->get();
    //
    //   if($query->num_rows()>0) {
    //     foreach ($query->result() as $row) {
    //       $data[]=$row;
    //     }
    //     return $data;
    //   }
    // }
    function ra_object($table,$column,$access) {
      // $query=$this->db->query('SELECT * FROM todo');
      $this->db->select('*');
      $this->db->from($table);
      if($column && $access) {
        $this->db->where($column,$access);
      }
      $query=$this->db->get();

      if($query->num_rows()>0) {
        foreach ($query->result() as $row) {
          $data[]=$row;
        }
        return $data;
      }
    }

    // function read_todo($id='1') {
    //   $this->db->select('*');
    //   $this->db->from('todo');
    //   $this->db->where('id',$id);
    //   $query=$this->db->get()->result();
    //
    //   if($query) {
    //     return $query[0];
    //   }
    //   else {
    //     return null;
    //   }
    // }
    function r_object($table,$id='1',$access) {
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where('id',$id);
      if($access) {
        $this->db->where('idAccess',$access);
      }
      $query=$this->db->get()->result();

      if($query) {
        return $query[0];
      }
      else {
        return null;
      }
    }

    // U-UPDATE
    // function update_todo($id, $data) {
    //   $this->db->where('id',$id);
    //   $this->db->update('todo',$data);
    // }
    function u_object($table,$id,$data,$access) {
      $this->db->where('id',$id);
      if($access) {
        $this->db->where('idAccess',$access);
      }
      $this->db->update($table,$data);
    }

    // D-DELETE
    // function delete_todo($id) {
    //   $this->db->where('id',$id);
    //   $this->db->delete('todo');
    // }
    function d_object($table,$id,$access) {
      $this->db->where('id',$id);
      if($access) {
        $this->db->where('idAccess',$access);
      }
      $this->db->delete($table);
    }
  }

?>
