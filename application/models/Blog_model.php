<?php defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 个人博客管理
 */
class Blog_model extends CI_Model {

	/**********************************************************************************************
	 * 私有工具集
	 **********************************************************************************************/

	/**
	 * 添加记录
	 */
	public function register($form)
	{
		//config
		$members = array('Btitle', 'Bauthor','Btime');
		$members_article = array('Bid', 'BAarticle');

		//add time
		$form['Btime'] = date('Y-m-d H:i:s');

		//check token
		$this->load->model('User_model', 'user');
		$this->user->check_token($form['Utoken']);

		//get author
		$form['Bauthor'] = $this->db->select('Uusername')
			->where('Utoken', $form['Utoken'])
			->get('user')
			->result_array()[0]['Uusername'];

		//update
		$this->db->insert('blog',filter($form, $members));
		$form['Bid'] = $this->db->insert_id();
		$this->db->insert('blog_article', filter($form, $members_article));
	}
	

	/**
	 * 删除记录
	 */
	public function delete($form)
	{

		//check token
		$this->load->model('User_model', 'user');
		$this->user->check_token($form['Utoken']);

		//check editable
		$result = $this->db->select('Bauthor')
			->where('Bid', $form['Bid'])
			->get('blog')
			->result_array();
		if ( ! $result) 
		{
			throw new Exception('记录不存在');
		}
		$author = $result[0]['Bauthor'];
		$user = $this->db->select('Uusername')
			->where('Utoken', $form['Utoken'])
			->get('user')
			->result_array()[0]['Uusername'];

		if ($author != $user)
		{
			throw new Exception('只有作者可以删除记录', 402);
		}	

		//delete
		$where = array('Bid' => $form['Bid']);
		$this->db->delete('blog', $where);
		$this->db->delete('blog_article', $where);
	}
	
	
}