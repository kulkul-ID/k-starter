<?php

class Kulkul_auth
{
    private $CI;
    private $DB;
    private $auth_value;
    private $table;
    private $fields;
    private $en_fields;
    private $en_key;
    private $session_name = 'k_session';

    public function __construct()
    {
        $this->CI = &get_instance();

        /* load the library*/
        $this->CI->load->database();
        $this->DB = $this->CI->db;

        $this->CI->load->library(array(
            'encrypt',
            'session'
        ));

        /* init */
        $this->init();
    }

    /**
    * Init the configuration
    * Configuration set on APPPATH/config/kulkul_auth.php
    */
    public function init()
    {
        include APPPATH.'/config/kulkul_auth.php';

        $config =&get_config();

        $this->set_table($auth['table']);

        $this->set_fields($auth['fields']);

        $this->set_encryption_fields($auth['encryption_fields']);

        if($auth['encryption_key'] == '') $config['encryption_key'];
        $this->set_encryption_key($auth['encryption_key']);

        if($this->CI->session->userdata('k_session'))
            $this->auth_value = $this->CI->session->userdata('k_session');

        $this->restart();
    }

    /**
    * Start the authentication
    **/
    public function start()
    {
        /* get the auth value */
        $where = $this->auth_value;
        $where_en = array();
        $valid_en_fields = TRUE;

        /* remove encypt value */
        foreach($this->en_fields as $en_fields)
        {
            $where_en[$en_fields] = $where[$en_fields];
            unset($where[$en_fields]);
        }

        /* get the user */
        $user = $this->_get_data($where);

        /* if no user */
        if(count((array) $user) == '') return FALSE;

        /* match the encrypt value */
        foreach($this->en_fields as $en_fields)
        {
            $valid_en_fields = $valid_en_fields
                && $this->CI->encrypt->decode($user->{$en_fields}) == $where_en[$en_fields];
        }

        /* if all encrypt values are valid */
        if($valid_en_fields === TRUE)
        {
            $this->CI->session->set_userdata($this->session_name, (array) $user);
            return TRUE;
        }

        /* if the're not */
        $this->CI->session->unset_userdata($this->session_name);
        return FALSE;
    }

    /**
    * reauth
    **/
    public function restart()
    {
        /* check if there is authentication before */
        if( $this->auth_value != '' &&
            $this->auth_value != NULL &&
            $this->auth_value != FALSE )
        {
            $valid_fields = TRUE;

            $where = array();

            foreach ( $this->fields as $k => $field ) {
                $where[$k] = $this->auth_value[$field];
            }

            /* get user */
            $user = $this->_get_data($where);

            /* if no user */
            if(count((array) $user) == '') return FALSE;

            /* match */
            foreach($this->fields as $field)
            {
                $valid_fields = $valid_fields == ($this->auth_value[$field] == $user->{$field});
            }

            if($valid_fields == TRUE) return TRUE;
        }

        /* no auth */
        $this->CI->session->unset_userdata($this->session_name);
        return FALSE;
    }

    /**
     * Destroy the session
     **/
    public function shutdown()
    {
        $this->CI->session->unset_userdata($this->session_name);
        return true;
    }

    /**
     * get active user
     **/
    public function user()
    {
        return $this->auth_value;
    }

    /**
    * Set authentication value
    * @param array the value e.g
    *   array('username' => 'admin', 'password' => 'admin')
    **/
    public function set_value($value)
    {
        $this->auth_value = $value;
        $this->CI->session->set_userdata($this->session_name, $this->auth_value);
    }

    public function set_table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function set_fields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function set_encryption_fields($fields)
    {
        $this->en_fields = $fields;
        return $this;
    }

    public function set_encryption_key($key)
    {
        $this->en_key = $key;
        return $this;
    }

    private function _get_data($where)
    {
        return $this->DB->get_where($this->table, $where)
            ->row();
    }
}
