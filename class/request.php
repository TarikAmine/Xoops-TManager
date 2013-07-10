<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id: Request.php 10616 2012-12-31 19:02:57Z trabis $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class TManager_Request extends Xoops_Request_Http
{
	protected static $_instance;
	
	public function asFont($name, $default = '14|#000000|Helvetica|0|0|0')
  {
		$default = explode('|', $default);
		$data = 'inhert|';
		if(!$this->asStr($name.'_disabled', 0)) 
			$data = $this->asInt($name.'_size', $default[0]).'|';
		$data .= $this->asStr($name.'_color', $default[1]).'|';
		$data .= $this->asStr($name.'_font', $default[2]).'|';
		$data .= $this->asInt($name.'_b', $default[3], array(0,1)).'|';
		$data .= $this->asInt($name.'_i', $default[4], array(0,1)).'|';
		$data .= $this->asInt($name.'_u', $default[5], array(0,1));
		return $data;	
  }
	
	public function asColor($name, $default = '0|#ffffff', $trans = true)
  {
		$default = explode('|', $default);
    if($trans){
			$val =  $this->asInt($name.'_t', $default[0], array(0,1)).'|';
      $default_color = $default[1];
		}else{
      $val = '';
      $default_color = $default[0];
    }
    $color = $this->asStr($name, $default_color);
    if(preg_match('/^#[a-f0-9]{6}$/i', $color))
      $val.= $color;
    else
      $val.= $default_color;
      
    return $val;
  }

	public function asWidth($name, $default = '0|0')
  {
		$default = explode('|', $default);
		return $this->asInt($name.'_type', $default[0], array(0,1)).'|'.$this->asInt($name.'_nbr', $default[1]);
  }

	public function asColumns($name, $default = '3|6')
  {
		$default = explode('|', $default);
    return $this->asInt($name.'_0', $default[0]).'|'.$this->asInt($name.'_1', $default[1]);
	}

	public function asBorder($name, $default = '1|1|solid|#E1E1E1')
  {
		$default = explode('|', $default);
		if($this->asInt($name.'_yn', $default[0])){
			return  '1|'.
					$this->asInt($name.'_all_size_number', $default[1]).'|'.
					$this->asStr($name.'_all_type', $default[2]).'|'.
					$this->asStr($name.'_all_color', $default[3]);
		}else{
			$data = '0';
			$box = array('top', 'left', 'right', 'bot');
			foreach($box as $b){
				$size = $this->asInt($name.'_'.$b.'_size', $default[1]);
				if(!$size || $this->asInt($name.'_'.$b.'_size_disabled', 0))
					$data .= '|0||';
				else{
					$data .= '|'.$size;
					$data .= '|'.$this->asStr($name.'_'.$b.'_type', $default[2]);
					$data .= '|'.$this->asStr($name.'_'.$b.'_color', $default[3]);
				}
			}	
			return $data;
		}
  }

	public function asAlign($name, $default = 'l')
  {
        return $this->asStr($name.'_input', $default, array('l', 'c', 'r'));
  }

	public function asBox($name, $default = 0, $include = null, $exclude = null)
  {
    $data = '';
		$i = 0;
		$box = array('top', 'right', 'bot', 'left');
		foreach($box as $b){
			if(!$this->asStr($name.'_'.$b.'_disabled', 0))
				$data .= $this->asInt($name.'_'.$b, $default[$i]).'|';
			else
				$data .= 'auto|';
			$i++;
		}
		return substr_replace($data  ,"",-1);
  }
  
    /**
     * @return Xoops_Request_Http
     */
	public static function getInstance() 
  {
      if( self::$_instance === NULL ) {
        self::$_instance = new self();
      }
      return self::$_instance;
  }
}
