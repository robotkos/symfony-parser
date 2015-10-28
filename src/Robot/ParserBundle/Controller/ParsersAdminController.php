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

	public function ImportimgAction(Request $request) {
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
				$this->Bilsteinus_imgs($items);
				break;
		}

		return new RedirectResponse($this->admin->generateUrl('list'));
	}
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
			case 2:
				$this->Rockkrawler($items);
				break;
			case 3:
				$this->Bosch($items);
				break;
		}

		return new RedirectResponse($this->admin->generateUrl('list'));
	}

	private function Bilsteinus($items){

		foreach ($items as $key => $item) {
			$active = $this->ParsersModel->GetActiveStatus($this->id);
			if($active == 0 ) return new RedirectResponse($this->admin->generateUrl('list'));
 			$old_number = "";

			$content = $this->fileGetContents("http://cart.bilsteinus.com/product/".$item);

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

		//Descript
		  $pos      = strpos($content, '<div style="clear: both"></div>');
		  $pos1     = strpos($content, '<div class="noprint">');
		  $descrip   = substr($content, $pos, $pos1 - $pos);
		  $descrip      = str_replace('<div style="clear: both"></div>', "", $descrip);
			$descrip      = str_replace('<p>', "", $descrip);
		  $descrip      = str_replace('<div class="noprint">', "", $descrip);
			$descrip      = str_replace('<br /><br />', "", $descrip);
		  $descrip       = trim(str_replace('<div style="clear: both"></div><p>', "", $descrip));
		  $descrip      = trim(str_replace('<br /><br /><div class="noprint">', "", $descrip));
		  $array_data[$item]['descrip'] = $descrip  ;

			$array_data[$item]['includes'] = "Null"  ;
			$array_data[$item]['notes'] = "Null"  ;

		  $this->InsertDB($array_data[$item]);

		}
		return $array_data;
	}
