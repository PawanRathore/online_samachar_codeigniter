<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

/************************************************************************************
* This is the Master Model for project, it contain all function related to Add,update,delete,fetch.*
*************************************************************************************/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Master_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    #########################################################
    #            Functions For Master Model #
    #########################################################    
    function getRow($table, $data)
    {
        $status = $this->db->get_where($table, $data)->first_row();
        if($status){
            return get_object_vars($status);
        }
        return false;
        
    }
    function listAll($table,$order_by="id",$order_type="DESC",$group_by='')
    {
		if($group_by){
			$this->db->group_by($group_by); 
		}
		$this->db->order_by($order_by,$order_type);
		$rest = $this->db->get($table);
		return $rest->result_array();
    }
    function listAllWhere($table,$where,$order_by="id",$order_type="DESC",$group_by='')
    {
		if($group_by){
			$this->db->group_by($group_by); 
		}
        $this->db->order_by($order_by,$order_type);
        $rest = $this->db->get_where($table, $where);
        return $rest->result_array();
    }

    function save($table, $data){  

        // foreach($data as $key=> $data_item){
        //     $data_item =  mysqli_real_escape_string($this->db->conn_id, $data_item);
        //     $data_item =  trim($data_item);
        //     $data[$key] =  strip_tags($data_item);
        // }  
    
    
        if (isset($data['id']) && $data['id'] > 0) {
            $this->db->update($table, $data, array(
                'id' => $data['id']
            ));
			//echo $this->db->last_query();
            //$this->db->close(); 
            return $data['id'];
        } else {
			if($data){
				$this->db->reconnect();
                $insert_status  = $this->db->insert($table, $data);
                
                //echo $this->db->last_query();
               // echo $this->db->_error_message();
              //  exit();
                return $this->db->insert_id();	  
			}
        }
    }

	function save1($table, $data)
    {
        // foreach($data as $key=> $data_item){            
        //     $data_item =  mysqli_real_escape_string($this->db->conn_id, $data_item);
        //     $data_item =  trim($data_item);
        //     $data[$key] =  strip_tags($data_item);
        // }

        if (isset($data['company_id']) && $data['company_id'] > 0) {
            $this->db->reconnect();
            $this->db->update($table, $data, array(
                'company_id' => $data['company_id']
            ));
            return $data['company_id'];
        } else {
            $this->db->reconnect();
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }
	
	function query($sql){ 
		$this->db->query($sql);
		return  $id = $this->db->affected_rows();
        //$this->db->close();
	}
	
    function delete($id, $table)
    {
        $this->db->delete($table, array(
            'id' => $id
        ));
        //$this->db->close();
    }
	
	function customQueryRow($sql,$delete=''){
        $this->db->reconnect();
		$query = $this->db->query($sql);
		if(!$delete){
			$row = $query->row();
			return get_object_vars($row);
		}
        //$this->db->close();
	}
	
    function customQueryArray($sql){
        $this->db->reconnect();
		$query = $this->db->query($sql);
        $array = $query->result_array();
        //$this->db->close();
		return $array;
	}
	
	function countRow($sql)
	{
        $this->db->reconnect();
		$query = $this->db->query($sql);
        return $query->num_rows();
	}
	
}