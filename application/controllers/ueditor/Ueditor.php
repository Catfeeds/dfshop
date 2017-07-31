<?php
class ueditor extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct(); 
		$this->load->library('CI_Uploader'); 
		
	}
	
	public function iframe()
	{
		$de=check_ueditor_auth();
		if($de===false)
		{
			echo '请登陆';
			die;
		}
		
		$this->load->library('CI_Smarty');
		$this->ci_smarty->assign('width',$_GET['width']);		
		$this->ci_smarty->assign('height',$_GET['height']);	
		$this->ci_smarty->assign('title',htmlspecialchars($_GET['title']));	
		unset($_GET['width'],$_GET['height'],$_GET['title']);
		$_GET['s']='group_ed';
	
		$this->ci_smarty->assign('url',site_url('ueditor/iframe')."/?".url_convert($_GET));	
		$this->ci_smarty->display('iframe.htm');
	}
	
	public function upload_img()
	{	
	  
		$de=check_ueditor_auth();
		if($de===false)
		{
			echo '请登陆';
			die;
		}
		$error_msg='';
		if(!empty($_FILES))
		{
			$_GET['action']='uploadimage';
			$json=json_decode($this->init(1),true);
			if($json['url'])
				echo "<script>window.parent.close_Win('".$json['url']."')</script>";
			else
				$error_msg="<p>".$json['state']."</p>";
		}
		$this->load->library('CI_Smarty');
		$this->ci_smarty->assign('error_msg',$error_msg);
		
		if(!empty($_GET['up']))
		{
			
			//删除
			if(!empty($_GET['del_id']))
			{
				$this->load->model('Base_get_model');
				$url=$this->Base_get_model->get_row_field(tab_m('base_image'),'url',array(
							'id'=>$_GET['del_id']
							,'class_mothed'=>$de['mod']
							,'user_id'=>$de['userid']
						));
						
				if(!empty($url))
				{	
					$this->load->model('Base_update_model');	
					$this->Base_update_model->delete(tab_m('base_image'),array('id'=>$_GET['del_id']));		
					@unlink(APPPATH."../web".$url);
				}
			}
			
			if(!empty($_POST['vname']))
			{
				$this->load->model('Base_update_model');	
				$this->Base_update_model->update(tab_m('base_image'),array('upload_name'=>$_POST['vname']),array('id'=>$_POST['id'],'user_id'=>$de['userid']));		
				echo '修改成功';
				exit;
			}
			unset($_GET['del_id']);
			
			$wsql='';
			if(!empty($_POST['search_group'])&&$_POST['search_group']!='all')
			{
				$_POST['search_group']=$_POST['search_group']==-1?0:$_POST['search_group'];
				$wsql.=" and  group_id=".($_POST['search_group']*1);
			}
			
			if(!empty($_POST['search_name']))
			{
				$wsql.=" and  upload_name like '%".$_POST['search_name']."%'";
			}
			
			$this->load->library('CI_page');
			$this->ci_page->Page();
			$this->ci_page->url=site_url($this->class."/".$this->method);
			$this->ci_page->listRows=16;
			$sql="select upload_name,url,user_id,add_time,id   from  ".tab_m('base_image')
				 ."  where type=".($de['mod']=='admin'?1:0)
				 ."  and class_mothed='".$de['mod']."' "
			     ."  and user_id='".$de['userid']."' ".$wsql;
				 
			if(!$this->ci_page->__get('totalRows'))
			{
				$this->ci_page->totalRows =$this->db->query($sql)->num_rows;
			}
		
			$sql.=" order by id desc limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
			$res=array();
			$query=$this->db->query($sql);
			$res['list']=$query->result_array();
		
			$res['page']=$this->ci_page->prompt();	
			$this->ci_smarty->assign('re',$res,1,'page');
			
			$this->ci_smarty->assign('url',url_convert($_GET),0);
			
			$this->load->model('Base_get_model');
			$ress=$this->Base_get_model
				  ->get_list(tab_m('base_image_group')
							,'id,name'
							,array('web_filename'=>$de['mod']
								  ,'user_id'=>$de['userid'])
				            );
			$this->ci_smarty->assign('ress',$ress);
			
			$this->ci_smarty->assign('url_action',site_url('ueditor/iframe')."/?".url_convert($_GET),0);
			
			$this->ci_smarty->display_ini('upload_image_one.htm'); 
		}
		else
			$this->ci_smarty->display('upload_image.htm');   
	}
	
	//编辑组
	public function group_ed()
	{
		$de=check_ueditor_auth();
		if($de===false)
		{
			echo '请登陆';
			die;
		}
		
		$this->user_id=$de['userid'];
		$web_filename=$de['mod'];
		$this->load->library('CI_Smarty');
		$this->load->model('Base_update_model');
		$this->load->model('Base_get_model');
		if(!empty($_POST['new_group']))
		{
			$this->Base_update_model->insert(tab_m('base_image_group')
				,array(
					'web_filename'=>$web_filename,
					'name'=>$_POST['new_group'],
					'user_id'=>$this->user_id,
					'add_time'=>date('Y-m-d H:i:s')
				)
			);
			
			$this->ci_smarty->assign('msg_up',1);
		}
		
		if(!empty($_GET['del_id']))
		{
			$this->Base_update_model->delete(tab_m('base_image_group'),array('id'=>$_GET['del_id'],'web_filename'=>$web_filename,'userid'=>$this->user_id));
			$this->Base_update_model->update_sql("UPDATE ".tab_m('base_image')." SET  `group_id`='0'
										      WHERE  `group_id`='".$_GET['del_id']."' 
											  and user_id='".$this->user_id."'  and `class_mothed`='".$web_filename."'  ");  
											  
			$this->ci_smarty->assign('msg_up',1);								  
			unset($_GET['del_id']);
		}
			
		if(!empty($_POST['old_name'])&&is_array($_POST['old_name']))
		{
			foreach($_POST['old_name'] as $id=>$v)
			{
				$this->Base_update_model->update_sql("UPDATE ".tab_m('base_image_group')."  SET  name='".$v."'  where  user_id='"
				                                     .$this->user_id."' and id='".$id."' and  `web_filename`='".$web_filename."'  ");
			}
			$this->ci_smarty->assign('msg_up',1);
		}
		
		$res=$this->Base_get_model
				  ->get_list(tab_m('base_image_group')
							,'id,user_id,web_filename,name'
							,array('web_filename'=>$web_filename
								  ,'user_id'=>$this->user_id)
				            );
				  
		$this->ci_smarty->assign('res',$res);
		
		$_GET['s']='group_ed';
		$this->ci_smarty->assign('url',site_url('ueditor/iframe')."/?".url_convert($_GET),0);
		$this->ci_smarty->display_ini('upload_group_ed.htm');   
	}
  
    public function init($type='')
	{
		$de=check_ueditor_auth();
		if($de===false)
		{
			echo json_encode(array(
					'state'=> '请登陆'
				));
			die;
		}
	    require(APPPATH.'/config/config.php');
		//header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
		//header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header
		//error_reporting(E_ERROR);
		//header("Content-Type: text/html; charset=utf-8");
		
		$str=preg_replace("/\/\*[\s\S]+?\*\//","", file_get_contents(config_item('base_url')."/config.json"));
		$CONFIG = json_decode($str, true);
		
		/* {filename} 会替换成原文件名,配置这项需要注意中文乱码问题 */
	    /* {rand:6} 会替换成随机数,后面的数字是随机数的位数 */
	    /* {time} 会替换成时间戳 */
	    /* {yyyy} 会替换成四位年份 */
	    /* {yy} 会替换成两位年份 */
	    /* {mm} 会替换成两位月份 */
	    /* {dd} 会替换成两位日期 */
	    /* {hh} 会替换成两位小时 */
	    /* {ii} 会替换成两位分钟 */
	    /* {ss} 会替换成两位秒 */	 
		$wurl=config_item('base_url_www');//http://www.test-zjh_product.com
		$CONFIG['imageUrlPrefix']=$wurl;//图片前缀
		$CONFIG['scrawlUrlPrefix']=$wurl;//涂鸦前缀
		$CONFIG['snapscreenUrlPrefix']=$wurl;//截屏前缀
		$CONFIG['catcherUrlPrefix']=$wurl;
		$CONFIG['videoUrlPrefix']=$wurl;//视频前缀
		$CONFIG['fileUrlPrefix']=$wurl;//文件前缀
		$CONFIG['imageManagerUrlPrefix']=$wurl;//图片管理前缀
	    $CONFIG['fileManagerUrlPrefix']=$wurl;//文件管理前缀
		$CONFIG["imagePathFormat"]="/upload/".$de['mod']."/".$de['userid']."/image/{yyyy}{mm}{dd}/{time}{rand:6}";/* 上传保存路径,可以自定义保存路径和文件名格*/
		$CONFIG["scrawlPathFormat"]="/upload/".$de['mod']."/".$de['userid']."/image/{yyyy}{mm}{dd}/{time}{rand:6}";
		/* 上传保存路径,可以自定义保存路径和文件名格式 */
		$CONFIG["snapscreenPathFormat"]="/upload/".$de['mod']."/".$de['userid']."/image/{yyyy}{mm}{dd}/{time}{rand:6}"; 
		/* 上传保存路径,可以自定义保存路径和文件名格式 */
		$CONFIG["catcherPathFormat"]="/upload/".$de['mod']."/".$de['userid']."/image/{yyyy}{mm}{dd}/{time}{rand:6}"; 
		/* 上传保存路径,可以自定义保存路径和文件名格式 */
		$CONFIG["videoPathFormat"]="/upload/".$de['mod']."/".$de['userid']."/video/{yyyy}{mm}{dd}/{time}{rand:6}";
		/* 上传保存路径,可以自定义保存路径和文件名格式 */
		$CONFIG["filePathFormat"]="/upload/".$de['mod']."/".$de['userid']."/file/{yyyy}{mm}{dd}/{time}{rand:6}"; /* 上传保存路径,可以自定义保存路径和文件名格式 */
		$CONFIG["imageManagerListPath"]="/upload/".$de['mod']."/".$de['userid']."/image/"; /* 指定要列出图片的目录 */
		$CONFIG["fileManagerListPath"]="/upload/".$de['mod']."/".$de['userid']."/file/"; /* 指定要列出文件的目录 */
		$action =$_GET['action'];
		switch ($action) {
			case 'config':
				 $result =  json_encode($CONFIG);
				 break;
			/* 上传文件 */
			case 'uploadfile':;
				 $result ='{}';break;
			/* 上传视频 */
			case 'uploadvideo':
			     $result ='{}';break;
			/* 上传涂鸦 */
			case 'uploadscrawl':;	 
			/* 上传图片 */
			case 'uploadimage':
			{
				//$result = include("action_upload.php");
				$result = $this->uploadfile($CONFIG);
				/*
				stdClass::__set_state(array(
				   'state' =&gt; 'SUCCESS',
				   'url' =&gt; '/upload/sp/3/image/20161219/1482118094110733.jpg',
				   'title' =&gt; '1482118094110733.jpg',
				   'original' =&gt; '19.jpg',
				   'type' =&gt; '.jpg',
				   'size' =&gt; 160371,
				))	
				*/
				$dd=json_decode($result,true);		
				if($dd['state']=='SUCCESS')
				{
					$this->load->model('Base_image_model');
					$arr=array(
								 'type'=>($de['mod']=='admin'?1:0),
								 'class_mothed'=>$de['mod'],
								 'url'=>$dd['url'],
								 'group_id'=>(!empty($_POST['group'])?$_POST['group']*1:0),
								 'width'=>$dd['width']*1,
								 'height'=>$dd['height']*1,
								 'upload_name'=>$dd['original'],
								 'user_id'=>$de['userid'],
								 'size'=>$dd['size'], 
								 'add_time'=>date('Y-m-d  H:i:s'),
								 'status'=>1
					          );
					$this->Base_image_model->insert_image($arr);
				}
				break;
			}	
		
			/* 列出图片 */
			case 'listimage':
			     //$result ='';
			    $result =$this->action_list($CONFIG); //$result ='{}';//
				//$result = include("action_list.php");
				break;
			/* 列出文件 */
			case 'listfile':
			    $result =$this->action_list($CONFIG);//'{}';//
				//$result = include("action_list.php");
				break;
			/* 抓取远程文件 */
			case 'catchimage':
				//$result = include("action_crawler.php");
				$result =$this->action_crawler($CONFIG);
				break;
			default:
				$result = json_encode(array(
					'state'=> '请求地址出错'
				));
				break;
		}

		/* 输出结果 */
		if (isset($_GET["callback"])) {
			if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
				echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
			} else {
				echo json_encode(array(
					'state'=> 'callback参数不合法'
				));
			}
		}
		else
		{
			if($type==1)
				return $result;
			else
				echo $result;
		}
	}
	
	//上传图片
	private function uploadfile($CONFIG)
	{
		/* 上传配置 */
		$base64 = "upload";
		switch (htmlspecialchars($_GET['action'])) {
			case 'uploadimage':
				$config = array(
					"pathFormat" => $CONFIG['imagePathFormat'],
					"maxSize" => $CONFIG['imageMaxSize'],
					"allowFiles" => $CONFIG['imageAllowFiles']
				);
				$fieldName = $CONFIG['imageFieldName'];
				break;
			case 'uploadscrawl':
				$config = array(
					"pathFormat" => $CONFIG['scrawlPathFormat'],
					"maxSize" => $CONFIG['scrawlMaxSize'],
					"allowFiles" => $CONFIG['scrawlAllowFiles'],
					"oriName" => "scrawl.png"
				);
				$fieldName = $CONFIG['scrawlFieldName'];
				$base64 = "base64";
				break;
			case 'uploadvideo':
				$config = array(
					"pathFormat" => $CONFIG['videoPathFormat'],
					"maxSize" => $CONFIG['videoMaxSize'],
					"allowFiles" => $CONFIG['videoAllowFiles']
				);
				$fieldName = $CONFIG['videoFieldName'];
				break;
			case 'uploadfile':
			default:
				$config = array(
					"pathFormat" => $CONFIG['filePathFormat'],
					"maxSize" => $CONFIG['fileMaxSize'],
					"allowFiles" => $CONFIG['fileAllowFiles']
				);
				$fieldName = $CONFIG['fileFieldName'];
				break;
		}
		/* 生成上传实例对象并完成上传 */
		$up =$this->ci_uploader->get_object($fieldName, $config, $base64);
		/**
		 * 得到上传文件所对应的各个参数,数组结构
		 * array(
		 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
		 *     "url" => "",            //返回的地址
		 *     "title" => "",          //新文件名
		 *     "original" => "",       //原始文件名
		 *     "type" => ""            //文件类型
		 *     "size" => "",           //文件大小
		 * )
		 */
		
		/* 返回数据 */
		return json_encode($up->getFileInfo());
	}
	
	private function action_list($CONFIG)
	{
		/* 判断类型 */
		switch ($_GET['action']) {
			/* 列出文件 */
			case 'listfile':
				$allowFiles = $CONFIG['fileManagerAllowFiles'];
				$listSize = $CONFIG['fileManagerListSize'];
				$path = $CONFIG['fileManagerListPath'];
				break;
			/* 列出图片 */
			case 'listimage':
			default:
				$allowFiles = $CONFIG['imageManagerAllowFiles'];
				$listSize = $CONFIG['imageManagerListSize'];
				$path = $CONFIG['imageManagerListPath'];
		}
		$allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);
		
		/* 获取参数 */
		$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
		$start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
		$end = $start + $size;
		
		/* 获取文件列表 */
		$path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "":"/") . $path;
		$files = $this->getfiles($path, $allowFiles);
		if (!count($files)) {
			return json_encode(array(
				"state" => "no match file",
				"list" => array(),
				"start" => $start,
				"total" => count($files)
			));
		}
		
		/* 获取指定范围的列表 */
		$len = count($files);
		for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
			$list[] = $files[$i];
		}
		//倒序
		//for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
		//    $list[] = $files[$i];
		//}
		
		/* 返回数据 */
		$result = json_encode(array(
			"state" => "SUCCESS",
			"list" => $list,
			"start" => $start,
			"total" => count($files)
		));
		return $result;
	}
	/**
		 * 遍历获取目录下的指定类型的文件
		 * @param $path
		 * @param array $files
		 * @return array
		 */
	private function getfiles($path, $allowFiles, &$files = array())
	{
		if (!is_dir($path)) 
			return null;
		if(substr($path, strlen($path) - 1) != '/') $path .= '/';
		$handle = opendir($path);
		while (false !== ($file = readdir($handle))) {
			if ($file != '.' && $file != '..') {
				$path2 = $path . $file;
				if (is_dir($path2)) {
					$this->getfiles($path2, $allowFiles, $files);
				} else {
					if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
						$files[] = array(
							'url'=> substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
							'mtime'=> filemtime($path2)
						);
					}
				}
			}
		}
		return $files;
	}
	
	private function action_crawler($CONFIG)
	{
		/* 上传配置 */
		$config = array(
			"pathFormat" => $CONFIG['catcherPathFormat'],
			"maxSize" => $CONFIG['catcherMaxSize'],
			"allowFiles" => $CONFIG['catcherAllowFiles'],
			"oriName" => "remote.png"
		);
		$fieldName = $CONFIG['catcherFieldName'];
		
		/* 抓取远程图片 */
		$list = array();
		if (isset($_POST[$fieldName])) {
			$source = $_POST[$fieldName];
		} else {
			$source = $_GET[$fieldName];
		}
		foreach ($source as $imgUrl) {
			$item = $this->ci_uploader->get_object($imgUrl, $config, "remote");
			$info = $item->getFileInfo();
			array_push($list, array(
				"state" => $info["state"],
				"url" => $info["url"],
				"size" => $info["size"],
				"height" => $info["height"],
				"width" => $info["width"],
				"title" => htmlspecialchars($info["title"]),
				"original" => htmlspecialchars($info["original"]),
				"source" => htmlspecialchars($imgUrl)
			));
		}
		
		/* 返回抓取数据 */
		return json_encode(array(
			'state'=> count($list) ? 'SUCCESS':'ERROR',
			'list'=> $list
		));
	}
	
}