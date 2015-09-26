<?php

namespace Robot\ParserBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery as ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ParsersAdminController extends Controller
{
	private $request;
	private $ParsersModel;
	private $id;

	public function ImportAction(Request $request) {
		$this->request = $request;
		$this->id = $this->request->get($this->admin->getIdParameter());
		$this->ParsersModel = $this->get('parsers.service');
		$this->ParsersModel->UpdateParser($this->id);
		$parts = array();
		$parts = $this->ParsersModel->GetParts($this->id);
		if(!empty($parts['parts'])){
			$parts = $parts['parts'];
		}
		$items = explode(",", $parts);

		$array_data = $this->ParsersModel->DeleteItems($this->id);

		$array_data = array();
		switch ($this->id) {
			case 1:
				$this->Bilsteinus($items);
				break;			
		}

		return new RedirectResponse($this->admin->generateUrl('list'));
	}

	private function Bilsteinus($items){

		foreach ($items as $key => $item) {
			$active = $this->ParsersModel->GetActiveStatus($this->id);
			if($active == 0 ) return new RedirectResponse($this->admin->generateUrl('list'));
 			$old_number = "";

			$content = $this->fileGetContentz("http://cart.bilsteinus.com/product/".$item);
		//Part#
		  $pos      = strpos($content, 'b>Part Number:</b>');
		  $old      = strpos($content, '<b>Old Part Number</b>: ');
		   if($old) {
			  $pos1     = strpos($content, '<b>Old Part Number</b>: ');
			  $part_number   = substr($content, $pos, $pos1 - $pos);
			  $part_number      = str_replace('b>Part Number:</b>', "", $part_number);
			  $part_number      = str_replace('<br /><br /><b>', "", $part_number);
			  $part_number      = trim(str_replace('<br />', "", $part_number));
			  $array_data[$item]['number'] = $part_number ;
			}
			else
			{
			  $pos1     = strpos($content, '<br /><b><span style="color: red"');
			  $part_number   = substr($content, $pos, $pos1 - $pos);
			  $part_number      = str_replace('b>Part Number:</b>', "", $part_number);
			  $part_number      = str_replace('<br /><br /><b>', "", $part_number);
			  $part_number      = trim(str_replace('<br />', "", $part_number));
			  $array_data[$item]['number'] = $part_number ;
			}
		//Old#
		       $pos      = strpos($content, '<b>Old Part Number</b>: ');
		       if($pos) {
		        $pos1     = strpos($content, '<b><span style="color: red">Series');
		      $old_number   = substr($content, $pos, $pos1 - $pos);
		      $old_number      = str_replace('<b>Old Part Number</b>: ', ",", $old_number);
		      $old_number      = str_replace('div style="clear: both"></div><br />', "", $old_number);
		      $old_number       = ltrim($old_number, ",");
		      $old_number       = trim(str_replace('<b>Old Part Number</b>: ', "", $old_number));
		      $old_number      = trim(str_replace('<br />', "", $old_number));
		      $array_data[$item]['old_number'] = $old_number  ; 
		       }
		       else
		       {
		        $array_data[$item]['old_number'] = "Null"  ; 
		       }

		//Collapsed#
		  $pos      = strpos($content, '<b>*Collapsed Length (IN)</b>: ');
		  if($pos) 
			{
			  $pos1     = strpos($content, '<br /><b>*Extended Length');
			  $col_length   = substr($content, $pos, $pos1 - $pos);
			  $col_length      = str_replace('<b>*Collapsed Length (IN)</b>: ', "", $col_length);
			  $col_length      = str_replace('<br /><b>*Extended Length', "", $col_length);
			  $col_length       = trim(str_replace('<b>*Collapsed Length (IN)</b>: ', "", $col_length));
			  $col_length      = trim(str_replace('<br /><b>*Extended Length', "", $col_length));
			  $array_data[$item]['col_length'] = $col_length. " Collapsed"  ;
			}
		  else
			{
				$array_data[$item]['col_length'] = "Null"  ;
			}
			
		//Extended#
		  $pos      = strpos($content, '<b>*Extended Length (IN)</b>: ');
		  if($pos) 
			{
			  $pos1     = strpos($content, '<br /><b>*Collapsed Length (MM)');
			  $ext_length   = substr($content, $pos, 35);
			  $ext_length      = str_replace('<b>*Extended Length (IN)</b>: ', "", $ext_length);
			  $ext_length      = str_replace('<br /><b>*Collapsed Length (MM)', "", $ext_length);
			  $ext_length       = trim(str_replace('<b>*Extended Length (IN)</b>: ', "", $ext_length));
			  $ext_length      = trim(str_replace('<br /><b>*Collapsed Length (MM)', "", $ext_length));
			  $array_data[$item]['ext_length'] = $ext_length. " Extended"  ;
			}
		  else
			{
				$array_data[$item]['ext_length'] = "Null"  ;
			}
			
		//Compresion#
		  $pos      = strpos($content, '<b>*Compression @');
		  if($pos) 
			{
			  $pos1     = strpos($content, '<br /><b>*Rebound @');
			  $ext_compresh   = substr($content, $pos, $pos1 - $pos);
			  $ext_compresh      = str_replace('<b>*Compression @', "", $ext_compresh);
			  $ext_compresh      = str_replace('<br /><b>*Rebound @', "", $ext_compresh);
			  $ext_compresh      = str_replace('</b>', "", $ext_compresh);
			  $ext_compresh       = trim(str_replace('<b>*Compression @', "", $ext_compresh));
			  $ext_compresh      = trim(str_replace('<br /><b>*Rebound @', "", $ext_compresh));
			  $array_data[$item]['ext_compresh'] = "Compression: ".$ext_compresh ;
			}
		  else
			{
				$array_data[$item]['ext_compresh'] = "Null"  ;
			}	
			
		//Rebound#
		  $pos      = strpos($content, '<br /><b>*Rebound @');
		  if($pos) 
			{
			  $pos1     = strpos($content, '<br /><b>*Rebound @');
			  $ext_rebound   =  substr($content, $pos, 40);
			  $ext_rebound      = str_replace('<br /><b>*Rebound @', "", $ext_rebound);
			  $ext_rebound      = str_replace('<br /><b>*Rebound @', "", $ext_rebound);
			  $ext_rebound      = str_replace('</b>', "", $ext_rebound);
			  $ext_rebound       = trim(str_replace('<b>*Compression @', "", $ext_rebound));
			  $ext_rebound      = trim(str_replace('<br /><b>*Rebound @', "", $ext_rebound));
			  $array_data[$item]['ext_rebound'] = "Rebound: ".$ext_rebound ;
			}
		  else
			{
				$array_data[$item]['ext_rebound'] = "Null"  ;
			}	

		  $pos      = strpos($content, '<div style="clear: both"></div>');
		  $pos1     = strpos($content, '<br /><br />
		<div class="noprint">');
		  $descrip   = substr($content, $pos, $pos1 - $pos);
		  $descrip      = str_replace('<div style="clear: both"></div>
		<p>', "", $descrip);
		  $descrip      = str_replace('<br /><br />', "", $descrip);
		  $descrip       = trim(str_replace('<div style="clear: both"></div><p>', "", $descrip));
		  $descrip      = trim(str_replace('<br /><br /><div class="noprint">', "", $descrip));
		  $array_data[$item]['descrip'] = $descrip  ;

		  $this->InsertDB($array_data[$item]);

		}
		return $array_data;
	}
 
	private function array2csv(array &$array, $titles) {
	 if (count($array) == 0) {
	 return null;
	 }
	 $df = fopen($this->request->server->get('DOCUMENT_ROOT').'file.csv', 'w');
	 #fputcsv($df, ';');
	 foreach ($array as $row) {
	 fputcsv($df, $row, ';');
	 }
	 fclose($df);
	 return ob_get_clean();
	}


	private function InsertDB($data){
		if(!empty($data['number']) && !empty($data['old_number']) && !empty($data['descrip']) ){
			$this->ParsersModel->AddItems($data,$this->id);
		}
	}

	private function login($url,$data,$attr){
	   $ch = curl_init();
	   
	   if(strtolower((substr($url,0,5))=='https')) { // если соединяемся с https
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	   }
	   curl_setopt($ch, CURLOPT_URL, $url);
	   // откуда пришли на эту страницу
	   curl_setopt($ch, CURLOPT_REFERER, $url);
	   // cURL будет выводить подробные сообщения о всех производимых действиях
	   curl_setopt($ch, CURLOPT_VERBOSE, 1);
	   curl_setopt($ch, CURLOPT_HTTPHEADER, $attr);
	   curl_setopt($ch, CURLOPT_POST, 1);
	   curl_setopt($ch, CURLOPT_TIMEOUT , 1);
	   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	   curl_setopt($ch, CURLOPT_POSTFIELDS,implode("&" , $data));
	   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0");
	   curl_setopt($ch, CURLOPT_HEADER, 1);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   //сохранять полученные COOKIE в файл
	   curl_setopt($ch, CURLOPT_COOKIEJAR, '');
	   curl_setopt($ch, CURLOPT_COOKIEFILE, '');

	   $result=curl_exec($ch);

	   curl_close($ch);

	   return $result;
	}

	 private function fileGetContentz($url){
		sleep(1);
	    $settings = array(
	            CURLOPT_RETURNTRANSFER => true,
	            // CURLOPT_FOLLOWLOCATION => true,
	            //CURLOPT_MAXREDIRS      => 4,
	            CURLOPT_HEADER         => false,
	            CURLOPT_TIMEOUT        => 1,
	            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0',
	            #CURLOPT_COOKIEJAR => '/logs/cookie'.$this->tubeRn.'.tmp'
	    );

	    $socket = curl_init($url);
	    curl_setopt_array($socket, $settings);
	    $a = curl_exec($socket);

	    return $a;
	    
	}

	private function between($start, $end, $content)
	{

		preg_match_all('~' . $start . '(.*?)' . $end . '~is', $content, $result);

		return $result[1];

	}

}
