<?php 

class MY_Config extends CI_Config
{
    var $CI;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function item($item, $index = '')
    {
        $config = parent::item($item, $index);
        if($config === NULL)
        {
            if(class_exists('CI_Controller'))
            {
                 return $this->_database_config($item, $index);
            }
        } 
        return $config;
    }
    
    private function _database_config($item, $index = '')
    {
        $this->_load_database();
        
        if( $index != '')
        {
            $configs_data = $this->CI->db->get_where('configs', array(
                'item' => $item,
                'index' => $index))->result();    
        }else{
            $configs_data = $this->CI->db->get_where('configs', array(
                'item' => $item))->result();
        }        
        
        $configs = array();
        
        if(count($configs_data) > 0)
        {
            if($index == '' && count($configs_data) == 1)
            {
                return $configs_data[0]->value;
            }
            
            if($index == '' && count($configs_data) >= 1)
            {
                foreach($configs_data as $config)
                {
                    $configs[$config->index] = $configs->value;
                }
            }
            
            if($index != '' && count($configs_data) == 1)
            {
                return $configs_data[0]->value;
            }
        }else{
            return NULL;
        }
    }
    
    private function _load_database()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('config');
    }
}