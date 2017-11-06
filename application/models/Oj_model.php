<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Oj_model extends CI_Model {

	/*****************************************************************************************************
	 * 工具集
	 *****************************************************************************************************/


	/**********************************************************************************************
	 * 主接口
	 **********************************************************************************************/


	/**
	 * 添加hdu账号
	 */
	public function add_hdu_account($form)	
	{
		//config
		$members = array('Uusername', 'OJname', 'OJusername', 'OJpassword');

		
		//check token
		$this->load->model('User_model','my_user');
		if (isset($form['Utoken'])) 
		{
			$this->my_user->check_token($form['Utoken']);
		}

		//check OJusername
		$where = array('OJname' => $form['OJname'],'OJusername' => $form['OJusername']);
		if ( $result = $this->db->select('OJusername')
			->where($where)
			->get('oj_account')
			->result_array())
		{
			throw new Exception("账户已被关联");
		}
		
		//check OJ
		$where = array('OJname' => $form['OJname'],'Uusername' => $form['Uusername']);
		if ( $result = $this->db->select('Uusername')
			->where($where)
			->get('oj_account')
			->result_array())
		{
			throw new Exception("已关联hdu账号");
		}

		//check hdu username and password
		$url ='http://acm.hdu.edu.cn/status.php';
		$ch1 = curl_init();
		$cookie_file = dirname(__FILE__).'/cookie.txt';
		curl_setopt($ch1, CURLOPT_URL, $url);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_COOKIEJAR, $cookie_file);
		if (curl_exec($ch1))
		{
			$content = curl_multi_getcontent($ch1);
		}
		else
		{
			throw new Exception('网页爬取失败',401);
		}
		curl_close($ch1);

		$url = 'http://acm.hdu.edu.cn/userloginex.php?action=login';
		$post_data = array
						(
							'username' => $form['OJusername'],
							'userpass' => $form['OJpassword'],
							'login' => 'Sign In',
						);
		$post_data = http_build_query($post_data);
		$ch2 = curl_init();
		curl_setopt($ch2, CURLOPT_URL, $url);
		curl_setopt($ch2, CURLOPT_POST, 1);
		curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch2, CURLOPT_COOKIEFILE, $cookie_file);
		curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
		if (curl_exec($ch2))
		{
			$content = curl_multi_getcontent($ch2);
		}
		else
		{
			throw new Exception('关联账户用户名或密码错误',401);
		}
		curl_close($ch2);
		unlink($cookie_file);

		$re = "/".$form['OJusername']."/";
		if ( ! preg_match($re,$content,$match))
		{
			throw new Exception("关联账户用户名或密码错误");
		}

		$this->db->insert('oj_account',filter($form,$members));
	}

	//添加foj账号
	public function add_foj_account($form)	
	{
		//config
		$members = array('Uusername', 'OJname', 'OJusername', 'OJpassword');

		
		//check token
		$this->load->model('User_model','my_user');
		if (isset($form['Utoken'])) 
		{
			$this->my_user->check_token($form['Utoken']);
		}

		//check OJusername
		$where = array('OJname' => $form['OJname'],'OJusername' => $form['OJusername']);
		if ( $result = $this->db->select('OJusername')
			->where($where)
			->get('oj_account')
			->result_array())
		{
			throw new Exception("账户已被关联");
		}
		
		//check OJ
		$where = array('OJname' => $form['OJname'],'Uusername' => $form['Uusername']);
		if ( $result = $this->db->select('Uusername')
			->where($where)
			->get('oj_account')
			->result_array())
		{
			throw new Exception("已关联foj账号");
		}

		$this->db->insert('oj_account',filter($form,$members));
	}
	//添加cf账号
	public function add_cf_account($form)
	{
		//config
		$members = array('Uusername', 'OJname', 'OJusername', 'OJpassword');

		
		//check token
		$this->load->model('User_model','my_user');
		if (isset($form['Utoken'])) 
		{
			$this->my_user->check_token($form['Utoken']);
		}

		//check OJusername
		$where = array('OJname' => $form['OJname'],'OJusername' => $form['OJusername']);
		if ( $result = $this->db->select('OJusername')
			->where($where)
			->get('oj_account')
			->result_array())
		{
			throw new Exception("账户已被关联");
		}
		
		//check OJ
		$where = array('OJname' => $form['OJname'],'Uusername' => $form['Uusername']);
		if ( $result = $this->db->select('Uusername')
			->where($where)
			->get('oj_account')
			->result_array())
		{
			throw new Exception("已关联cf账号");
		}

		//check hdu username and password
		//获取网页链接
		$url ='http://codeforces.com/enter?back=%2Fproblemset%2Fstandings';

		//爬取网页
		
		//get csrf_token以及cookie
		$ch1 = curl_init();
		$cookie_file = dirname(__FILE__).'/cookie.txt';
		curl_setopt($ch1, CURLOPT_URL, $url);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_COOKIEJAR, $cookie_file);
		if (curl_exec($ch1))
		{
			$text = curl_multi_getcontent($ch1);
		}
		else
		{
			throw new Exception('网页爬取失败',401);
		}
		curl_close($ch1);

		//正则匹配获取csrf_token
		$re = "/<meta name=\"X-Csrf-Token\" content=\"(\w*)\"\/>/";
		if (preg_match($re,$text,$match)){
			$token = $match[1];
		}
		else
		{
			throw new Exception("内容爬取失败",401);
		}
			
	
		//模拟登录
		$post_data = array
			(
				'csrf_token' => $token,
				'action' => 'enter',
				'handle' => $form['OJusername'],
				'password' => $form['OJpassword']
			);
		$post_data = http_build_query($post_data);
		$ch2 = curl_init();
		curl_setopt($ch2, CURLOPT_URL, $url);
		curl_setopt($ch2, CURLOPT_POST, 1);
		curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch2, CURLOPT_COOKIEFILE, $cookie_file);
		curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
		if (curl_exec($ch2))
		{
			$text = curl_multi_getcontent($ch2);
		}
		else
		{
			throw new Exception('关联账户用户名或密码错误',401);
		}
		curl_close($ch2);
		unlink($cookie_file);

		//正则匹配获取判断是否登录成功
		$re = "/".$form["OJusername"]."/i";
		if (! preg_match($re,$text,$match))
		{
			throw new Exception("关联账户用户名或密码错误",401);
		}		

		$this->db->insert('oj_account',filter($form,$members));
	}
}