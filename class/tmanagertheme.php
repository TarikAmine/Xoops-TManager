<?php
class TManagerTheme{
	
	private $_instance = null;
	private $_obj = null;
	private $_css = array();
    
	/**
   * constructor
   */
  private function __construct(TManagerPreset $obj)
  {
      $this->_obj = $obj;
      //$this->_obj = new TManagerPreset();
      $this->loadCss();
  }
  
  public static function getInstance() 
	{
        static $instance;
        if (!isset($instance)) {
            $helper = Xoops_Module_Helper::getHelper('tmanager');
            $class = __CLASS__;
            $instance = new $class($helper->getHandlerPresets()->getDefault());
        }
        return $instance;
  }
    
	public function addCssWidth($var, $value){
		$value = explode('|', $value);
		$value[1] .= $value[0]?'%':'px';
		$this->_css[$var]['width'] = $value[1];
	}
	
	public function addCssHeight($var, $value){
		$this->_css[$var]['height'] = $value.'px';
	}
	
	public function addCssBg($var, $value){
		$value = explode('|', $value);
		if(count($value)==1)
			$this->_css[$var]['background'] = $value[0];
		elseif(count($value)==2 && $value[0])
			$this->_css[$var]['background'] = 'transparent';
		else
			$this->_css[$var]['background'] = $value[1];
	}
	
	public function addCssAlign($var, $value){
		$align = array('l' => 'left', 'c' => 'center', 'r' => 'right');
		$value = $value;
		$this->_css[$var]['text-align'] = $align[$value];
	}
	
	public function addCssTxt($var, $value){
		$value = explode('|', $value);

		$this->_css[$var]['font-size'] = $value[0]!='inhert'?$value[0].'px':'inhert';
		$this->_css[$var]['color'] = $value[1];
		$this->_css[$var]['font-family'] = $value[2];
		if($value[3])
			$this->_css[$var]['font-weight'] = 'bold';
		if($value[4])
			$this->_css[$var]['font-style'] = 'italic';
		if($value[5])
			$this->_css[$var]['text-decoration'] = 'underline';
	}
	
	public function addCssBox($var, $value, $type){
		$value = explode('|', $value);
    $i = -1;
		$box = array('top', 'right', 'bot', 'left');
		foreach($box as $b)
      if($value[++$i]!='auto')
        $this->_css[$var][$type][$b] = $value[$i].'px';
      elseif($type == 'padding')
        $this->_css[$var][$type][$b] = '0';
      elseif($b=='top' || $b=='bot')
        $this->_css[$var][$type][$b] = '0';
      else
        $this->_css[$var][$type][$b] = 'auto';
	}
	
	public function addCssPadding($var, $value){
		$this->addCssBox($var, $value, 'padding');
	}
	
	public function addCssMargin($var, $value){
		$this->addCssBox($var, $value, 'margin');
  }
	/*
	public function addCssBorder($var, $value){
		$value = explode('|', $value);
		if($value[0])
			$this->_css[$var]['border'] = $value[1].'px '.$value[2].' '.$value[3];
		else
			$this->_css[$var] = array('border-top' => $value[1].'px '.$value[2].' '.$value[3],
						 'border-left' => $value[4].'px '.$value[5].' '.$value[6],
						 'border-right' => $value[7].'px '.$value[8].' '.$value[9],
						 'border-bottom' => $value[10].'px '.$value[11].' '.$value[12]);
	}*/
  
	public function loadCss(){
		$vars = $this->_obj->getVars();
    $refs = array('g'=>'body', 'h1'=>'h1', 'h2'=>'h2', 'h3'=>'h3', 'link'=>'a', 'hlink'=>'a:hover', 'vlink'=>'a:visited', 'l'=>'#layout', 'h'=>'#header', 'n'=>'.navbar', 's'=>'.sidebar', 'm'=>'#content', 'f'=>'footer');
		foreach($vars as $k => $v){
      $index = explode('_', $k);
      if(count($index)==2){
        $class = $index[0];
        $method = 'addCss'.ucfirst($index[1]);
        if(is_callable(array($this, $method))){ 
            $this->$method($refs[$class], $v['value']);
        }
      }
    }
	}
	
	public function getMenu(){
    return '<div class="navbar '.($this->_obj->getVar('n_type')?'navbar-inverse':'').'" style="position: static;">
              <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                      <li class="active"><a href="#">Home</a></li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                    </ul>
                  <form class="navbar-search pull-right">
                    <input type="text" class="search-query" placeholder="Search">
                  </form>
                </div>
              </div><!-- /navbar-inner -->
            </div>';
  }
  
	public function getPreHeader(){
    return $this->_obj->getVar('n_pos')==1?$this->getMenu():'';
  }
  
	public function getPastHeader(){
    return $this->_obj->getVar('n_pos')==2?$this->getMenu():'';
  }
  
	public function getStruct(){
    $struct = explode('|', $this->_obj->getVar('l_struct'));
    return array(
                $struct[0]<6&&$struct[0]>=0?$struct[0]:4,
                $struct[1]<6&&$struct[1]>3?$struct[1]:4,
                12-$struct[0]-$struct[1]
                );
  }
  
	public function getSheet(){
    $sheet='';
		foreach($this->_css as $id => $lines){
      $sheet.=$id.'{';
      foreach($lines as $att => $val){
        $sheet.=$att.':';
        if(is_array($val))
          foreach($val as $v)
            $sheet.=' '.$v;
        else
          $sheet.=$val;
        $sheet.=';';
      }
      $sheet.= "}\n";
    }
    return $sheet;
	}
}


?>