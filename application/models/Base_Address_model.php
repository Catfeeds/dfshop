<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Address_model extends CI_Model
{
    function get_district($fetchFields,$pid='')
    {
        $this->db->where('pid',$pid);
        return $this->db->select($fetchFields)
            ->from(tab_m('district'))
            ->get()
            ->result_array();
    }


    function check_addrtcode($ReceiveAreaName)
    {
        /*
         * $ReceiveAreaName
         * 传过来的值  类似  "河北省,唐山市,路北区"
         * */
        $addr=explode(',',$ReceiveAreaName);
      
        if(count($addr)<3)
            return '收货省市区错误:省 市 区 地区不能为空[>>'.$ReceiveAreaName;
        $city=substr($addr[0],0,6);

        $row=$this->db->query("select  id  from  ".tab_m('district')."  where pid=0  and  name like '$city%' limit 1")->row_array();
        $cid=$row['id'];  //省ID
        $ids=substr($cid,0,2);/*省ID前2位*/
        $ReceiveAreaCode=1;
        if($ids)
        {
            $code=array('北京'=>'110100','天津'=>'120100','重庆'=>'500100','上海'=>'310100');
            $ReceiveAreaCode=isset($code[$city])?$code[$city]:'';
            if(empty($ReceiveAreaCode))
            {
                $area=substr($addr[1],0,9);/*地区名*/

                if($area)
                {
                    $are=$this->db->query("select  pid,id  from  ".tab_m('district')."  where id like '$ids%' and  
						  name like '$area%' order by id asc limit 1     ")->row_array();
                    $ReceiveAreaCode=$are['id'];/*地区ID*/
                    //----------------如果第二级不存在-------
                    if(empty($ReceiveAreaCode))
                    {
                        $area=substr($addr[2],0,9);
                        $res=$this->db->query("select  pid,id,name  from  ".tab_m('district')."  where id like '$ids%' and  
									  name like '$area%' and pid!=0 order by id desc")->result_array();

                        if(empty($res))
                            return '收货地址省市区不匹配 [原地址>>'.$ReceiveAreaName;
                        if(empty($res[1]))
                        {
                            $pid=$res[0]['pid'];
                            $row=$this->db->query("select  name  from  
								         ".tab_m('district')."  where id='$pid' order by id desc limit 1")->row_array();
                            $name=$row['name'];
                            return '[收货地址不存在]：推荐地址:'.$addr[0].',【'.$name.'】,'.$addr[2]." [原地址 >>".$ReceiveAreaName;
                        }
                        else
                        {
                            $name='';
                            foreach($res as $v)
                            {
                                $row=$this->db->query("select  name  from  
											 ".tab_m('district')."  where id='$v[pid]'  and pid!=0 order by id desc limit 1")->row_array();
                                $sname=$row['name'];
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
											".tab_m('district')."  where id='$are[pid]' order by id desc ");
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
//                    $addr[6]=$addr[5];
//                    $addr[5]=$addr[4];
//                    $addr[4]=$addr[3];
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

    /**
     * 将所有地址设置为非默认地址
     * @param $userid
     */
    public function set_default_address($userid)
    {
        $data=array(
            'default'=>0
        );
        $this->update($data,array('userid'=>$userid));
    }

    public function insert($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('delivery_address'),$arr);
    }

    public function delete($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('delivery_address'),$where);
    }

    public function update($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('delivery_address'),$data,$where);
    }

    public function get_row($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('delivery_address'),'*',$where);
    }

    public function get_list($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('delivery_address'),'*',$where);
    }

}

