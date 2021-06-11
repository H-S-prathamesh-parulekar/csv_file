<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Model
{

    function __construct()
    {
        // Set table name
        $this->table = 'song_data';
        $databse="jukebox";
    }

    /*
     * Fetch members data from the database
     * @param array filter data based on the passed parameters
     */



    public function createDB($databse)
    {
        $strSQL = "CREATE DATABASE IF NOT EXISTS $databse";
        $query = $this->db->query($strSQL);
        if (!$query) {
            throw new Exception(
                $this->db->_error_message(),
                $this->db->_error_number()
            );
           // echo  "1";
            return FALSE;
        } else {
         //   echo  "2";
            return TRUE;
        }
    }

    public function createTable($table)
    {   
        $strSQL = "CREATE TABLE IF NOT EXISTS `jukebox`.`song_data` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL , `Artist` VARCHAR(255) NULL , `Duration` TIME NULL , PRIMARY KEY (`id`))";
        $query = $this->db->query($strSQL);
        if (!$query) {
            throw new Exception(
                $this->db->_error_message(),
                $this->db->_error_number()
            );
            // echo  "1";
            return FALSE;
        } else {
            //   echo  "2";
            return TRUE;
        }
    }
    function getRows($params = array())
    {
        $this->createDB('Jukebox');
        $this->createTable('Jukebox');
     
        $this->db->select('*');
        $this->db->from($this->table);

        if (array_key_exists("where", $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists("id", $params)) {
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('Duration', 'asc');
                $this->db->group_by('Artist');
                $this->db->group_by('id');
            
             
                if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }
       // var_dump($result);exit;
        // Return fetched data
        return $result;
    }

    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array())
    {
        if (!empty($data)) {
         

            // Insert member data
            $insert = $this->db->insert($this->table, $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }

    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update($data, $condition = array())
    {
        if (!empty($data)) {
            // Add modified date if not included
            if (!array_key_exists("modified", $data)) {
                $data['modified'] = date("Y-m-d H:i:s");
            }

            // Update member data
            $update = $this->db->update($this->table, $data, $condition);

            // Return the status
            return $update ? true : false;
        }
        return false;
    }
}
