<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->get_admin_name(); 
	}
	

	/**
	 * 添加商品/编辑商品/商品下架/商品加入回收站
	 */
	public function product_add()
	{
		if(isset($_GET['act']))
		{
			if($_GET['act']=='del_gg')
			{
				$this->del_gg();
				return ;
			}

			if($_GET['act']=='select_product')
			{
				$this->select_product();
				return ;
			}

			if($_GET['act']=='get_gg_html')
			{
				$this->get_gg_html();
				return ;
			}

			if($_GET['act']=='product_delete')
			{
				//商品加入回收站
				if($_GET['id'])
				{
					$type='single';
					$item=$_GET['id'];
				}
				elseif($_GET['item'])
				{
					$type='batch';
					$item=$_GET['item'];
				}
				$this->product_delete($type,$item,$_GET['type']);
				return ;
			}

			if($_GET['act']=='product_shelves')
			{//商品下架
				if($_GET['id'])
				{
					$type='single';
					$item=$_GET['id'];
				}
				elseif($_GET['item'])
				{
					$type='batch';
					$item=$_GET['item'];
				}
				$this->product_shelves($type,$item,$_GET['type']);
				return ;
			}

			if($_GET['act']=='product_detail_edit')
			{//编辑商品详情操作
				//model
				$this->load->model('Base_Product_model');
				if($_GET['id'])
				{
					$res=$this->Base_Product_model->get_product_con_row(array('product_id'=>$_GET['id']));
					$this->ci_smarty->assign('re',$res);
					$this->ci_smarty->display_ini('product_detail_edit.htm');
					die;
				}
				elseif ($_POST['id'])
				{
					$this->load->library('MY_form_validation');
					$this->form_validation->set_rules('con','商品详情','required');
					if ($this->form_validation->run() == FALSE)
					{
						$msg = array(
							'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
					else
					{
						$product_arr['con']=$this->input->post('con',true);
						$res=$this->Base_Product_model->update_product_con($product_arr,array('id'=>$_POST['id']));
						if( $res )
						{
							$msg = array(
								'msg'  => '操作成功',
								'type' => 2,
							);
							echo json_encode($msg);
							die;
						}
						else
						{
							$msg = array(
								'msg'  => '操作失败',
								'type' => 1
							);
							echo json_encode($msg);
							die;
						}
					}
				}
			}
		}
		//修改和添加
		if(!empty($_POST))
			$this->edit_product();

		$page_htm="product_add.htm";
		//新增商品
		if (isset($_GET['index']) && $_GET['index'] == 1 ||!empty($_GET['id']))
		{
			if(!empty($_GET['id']))
			{
				//查询商品信息
				$this->load->model('Base_Product_model');
				$res=$this->Base_Product_model->get_row(array('id'=>$_GET['id']));
				$gg_con=$this->Base_Product_model->get_gg_product('con,gg_con_title,gg_con_ids,select_md5',array('product_id'=>$res['id']));
				$gg_con['cons']=json_decode($gg_con['con'],true);

				$this->ci_smarty->assign('gg_con',$gg_con);	
				$this->load->model('Base_cat_model');
				$res['cat_name'] =$this->Base_cat_model->get_row_field('cat',array('id'=>$res['catid']));
				$this->load->model('Warehouse_model');
				$res['warehouse_name'] =$this->Warehouse_model->get_row_field('name',array('id'=>$res['warehouse_id']));
				$page_htm="product_edit.htm";
			}
			else
			{
				$res=array();
				$page_htm="product_add.htm";
				$cat = explode( "|" , $_GET['cat_id'] );
				$warehouse = explode( "|" , $_GET['warehouse_id'] );
				$res['catid']          = $cat[0];
				$res['cat_name']       = $cat[1];
				$res['warehouse_id']   = $warehouse[0];
				$res['warehouse_name'] = $warehouse[1];
			}
				
			$this->load->model('Base_gg_model');
			//规格
			$gg=$this->Base_gg_model->get_list(array('catid'=>$res['catid']));
			if(!empty($gg_con['gg_con_ids']))
			{
				$ggstr=explode('|gg|',$gg_con['gg_con_ids']);
				$ids=str_replace('|',',',$ggstr[1]);
				$row=$this->Base_gg_model->get_con_result(" id in($ids) ",'cat_gg_id');
				$gg_list=array();
				foreach($row as $vv)
				{
					foreach($gg as $v)
					{
						if($v['id']==$vv['cat_gg_id'])
						{
							$gg_list[$v['id']]=$v;
							$gg_list[$v['id']]['con_list']=$this->Base_gg_model->get_con_result(array('cat_gg_id'=>$vv['cat_gg_id']));
							break;
						}
					}
				}
				
				$res['gg_list']=$gg_list;
			}
			else
			{
				if(!empty($gg))
				{
					foreach($gg as $k=>$v)
					{
						$gg[$k]['con_list']=$this->Base_gg_model->get_con_result(array('cat_gg_id'=>$v['id']));
					}
					$res['gg_list']=$gg;
				}
			}
			//品牌
			$this->load->model('Base_cat_model');
			$brand_ids=$this->Base_cat_model->get_row_field('brand_ids',array('id'=>$res['catid']));
			
			$res['brand_list']=array();
			if(!empty($brand_ids))
			{
				$this->load->model('Base_brand_model');
				$res['brand_list']=$this->Base_brand_model->get_list("id in ($brand_ids)",'name');
			}

			//产地
			$this->load->model('Admin_Country_model');
			$res['counrty']=$this->Admin_Country_model->get_show_country();

			//运费模板
			//$this->load->model('Base_logistics_model');
			//$res['logistics']=$this->Base_logistics_model->get_result(array(1=>'1'));
			
			$this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
		}
	    else
		{
			$this->load->model('Warehouse_model');
			//查找仓库
			$res['warehouse']=$this->Warehouse_model->get_result(array('1'=>1));
			$this->load->model('Base_cat_model');
			//分类
			$res['cat']=$this->Base_cat_model->get_result_list(array('pid'=>'0'));
			$res['c_cat']=json_encode($this->Base_cat_model->get_result_list(array('pid!='=>'0')));
		} 

		$this->ci_smarty->assign('re',$res);
		$this->ci_smarty->display_ini($page_htm);
	}
	
	private function del_gg()
	{
		$id=$_POST['old_pid']*1;
		if(!empty($id))
		{
			$this->load->model('Base_Product_model');
			//删除规格
			$num=$this->Base_Product_model->delete_gg_product(array('product_id'=>$id));
			if($num>=0)
			{
				//修改产品规格组
				$this->Base_Product_model->update(array('group_product_id'=>0),array('id'=>$id));
				echo 1;
				return;
			}
		}
		echo 0;
	}
	
	private function get_gg_html()
	{
		if(!empty($_POST['itemid']))
		{
			//echo $_POST['itemid'];
			//gg_id|gg_name|gg_con_id|gg_con_name
			$item=explode(",",$_POST['itemid']);
			$a=array();
			foreach($item as $d)
			{
				$v=explode("|",$d);
				if(!in_array($v[0],$a))
					$a[$v[0]]['name']=urldecode($v[1]);
					
				//selected-gg_con	
				$a[$v[0]]['list'][$v[2]]=urldecode($v[3]);	
			}
			
			$th_str='';
			$td_ar=array();
			
			foreach($a as $v)
			{
				$th_str.='<th>'.$v['name'].'<input type="hidden" name="gg_title[]" value="'.$v['name'].'">'.'</th>';
				$td_ar[]=$v['list'];
			}
			$th_str=$this->get_gg_html_str($th_str);
			$td_str=array();
			
			$i=0;//列
			$ar_start=array();
			$ar=array();
			foreach($td_ar as $ar_a)	
			{
				if(empty($ar_a))
					break;
				
				if(empty($ar_start))
				{
					foreach($ar_a as $id=>$vv)	
					{
						$ar[$j][$i]=array($id,$vv);
						$j++;
					}
				}
				else
				{
					$ar=array();
					foreach($ar_start as $v)
					{
						foreach($ar_a as $id=>$vv)	
						{
							$v[$i]=array($id,$vv);
							$ar[]=$v;
						}		
					}
				}
				$i++;
				$ar_start=$ar;
			}
			$str_tds='';
			$selected_check='';
			foreach($ar_start as $k1=>$v)
			{
				$str_td='';
				$gg_str='';
				$flag_title='';
				$pro=array();
				foreach($v as $k=>$vv)
				{
					$str_td.='<td>';
					$str_td.=$vv[1];
					$str_td.='</td>';
					$gg_str.=($gg_str?'|':'').$vv[0];
					$flag_title.=($flag_title?'|':'').$vv[1];
				}
				
				//查询产品数量 价格 显示 独立内容等
				if(!empty($_POST['group_product_id']))
				{
					$select_md5=md5($_POST['group_product_id']."|gg|".$gg_str);
					$row=$this->db->query("select product_id,status  from  ".tab_m('cat_gg_product')."  where  `select_md5`='$select_md5' ")->row_array();
					if(!empty($row))
					{
						$pro=$this->db->query("select  gg_group_show as display,market_price as mark_price,price,stock as num,barcode,status  as pstatus  from  ".tab_m('product')." where  id='".$row['product_id']."' ")->row_array();
						$pro['status']=$row['status'];
						$pro['product_id']=$row['product_id'];
						if($row['product_id']==$_POST['product_id'])
						{
					   		 $pro['selected']=1;
							 $selected_check=1;
						}
					}
				}
				else
					$pro=array();
				$str_tds.=$this->get_gg_html_str($str_td,2,$k1,$_POST['group_product_id']."|gg|".$gg_str,urlencode($flag_title),$pro);
			}
			
			if(!empty($_POST['product_id'])&&empty($selected_check))
				echo '只能增加和修改规格不能减少规格，可以删除全部规格内容-><a class="btn red">只删除规格</a>-><a class="btn red">删除全部规格产品</a>';
			else
				echo '<table  class="table table-striped table-bordered">'.$th_str.$str_tds.'</table>';
				
			return;
		}
	}

	private function get_gg_html_str($str='',$type=1,$k=0,$gg_str='',$flag_title='',$ar=array())
	{
		global $db;
		if($type==1)
			return '<tr>'.$str.'<th width="60">产品ID</th><th width="80">库存</th><th width="80">当前价格</th><th width="80">市场价</th><th width="80">货号</th><th width="60">显示</th><th width="60">独立</th></th><th width="80">状态</th><th width="60">操作</th></tr>';
		else
		{	
			if(empty($ar))
				$ar=array('num'=>0,'price'=>0,'mark_price'=>0,'barcode'=>0,'display'=>0,'status'=>0,'pstatus'=>0);
				
			$display=$ar['display']?'checked="checked"':'';
			$display1=!$ar['display']?'checked="checked"':'';
			$status=$ar['status']?'checked="checked"':'';
			$ar['pstatus']=empty($ar['pstatus'])?0:'';
			
			$pstatus=$ar['pstatus']==1?'checked="checked"':'';
			$pstatus1=$ar['pstatus']==0?'checked="checked"':'';
			$pstatus2=$ar['pstatus']==-1?'checked="checked"':'';

			$status1=!$ar['status']?'checked="checked"':'';
			$selected=!empty($ar['selected'])?'gg_selected':'';
			$ar['product_id']=empty($ar['product_id'])?0:$ar['product_id'];
			
			if(!empty($_POST['product_id'])&&!empty($ar['product_id']))
				$act='<td><input data-id="'.$k.'" data-old_pid="'.$ar['product_id'].'" type="button" class="btn mini red show_product"  value="关联" /> <a class="blue btn mini" onclick="'."alertWin('编辑产品-".$ar['product_id']."',800,400,'".site_url('product/product_add')."/?act=product_edit&id=".$ar['product_id']."',0,'".$_POST['p_select_index_id']."')".'" href="">切换</a> </td>'; 
			else
				$act='<td><input data-id="'.$k.'" data-old_pid="'.$ar['product_id'].'" type="button" class="btn mini red show_product"  value="关联" /></td>';

			return '<tr id="'.$selected.'">'.$str.'<td><span id="pid_'.$k.'">'.$ar['product_id'].'</span> <input class="pid_v" id="pid_v_'.$k.'" type="hidden" name="new_product_id['.$k.']" value=""> </td>
			            <td ><input type="hidden"  name="gg_str['.$k.']"  value="'.$gg_str.'"  >
						<input type="hidden"  name="flag_title['.$k.']"  value="'.$flag_title.'"  ><input  type="text"  style=" width:60px;" id="gg_num_'.$k.'" name="gg_num['.$k.']" value="'.$ar['num'].'" /></td>
						<td><input  type="text" style=" width:60px;" name="gg_price['.$k.']" id="gg_price_'.$k.'" value="'.$ar['price'].'" /></td>
						<td><input  type="text" style=" width:60px;" name="gg_mark_price['.$k.']"  id="gg_mark_price_'.$k.'" value="'.$ar['mark_price'].'" /></td>
						<td><input  type="text" style=" width:120px;" class="item_barcode_'.$k.'"  id="gg_barcode_'.$k.'" name="gg_barcode['.$k.']" value="'.$ar['barcode'].'" /></td>
						<td><label style="color:red;"> <input type="radio"  '.$display.' name="gg_display['.$k.']" value="2"  /> 是 </label> <label > <input type="radio" '.$display1.' name="gg_display['.$k.']"  value="1" /> 否 </label> </td>
						<td><label style="color:red;"> <input type="radio" '.$status.'  name="gg_status['.$k.']" value="2"  /> 独立 </label> <label > <input type="radio" '.$status1.'    name="gg_status['.$k.']"  value="1" /> 统一 </label> </td>
						<td> 
						    <label style="color:red;"> <input type="radio" '.$pstatus.'  name="gg_pstatus['.$k.']" value="1"  /> 上架 </label>
							<label> <input type="radio" '.$pstatus1.'  name="gg_pstatus['.$k.']" value="0"  /> 下架 </label>
							<label> <input type="radio" '.$pstatus2.'  name="gg_pstatus['.$k.']" value="-1" /> 回收站 </label>
						 </td>
						'.$act.'
					</tr>';
		}
	}

	private function edit_product()
	{
		$this->load->library('MY_form_validation');

		//如果无规格
	    if(empty($_POST['gg_str']))
		{
			$this->form_validation->set_rules('price','我的售价','required');
			$this->form_validation->set_rules('market_price','市场售价','required');
			$this->form_validation->set_rules('stock','库存','required');
			$this->form_validation->set_rules('barcode','货号','required');
		}
		
		if(empty($_GET['act'])||$_GET['act']!='up_gg')
		{
			$this->form_validation->set_rules('name','商品名称','required');
			$this->form_validation->set_rules('hg_type','贸易类型','required');
			//$this->form_validation->set_rules('desc','促销简称','required');
			$this->form_validation->set_rules('brand','品牌','required');
			$this->form_validation->set_rules('country','产地','required');
			//$this->form_validation->set_rules('weight','重量','required');
			$this->form_validation->set_rules('temp_id','运费模板','required');
			//$this->form_validation->set_rules('cubage','体积','required');
			$this->form_validation->set_rules('is_virtual','是否为虚拟商品','required');
			$this->form_validation->set_rules('status','是否上架','required');
			$this->form_validation->set_rules('start_time','开始日期','required');
			$this->form_validation->set_rules('valid_time','结束日期','required');
			$this->form_validation->set_rules('keywords','关键词','required');
			$this->form_validation->set_rules('pic','主图','required');
		}

		if ($this->form_validation->run() == FALSE)
		{
			$msg = array(
				'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
				'type' => 1
			);
			echo json_encode($msg);
			exit;
		}
		else
		{
			//如果无规格
			if(empty($_POST['gg_str']))
			{
				$product_arr['price']=$this->input->post('price',true);
				$product_arr['market_price']=$this->input->post('market_price',true);
				$product_arr['stock']=$this->input->post('stock',true);
				$product_arr['barcode']=$this->input->post('barcode',true);
			}
			
			if(empty($_GET['act'])||$_GET['act']!='up_gg')
			{
				$product_arr['name']=$this->input->post('name',true);
				$product_arr['hg_type']=$this->input->post('hg_type',true);
				$product_arr['desc']=$this->input->post('desc',true);
				$product_arr['brand']=$this->input->post('brand',true);
				$product_arr['desc']=$this->input->post('desc',true);
				$product_arr['brand']=$this->input->post('brand',true);
				$product_arr['warehouse_id']=$this->input->post('warehouse_id',true);
				$product_arr['catid']=$this->input->post('cat_id',true);
				$product_arr['country']=$this->input->post('country',true);
				$product_arr['weight']=$this->input->post('weight',true)*1;
				$product_arr['temp_id']=$this->input->post('temp_id',true)*1;
				$product_arr['cubage']=$this->input->post('cubage',true)*1;
				$product_arr['status']=$this->input->post('status',true)*1;
				$product_arr['rate']=$this->input->post('rate',true)*1;
				$product_arr['start_time']=$this->input->post('start_time',true);
				$product_arr['valid_time']=$this->input->post('valid_time',true);
				$product_arr['keywords']=$this->input->post('keywords',true);
				$product_arr['pic']=$this->input->post('pic',true);
				$product_arr['uptime']=date('Y-m-d H:i:s');
				$product_arr['pic_more']=implode(',',$_POST['pics']);
			}
			
			//如果无规格时金额判断
			if(empty($_POST['gg_str']))
			{
				if($product_arr['price']<=0)
				{
					$msg = array(
						'msg'  =>"<i class='icon-comment-alt'></i>"." 销售金额不能小于等于 0 ",
						'type' => 1
					);
					echo json_encode($msg);
					exit;
				}
			}
				
			$this->load->model('Base_Product_model');	
			//不存在规格
			if(empty($_POST['gg_str']))
			{
				if(!empty($_POST['id']))
					$res=$this->Base_Product_model->update($product_arr,array('id'=>$_POST['id']));
				else
				{
					$pid=$this->Base_Product_model->insert($product_arr);
					$res=$this->Base_Product_model->insert_product_con(array('product_id'=>$pid,'con'=>$this->input->post('con',true)));
				}
			}
			else if(!empty($_POST['gg_str']))
			{
				//存在规格创建多个产品
				$old_group_product_id=0;//规格产品组ID
				
				//查询所有的规格是否是已编辑过的
				foreach($_POST['gg_str'] as $k=>$v)
				{
					$gg_str=explode('|gg|',$v);
					if(!empty($gg_str[0]))
					{
						$old_group_product_id=$gg_str[0];
						break;
					}
				}
				
				$check_display=0;
				//判断是否有产品能设定为独立显示
				foreach($_POST['gg_display'] as $v)
				{
					if($v==2)
						$check_display=1;	
				}
				
				if($check_display==0)
				{
					$msg = array(
						'msg'  =>"<i class='icon-comment-alt'></i>"."必须设定一个产品为显示内容",
						'type' => 1
					);
					echo json_encode($msg);
					exit;
				}

				if(empty($old_group_product_id))
					$new_group_product_id=$this->Base_Product_model->get_gg_proup_id();
				else
					$new_group_product_id=$old_group_product_id;
			
				if(empty($new_group_product_id))
				{
					$msg = array(
						'msg'  =>"<i class='icon-comment-alt'></i>"."系统异常请稍后,创建规格组失败",
						'type' => 1
					);
					echo json_encode($msg);
					exit;
				}	
				
				foreach($_POST['gg_str'] as $k=>$v)
				{
					$v=trim($v);
					$product_arr['stock']=$_POST['gg_num'][$k]*1;
					$product_arr['price']=$_POST['gg_price'][$k]*1;
					$product_arr['market_price']=$_POST['gg_mark_price'][$k]*1;
					$product_arr['barcode']=$_POST['gg_barcode'][$k];
					$product_arr['gg_group_show']=$_POST['gg_display'][$k]*1==1?0:1; //0不显示  1显示
					$product_arr['status']=$_POST['gg_pstatus'][$k]*1;
					$gg_str=explode('|gg|',$v);
					$gg_status=$_POST['gg_status'][$k]*1==1?0:2; //0统一内容  1独立内容
					$flag_title=$_POST['flag_title'][$k];
					$gg_con_title_gg=implode('|',$_POST['gg_title']);
							
					//关联产品id
					$link_product_id=$_POST['new_product_id'][$k];
					
					if(!empty($gg_str[0]))
						$pid=$this->Base_Product_model->get_gg_product('product_id',array('select_md5'=>md5($v)));
					else
						$pid=0;
					
					//未勾选规格过滤	
					foreach($_POST['gg_name'] as $kk=>$vv)
					{
						foreach($vv as $id=>$pr)
						{
							if(!in_array($id,$_POST['gg_ids']))
								unset($_POST['gg_name'][$kk][$id]);
						}
						if(empty($_POST['gg_name'][$kk]))
							unset($_POST['gg_name'][$kk]);
					}

					if(!empty($pid))
						$res=$this->Base_Product_model->update($product_arr,array('id'=>$pid));
					elseif(!empty($link_product_id))
					{
						//首次关联只能关联组 不能同步产品内容
						$res=$this->Base_Product_model->insert_gg_product(
								array('group_product_id'=>$new_group_product_id
									  ,'select_md5'=>md5($new_group_product_id."|gg|".$gg_str[1])
									  ,'gg_con_ids'=>$new_group_product_id."|gg|".$gg_str[1]
									  ,'product_id'=>$link_product_id
									  ,'gg_con_title'=>urldecode($flag_title)
									  ,'gg_con_title_gg'=>$gg_con_title_gg
									  ,'con'=>json_encode($_POST['gg_name'])
									  ,'status'=>$gg_status)
						);
						if($res)
							$res=$this->Base_Product_model->update(array('group_product_id'=>$new_group_product_id,'gg_group_show'=>$product_arr['gg_group_show']),array('id'=>$link_product_id));
					}	
					else
					{
						//编辑规格时添加新的规格 查询统一的内容没者查询其他的相关内容	
						$res=$this->Base_Product_model->get_row(array('id'=>$_POST['id']));
						unset($res['id']);
						$res=$this->Base_Product_model->get_product_con_row(array('product_id'=>$_POST['id']));
						$product_arr['group_product_id']=$new_group_product_id;
						$pid=$this->Base_Product_model->insert($product_arr);
						if(!empty($pid))
						{
							$res=$this->Base_Product_model->insert_product_con(array('product_id'=>$pid,'con'=>$this->input->post('con',true)));
							$this->Base_Product_model->insert_gg_product(
								array('group_product_id'=>$new_group_product_id
									  ,'select_md5'=>md5($new_group_product_id."|gg|".$gg_str[1])
									  ,'gg_con_ids'=>$new_group_product_id."|gg|".$gg_str[1]
									  ,'product_id'=>$pid
									  ,'gg_con_title'=>urldecode($flag_title)
									  ,'gg_con_title_gg'=>$gg_con_title_gg
									  ,'con'=>json_encode($_POST['gg_name'])
									  ,'status'=>$gg_status)
							);
						}
					}
				}
				if( $res )
				{
					$msg = array(
						'msg'  => '操作成功',
						'type' => 2,
					);
					echo json_encode($msg);
					exit;
				}
				else
				{
					$msg = array(
						'msg'  => '操作失败',
						'type' => 1
					);
					echo json_encode($msg);
					exit;
				}
			}
		}
	}


	/**
	 * 关联商品
	 */
	private function select_product()
	{
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql=" catid=".$_GET['cat_id']." and group_product_id=0 ";
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('warehoust_id');
			//姓名模糊查询字段
			$search_key_ar_more=array('name');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and a.{$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and a.{$skey} like '%{$v}%'";
				}
			}
		}

		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
				->where($wsql)
				->select_one('a.*',tab_m('product')." as a ")
				
				->num_rows();
		}

		$res=array();
		$de=$this->Base_page_model
			->where($wsql)
			->select_one('a.*',tab_m('product')." as a ")
			->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();

		//查找仓库
		$this->load->model('Warehouse_model');
		$res['warehouse']=$this->Warehouse_model->get_result(array(1=>'1'));
		$this->ci_smarty->assign('re',$res,1,'page');
		$this->ci_smarty->display_ini('product_show_product.htm');
	}
	/**
	 * 商品列表
	 */
	public function  product_list()
	{
		$this->base_product_list();
	}
	
	private function base_product_list($page_htm='product_list.htm',$wsql=' 1=1 ')
	{
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('catid','warehoust_id');
			//姓名模糊查询字段
			$search_key_ar_more=array('name');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and a.{$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and a.{$skey} like '%{$v}%'";
				}
			}
		}

		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
				->where($wsql)
				->select_one('a.*',tab_m('product')." as a ")
				
				->num_rows();
		}

		$res=array();
		$de=$this->Base_page_model
			->where($wsql)
			->select_one('a.*,b.gg_con_title',tab_m('product')." as a ")
			->left_join(tab_m('cat_gg_product')." as b "," a.id=b.product_id")
			->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();

		//查找仓库
		$this->load->model('Warehouse_model');
		$res['warehouse']=$this->Warehouse_model->get_result(array(1=>'1'));
		//查找分类
		$this->load->model('Base_cat_model');
		$res['cat']=$this->Base_cat_model->get_result_list(array('1 '=>'1'),'id,pid,cat','id asc');
		$this->ci_smarty->assign('re',$res,1,'page');
		
		$this->ci_smarty->display_ini($page_htm);
	}

	/**
	 * 商品下架
	 */
	private function product_shelves($type,$item,$pro='down')
	{
		//model
		$this->load->model('Base_Product_model');

		if($pro=='on')
		{
			//单商品上架
			if($type=='single')
				$res=$this->Base_Product_model->update(array('status'=>1),array('id'=>$item));


			//商品批量上架
			if($type=='batch')
			{
				$item_arr=array_filter(explode(',',$item));
				foreach ( $item_arr as $k=>$v)
				{
					$res=$this->Base_Product_model->update(array('status'=>1),array('id'=>$v));
				}
			}
		}
		else
		{
			//单商品下架
			if($type=='single')
			{
				$res=$this->Base_Product_model->update(array('status'=>0),array('id'=>$item));

			}

			//商品批量下架
			if($type=='batch')
			{
				$item_arr=array_filter(explode(',',$item));
				foreach ( $item_arr as $k=>$v)
				{
					$res=$this->Base_Product_model->update(array('status'=>0),array('id'=>$v));
				}
			}
		}

		if( $res )
		{
			$msg = array(
				'msg'  => '操作成功',
				'type' => 3,
			);
			echo json_encode($msg);
			die;
		}
		else
		{
			$msg = array(
				'msg'  => '操作失败',
				'type' => 1
			);
			echo json_encode($msg);
			die;
		}
	}

	/**
	 * 彻底删除 
	 *
	 */
	private function product_delete($type,$item,$pro='del')
	{
		//model
		$this->load->model('Base_Product_model');

		if($pro=='back')
		{
			if($type=='single')
			{
				$res=$this->Base_Product_model->update(array('status'=>-1),array('id'=>$item));
			}
			
			if($type=='batch')
			{
				$item_arr=array_filter(explode(',',$item));
				foreach ( $item_arr as $k=>$v)
				{
					$res=$this->Base_Product_model->update(array('status'=>-1),array('id'=>$v));
				}
			}
		}
		elseif ($pro=='del_nos')
		{  
			//单商品删除
			if($type=='single')
			{
				$res=$this->Base_Product_model->delete(array('id'=>$item));
			}
			//商品批量删除
			if($type=='batch')
			{
				$item_arr=array_filter(explode(',',$item));
				foreach ( $item_arr as $k=>$v)
				{
					$res=$this->Base_Product_model->delete(array('id'=>$v));

				}
			}
		}


		if( $res )
		{
			$msg = array(
				'msg'  => '操作成功',
				'type' => 3,
			);
			echo json_encode($msg);
			die;
		}
		else
		{
			$msg = array(
				'msg'  => '操作失败',
				'type' => 1
			);
			echo json_encode($msg);
			die;
		}
	}



}




