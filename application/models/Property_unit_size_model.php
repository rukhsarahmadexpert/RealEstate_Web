<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Property_unit_size_model extends CI_Model
{
    function property_unit_sizeListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.property_unit_size_id, BaseTbl.property_unit_size_name, BaseTbl.property_unit_size_created_at, BaseTbl.property_unit_size_updated_at');
        $this->db->from('tbl_property_unit_size as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.property_unit_size_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    function property_unit_sizeListing($searchText = '', $page, $segment)
    {
         $this->db->select('BaseTbl.property_unit_size_id, BaseTbl.property_unit_size_name, BaseTbl.property_unit_size_created_at, BaseTbl.property_unit_size_updated_at');
        $this->db->from('tbl_property_unit_size as BaseTbl');
        //$this->db->join('tbl_services as s', 's.service_id = BaseTbl.service_id','left');
        if(!empty($searchText)) {
           $likeCriteria = "(BaseTbl.property_unit_size_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.property_unit_size_id', 'DESC');
        $this->db->limit($page, $segment);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function add_new_property_unit_size($servicesInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_property_unit_size', $servicesInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    
    function get_property_unit_size_info($id)
    {
         $this->db->select('BaseTbl.property_unit_size_id, BaseTbl.property_unit_size_name, BaseTbl.property_unit_size_created_at, BaseTbl.property_unit_size_updated_at');
        //$this->db->select('sub_service_id, service_id, sub_service_name');
        $this->db->from('tbl_property_unit_size as BaseTbl');
        $this->db->where('property_unit_size_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_all_services()
    {
        $this->db->select('service_id, service_name, created_at, updated_at');
        $this->db->from('tbl_services');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function edit_property_unit_size($val)
    {
        $this->db->set('property_unit_size_name',$val['property_unit_size_name']);
        $this->db->set('property_unit_size_updated_at',date('Y-m-d H:i:s'));
        $this->db->where('property_unit_size_id', $val['property_unit_size_id']);
        $this->db->update('tbl_property_unit_size');
        return TRUE;
    }
    
    function delete_property_unit_size($id)
    {
        $this->db->set('isDeleted',1);
        $this->db->where('property_unit_size_id', $id);
        $this->db->update('tbl_property_unit_size');
        return $this->db->affected_rows();
    }

    function getservicesInfoById($servicesId)
    {
        $this->db->select('servicesId, name, email, mobile, roleId');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('tbl_property_unit_size', $servicesId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getservicesInfoWithRole($servicesId)
    {
        $this->db->select('BaseTbl.servicesId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_services as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.servicesId', $servicesId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  