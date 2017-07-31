<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Country_model extends CI_Model
{
	//产地管理列表
	public function country_list($page_num,$page,$search_array)
	{
		return $this->db->select('id,c_name,c_enname,c_display')
						->like($search_array)
						->limit($page_num,$page)
						->from(tab_m('country'))
						->get()
						->result_array();
	}
	
	//产地管理列表总共行数
	public function country_totalRows($search_array)
	{
		return $this->db->like($search_array)
						->from(tab_m('country'))
						->count_all_results();
	}
	
    //开启的产地
	public function get_show_country($c_display=0)
	{
		return $this->db->select('id,c_name')
					->where('c_display',$c_display)
					->from(tab_m('country'))
					->get()
					->result_array();		
	}
	
	//修改产地状态
	public function update_country_display($country_arr)
	{
		return $this->db->update_batch(tab_m('country'), $country_arr,'id');
	}
	
	public function get_addrtcode($ReceiveAreaName)
	{
		$addr=explode(',',$ReceiveAreaName);
		if(count($addr)<3)
			return '收货省市区错误:省 市 区 地区不能为空[>>'.$ReceiveAreaName;
			
		$city=substr($addr[0],0,6);
		$this->db->query("select  id  from  ".tab_m('country')."  where pid=0  and  name like '$city%' limit 1");
		$cid=$this->db->fetchField('id')*1;  //省ID
		$ids=substr($cid,0,2);
		$ReceiveAreaCode=1;
		if($ids)
		{  
			$code=array('北京'=>'110100','天津'=>'120100','重庆'=>'500100','上海'=>'310100');
			$ReceiveAreaCode=$code[$city];
			if(empty($ReceiveAreaCode))	
			{	 
				$area=substr($addr[1],0,9);
				if($area)
				{
					$sql="select  pid,id  from  ".tab_m('country')."  where id like '$ids%' and  
						  name like '$area%' order by id asc limit 1     ";
					$this->db->query($sql);
					$are=$this->db->fetchRow();  //市 区ID
					$ReceiveAreaCode=$are['id'];
					//----------------如果第二级不存在-------
					if(empty($ReceiveAreaCode))	
					{
						$area=substr($addr[2],0,9);
						$sql="select  pid,id,name  from  ".tab_m('country')."  where id like '$ids%' and  
									  name like '$area%' and pid!=0 order by id desc";
						$this->db->query($sql);
						$res=$this->db->getRows();  //市 区ID
						if(empty($res))
							return '收货地址省市区不匹配 [原地址>>'.$ReceiveAreaName;	
						if(empty($res[1]))
						{
							$pid=$res[0]['pid'];
							$this->db->query("select  name  from  
								         ".tab_m('country')."  where id='$pid' order by id desc limit 1");
							$name=$this->db->fetchField('name');		
							return '[收货地址不存在]：推荐地址:'.$addr[0].',【'.$name.'】,'.$addr[2]." [原地址 >>".$ReceiveAreaName;		 
						}
						else
						{
							$name='';
							foreach($res as $v)
							{
								$this->db->query("select  name  from  
											 ".tab_m('country')."  where id='$v[pid]'  and pid!=0 order by id desc limit 1");
								$sname=$this->db->fetchField('name');	
								if($sname)		 
									$name.=($name?" 或 ":'').$sname;					 
							}
							return '[收货地址不存在]：推荐地址:'.$addr[0].',【'.$name.'】,'.$addr[2]." [原地址 >>".$ReceiveAreaName;		 
						}
					}
					else
					{
						if(empty($are['pid']))
							return '收货地址第二级错误:'.$ReceiveAreaName;
						else
						{
							//地级市级市
							if(substr($ReceiveAreaCode,4,2)!='00')
							{
								$this->db->query("select  pid,id,name  from  
											".tab_m('country')."  where id='$are[pid]' order by id desc ");
								$are=$this->db->fetchRow();  //市 区ID 
								$addr[0]=$addr[0];
								$addr[6]=$addr[5];
								$addr[5]=$addr[4];
								$addr[4]=$addr[3];
								$addr[3]=$addr[2];
								$addr[2]=$addr[1];
								$addr[1]=$are['name'];
								if($addr[2]==$addr[3])
									unset($addr[3]);
								$ReceiveAreaCode=$are['id'];
							}
						}
					}
				}
				if(substr($ReceiveAreaCode,4,2)!='00')
					return '收货地址第二级错误:'.$ReceiveAreaName;
			}
			else
			{
				$city1=substr($addr[1],0,6);
				if($city!=$city1)
				{
					$addr[0]=$addr[0];
					$addr[6]=$addr[5];
					$addr[5]=$addr[4];
					$addr[4]=$addr[3];
					$addr[3]=$addr[2];
					$addr[2]=$addr[1];
					$addr[1]=$city."市";
				}
			}
		}
		else
			return '地区省份错误 [原地址>>'.$ReceiveAreaName;
			
		return array(array($cid,$ReceiveAreaCode,0),$addr);
	}
}