<?php
defined('APPPATH') or die('Access restricted!'); 
class CI_page
{
    var $firstRow     = 0 ;   //
    var $listRows     = 10;   // 
    var $parameter    = '';   // 
    var $totalPages   = 0 ;   // 
    var $totalRows    = 0 ;   // 
    var $nowPage      = 0 ;   // 
    var $showPageJump = True; // 
    var $coolPages    = 0 ;   // 
    var $rollPage     = 10 ;  //
	var $url		  = NULL;
	var $prePage      ='';
	var $nextPage     ='';

    function Page()
    {
        //$a_url = $_REQUEST;
		$a_url = $_GET;
		foreach($a_url as $key=>$v)
		{
			if(!empty($v)&&!is_array($v))
				$a_url[$key]=urlencode($v);
		}
		
        if (isset($a_url['totalRows']))
            $this->totalRows = $a_url['totalRows']*1<=0?0:$a_url['totalRows']*1;

        if (isset($a_url['firstRow']))
            $this->firstRow = $a_url['firstRow']*1<=0?0:$a_url['firstRow']*1;
        else
            $this->firstRow = 0;
		
        $this->totalRows=$this->totalRows<=0?0:$this->totalRows;
        $this->firstRow=($this->totalRows<=0||$this->firstRow<=0)?0:$this->firstRow;

        unset($a_url['PHPSESSID']);
        unset($a_url['firstRow']);
        unset($a_url['totalRows']);
        $this->convert($a_url);
		
        if ($a_url)
            $this->parameter =  implode('&',$a_url);
        if ($this->parameter)
            $this->parameter = '&'.$this->parameter;
		if ($this->totalRows < $this->firstRow+1 && $this->firstRow != 0)
            $this->firstRow = $this->totalRows - 1;
    }

    function __set($name, $value)
    {
        $this->$name = $value;
    }

    function __get($name)
    {
        return $this->$name;
    }

    function convert(& $array)
    {
        if (is_array($array))
        {
            return @array_walk($array, create_function('&$value, $key', '$value = $key ."=". $value;'));
        }
    }
    
	function get_js_string($tm)
	{
		return "<script>
		   try
		   {
			   $('#pageto_".$tm."').bind('click',function(){
				try
				{
					 var pageto_num=$('#page_num_".$tm."').val()*1;
					 var firstrow=$('#page_url_".$tm."').attr('listrows')*(pageto_num-1);
					 var totalrows=$('#page_url_".$tm."').attr('totalrows');
					 var parameter=$('#page_url_".$tm."').attr('parameter');
					 window.location=$('#page_url_".$tm."').val()+'?firstRow='+firstrow+'&totalRows='+totalrows+parameter;
				}
				catch(e){}
				
			 });
		  }
		  catch(e){window.document.getElementById('pageto_all_".$tm."').style.display='none'}	
		</script>";
    }
	
    /*--------------------------------------------------------------------------
    -----------------------------------------------------------------------------*/
   function prompt()
   {
        if(0 == $this->totalRows)
            return;

        $this->totalPages = ceil($this->totalRows/$this->listRows); 
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);

        if ( $this->firstRow >= $this->totalRows )
        { 
            $this->nowPage  = $this->totalPages;
            $this->firstRow = ($this->totalPages-1) * $this->listRows;
        }
        else
            $this->nowPage = floor($this->firstRow/$this->listRows + 1); 
        $nowCoolPage = ceil($this->nowPage/$this->rollPage);
        
        if($this->nowPage>1)
        {
            $preRow   =  ($this->nowPage-2) * $this->listRows;
            $this->prePage  = "<a class='prePage' href='".$this->url."?firstRow=$preRow&totalRows=$this->totalRows$this->parameter'>上一页</a>";
        }
		else
			$this->prePage  = "<b style='color: #C3B9B9;'>上一页</b>";
	
		if($this->nowPage>5)
			$theFirst = " <a href='".$this->url."?firstRow=0&totalRows=$this->totalRows$this->parameter'>1...</a>";
        else
			$theFirst ='';
   		if($this->nowPage<$this->totalPages)
		{
			$nextRow   = ($this->nowPage) * $this->listRows;
			$theEndRow = ($this->totalPages-1) * $this->listRows;
			$this->nextPage  = " <a class='nextPage' href='".$this->url."?firstRow=$nextRow&totalRows=$this->totalRows$this->parameter'>下一页</a>";
			
			if($this->totalPages-$this->nowPage>5)
				$theEnd   = " <a href='".$this->url."?firstRow=$theEndRow&totalRows=$this->totalRows$this->parameter'>..$this->totalPages</a>";
        }
		else
		{
			$this->nextPage  = "<b style='color: #C3B9B9;'>下一页</b>";
			$theEnd   ='';
		}
        //list pages
        $linkPage = '';
		if($this->nowPage<6)
			$kpage=10;
		elseif($this->nowPage+5<$this->totalPages)
			$kpage=$this->nowPage+4;
		else
			$kpage=$this->nowPage+($this->totalPages-$this->nowPage);
			
		if($this->nowPage<=5)
			$knpage=1;
		else
			$knpage=$this->nowPage-4;
			
        for($page=$knpage; $page<=$kpage; $page++)
        {
            $rows = ($page-1) * $this->listRows;
            if($page != $this->nowPage)
            {
                if($page <= $this->totalPages)
                    $linkPage .= " <a href='".$this->url."?firstRow=$rows&totalRows=$this->totalRows$this->parameter'>".$page."</a>";
                else
                    break;
            }
            else
            {
                if($this->totalPages != 1)
                    $linkPage .= " <b style='color: red;'>".$page."</b>";
            }
        }

		if(empty($linkPage))
			 $linkPage .= " <b style='color:red;'>1</b>";
		if($this->totalPages<=5)
			$pageStr =$theFirst.' '.$this->prePage.' '.$linkPage.' '.$this->nextPage;
		else
		{
			$pageStr =$this->prePage.' '.$theFirst.' '.$linkPage.' '.$theEnd.' '.$this->nextPage;
			$id_time=rand(10,99);
			$pageStr.="<span id='pageto_all_".$id_time."' ><input type='hidden' id='page_url_".$id_time."' totalrows='".$this->totalRows."'
					   listrows='".$this->listRows."'  parameter='".$this->parameter."' value='".$this->url."'>";
			$pageStr.="<input type='text' id='page_num_".$id_time."' style='width:40px;margin:0px;height:20px;margin-left:10px;  padding: 1px;' value='".$this->nowPage."'> <input class='btn blue mini' id='pageto_".$id_time."' type='button' value='跳转'></span>";
			$pageStr.=$this->get_js_string($id_time);
		}
				
        return $pageStr;
    }
}
?>