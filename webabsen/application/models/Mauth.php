<?php
class Mauth extends CI_Model
{
    protected $tabel = 'user';
    public function check_user($username)
    {
        return $this->db->get_where($this->tabel, ['email' => $username]);
    }
    public function check_pass($username, $password)
    {
        return $this->db->get_where($this->tabel, ['email' => $username, 'password' => md5($password)]);
    }
    public function validate($post)
    {
        $username = $post['username'];
        $password = $post['password'];
        return $this->db->get_where($this->tabel, ['email' => $username, 'password' => md5($password)])->row_array();
    }
}
