<?php
namespace CoreMain;
class CTemplate {
  var $code;
  var $keywords;
  var $start = '[#';
  var $end = '#]';
  public function __construct($url){
      $this->getURL($url);
  }
  function getURL($url){
    $this->code=file_get_contents($url);
    $this->code = str_replace("\r\n",'',$this->code);
    $this->code = str_replace("\r",'',$this->code);
    $this->code = str_replace("\n",'',$this->code);
    $this->code = str_replace("\t",'',$this->code);
    $this->keywords=array();
  }
  function CAdd($keyword,$text){
    $this->keywords[$keyword]=$text;
  }
	
  function CLoop($array_id,$array_name){
	  $count_table = count($array_name);
		if ($count_table>0) {
                        $loop_code = '';
                        $start_pos = strpos(strtolower($this->code), '<loop name="'.$array_id.'">') + strlen('<loop name="'.$array_id.'">');
                        $end_pos = strpos(strtolower($this->code), '</loop name="'.$array_id.'">');
                        $loop_code = substr($this->code, $start_pos, $end_pos-$start_pos);
                        $start_tag = substr($this->code, strpos(strtolower($this->code), '<loop name="'.$array_id.'">'),strlen('<loop name="'.$array_id.'">'));
                        $end_tag = substr($this->code, strpos(strtolower($this->code), '</loop name="'.$array_id.'">'),strlen('</loop name="'.$array_id.'">'));
                        if($loop_code != ''){
                                $new_code = '';
                                for($i=0; $i<$count_table; $i++){
                                        $temp_code = $loop_code;
                                        while(list($key,) = each($array_name[$i])){
																				        $array_name[$i][$key];
                                                $temp_code = str_replace($this->start.$key.$this->end,$array_name[$i][$key], $temp_code);
                                        }
                                        $new_code .= $temp_code;
                                }
                                $this->code = str_replace($start_tag.$loop_code.$end_tag, $new_code, $this->code);
                        }
		}
		else {
				$this->code = preg_replace('/<loop name="'.$array_id.'">(.*)<\/loop name="'.$array_id.'">/i', '', $this->code);
		}
	}
	
  function CIf($keyword, $text){
			if ($text==1) {
					$this->code = str_replace('<if name="'.$keyword.'">','', $this->code);
					$this->code = str_replace('</if name="'.$keyword.'">','', $this->code);
			}
			else {
					$this->code = preg_replace('/<if name="'.$keyword.'">(.*)<\/if name="'.$keyword.'">/i', '', $this->code);
			}
	}
  function CGet() {
    reset($this->keywords);
    while(list($key,$val)=each($this->keywords)) $this->code=str_replace($key,$val,$this->code);
	    $this->code = preg_replace('/\[#(.*?)#\]/i', '', $this->code);
		  $this->code = preg_replace('/<if name="(.*?)">/i', '', $this->code);
		  $this->code = preg_replace('/<\/if name="(.*?)">/i', '', $this->code); 
		  $this->code = preg_replace('/<loop name="(.*?)">/i', '', $this->code); 
		  $this->code = preg_replace('/<\/loop name="(.*?)">/i', '', $this->code); 
    return $this->code;
  }
}
?>