// Bilstein Image Parser
	private function Bilsteinus_imgs($items){

		$active = $this->ParsersModel->GetActiveStatus($this->id);
		if($active == 0 ) return new RedirectResponse($this->admin->generateUrl('list'));

		$ftp_server="robotk00.ftp.ukraine.com.ua";
		$ftp_user_name="robotk00_test";
		$ftp_user_pass="ilmpvma1";

		$array_data = array();
		foreach ($items as $key => $item) {

			$file = "http://cart.bilsteinus.com/images/products/".$item."_1.jpg";

			$remote_file  = $item."_1.jpg";
			// set up basic connection
			$conn_id = ftp_connect($ftp_server);

			// login with username and password
			$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

			// upload a file
			ftp_put($conn_id, $remote_file, $file, FTP_ASCII);
			// close the connection

		}

		ftp_close($conn_id);

	}

	private function Bosch($items)
	{
		$objs = array();
		$obj = array();
		$value = array();
		$aobj = array();
		foreach ($items as $key => $item) {
			$active = $this->ParsersModel->GetActiveStatus($this->id);
			if ($active == 0) return new RedirectResponse($this->admin->generateUrl('list'));

			$content = $this->fileGetContents("http://ws12-mtp.boschwebservices.com/RB.EPDS/EPDSProductRetrieveService_REST.svc/Product/GetByPartNumber/BoschAutoParts/" . $item . "?RegisterKey=EN&RegisterType=US&apiKey=B000BEC2-7C47-42C2-AE28-F93C0BE0AEF0&callback=angular.callbacks._1");
			$content = str_replace('angular.callbacks._1(', "", $content);
			$content = str_replace(');', "", $content);
			// Преобразовуем JSON в array
			$objs = json_decode($content, true);
			//print_r($objs);
			//die();
			// Вытаскиваем элементы массива

			//foreach ($objs as $sKey => $obj) {
				//print_r($objs);
				//echo "<p>";
				//$value = $sKey["Value"];
				//echo '<dl style="margin-bottom: 1em;">';

				foreach ($objs['Value']['Attributes'] as $innerKey => $sobj) {
					//print_r($sobj);
					//echo "<p>";
					//Очищаем массив от пустых значений
					/*$obarray = array_diff($sobj, array(''));
					print_r($obarray);
					echo "<p>";*/

					$rows = $this->ParsersModel->GetRows();
					print_r($rows);
					echo "<p>";
					//echo "<dt>$key</dt><dd>$value</dd>";
				}
				//die();
				//echo '</dl>';
			//}
			//print_r($objs["Value"]["Attributes"]);
			die();

			$this->InsertDB($array_data[$item]);
		}
	}


	private function Rockkrawler($items){

		foreach ($items as $key => $item) {
			$active = $this->ParsersModel->GetActiveStatus($this->id);
			if($active == 0 ) return new RedirectResponse($this->admin->generateUrl('list'));
			$content = $this->fileGetContents("http://www.rockkrawler.com/ProductDetails.asp?ProductCode=".$item);
			print_r($content);
			die();
			//Part#
			$pos      = strpos($content, '<span class="product_code">');
			if($pos)
			{
				$part_number   = substr($content, $pos, 50);
				$pos2      = strpos($part_number, '<span class="product_code">');
				$pos3     = strpos($part_number, '</span');
				$part_number   = substr($content, $pos, $pos3 - $pos2);
				$part_number      = str_replace('<span class="product_code">', "", $part_number);
				$part_number      = str_replace('</span', "", $part_number);
				$part_number      = trim(str_replace('<span class="product_code">', "", $part_number));
				$part_number      = trim(str_replace('</span', "", $part_number));
				$array_data[$item]['number'] = $part_number ;

				//Includes#
				$pos      = strpos($content, 'Includes:');
				if($pos)
				{
					$pos1     = strpos($content, '<br /><br /><br />');
					if($pos1)
					{
						$includes   = substr($content, $pos, $pos1 - $pos);
						$includes      = str_replace('Includes:', "", $includes);
						$includes      = str_replace('<div style="height: 15px;">', "", $includes);
						$includes      = str_replace('<br />', " / ", $includes);
						$includes      = str_replace('/ </span>', "", $includes);
						$includes      = str_replace('  ', " ", $includes);
						//$includes      = str_replace('</span>', "", $includes);
						$includes      = trim(str_replace('Includes:', "", $includes));
						$includes      = trim(str_replace('<div style="height: 15px;">', "", $includes));
						$includes      = trim(str_replace('<br />', "", $includes));
						$includes      = trim(str_replace('/ </span>', "", $includes));
						$includes      = trim($includes);
						//$includes      = trim(str_replace('</span>', "", $includes));
						//$part_number      = trim(str_replace('<br />', "", $part_number));

					}
					else
					{
						$pos1     = strpos($content, '<div style="height: 15px;">');
						$includes   = substr($content, $pos, $pos1 - $pos);
						$includes      = str_replace('Includes:</span><br />', "", $includes);
						$includes      = str_replace('<div style="height: 15px;">', "", $includes);
						$includes      = str_replace('<br />', " / ", $includes);
						$includes      = str_replace('/ </span>', " / ", $includes);
						$includes      = str_replace('/ </span>', "", $includes);
						$includes      = str_replace('  ', " ", $includes);
						//$includes      = str_replace('</span>', "", $includes);
						$includes      = trim(str_replace('Includes:', "", $includes));
						$includes      = trim(str_replace('<div style="height: 15px;">', "", $includes));
						$includes      = trim(str_replace('<br />', "", $includes));
						$includes      = trim(str_replace('<div style="height: 15px;">', "", $includes));
						$includes      = trim(str_replace('/ </span>', "", $includes));
						$includes      = trim(str_replace('/ </span>', "", $includes));
						$includes      = trim($includes);
						//$includes      = trim(str_replace('</span>', "", $includes));
					}
					$array_data[$item]['includes'] = $includes ;
				}
				else{
					$array_data[$item]['includes'] = "Null" ;
				}



				//Notes#
				$pos      = strpos($content, '<b>NOTES!</b><br />');
				if($pos) {
					$pos1     = strpos($content, 'Share your knowledge of this product');
					$notes   = substr($content, $pos, $pos1 - $pos);
					$pos2      = strpos($notes, '<b>NOTES!</b><br />');
					$pos3     = strpos($notes, '<td width="1" background');
					$notes   = substr($notes, 0, $pos3);
					/*$pos4      = strpos($notes, '<b>NOTES!</b><br />');
                    $pos5     = strpos($notes, '</table>');
                    $notes   = substr($notes, $pos, $pos5 - $pos4);*/
					$notes      = str_replace('<b>NOTES!</b><br />', "", $notes);
					$notes      = str_replace('</table>', "", $notes);
					$notes      = str_replace('</tr>', "", $notes);
					$notes      = str_replace('</td>', "", $notes);
					$notes      = str_replace('<br />', " / ", $notes);
					$notes      = trim(str_replace('<br />', "", $notes));
					$notes      = trim(str_replace('</td>', "", $notes));
					$notes      = trim(str_replace('</table>', "", $notes));
					$notes      = trim(str_replace('</tr>', "", $notes));
					$array_data[$item]['notes'] = $notes ;
				}

				else
				{
					$array_data[$item]['notes'] = "Null" ;
				}
				$array_data[$item]['old_number'] = "Null"  ;
				$array_data[$item]['descrip'] = "Null"  ;
				print_r($array_data);
				die();
				$this->InsertDB($array_data[$item]);
			}
			else
			{
				$array_data[$item]['number'] = "Null" ;
			}

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

		if(!empty($data['number']) && !empty($data['old_number']) ){

			$this->ParsersModel->AddBoschItems($data,$this->id);
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
	   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6 (.NET CLR 3.5.30729)");
	   curl_setopt($ch, CURLOPT_HEADER, 1);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   //сохранять полученные COOKIE в файл
	   curl_setopt($ch, CURLOPT_COOKIEJAR, '');
	   curl_setopt($ch, CURLOPT_COOKIEFILE, '');

	   $result=curl_exec($ch);

	   curl_close($ch);

	   return $result;
	}

		 private function fileGetContents($url){
			 sleep(1);
			 $settings = array(
				 CURLOPT_RETURNTRANSFER => true,
				 // CURLOPT_FOLLOWLOCATION => true,
				 //CURLOPT_MAXREDIRS      => 4,
				 CURLOPT_HEADER         => false,
				 CURLOPT_TIMEOUT        => 1,
				 CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0',
				 //CURLOPT_FOLLOWLOCATION        => true,
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
