<?php
namespace Robot\ParserBundle\Model;
use Doctrine\ORM\EntityManager;

class Parsers
{
    protected $em;
    
    public function __construct(EntityManager $em)
    {
        $this->_em = $em;
    }

   	public function GetActiveStatus($id)
    {
        $sql = "SELECT `status` FROM `parsers` WHERE `id` = :id ";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->bindValue('id',$id);
        $query->execute();
        $row = $query->fetchColumn();
        return $row;
    }

   	public function GetParts($id)
    {
        $sql = "SELECT * FROM `parsers` WHERE `id` = :id ";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->bindValue('id',$id);
        $query->execute();
        $rows = $query->fetchAll();
        return $rows[0];
    }

    public function AddItems($data,$parser_id){ 

		$sql = "INSERT INTO `items` (`parser_id`,`pn`, `old_pn`, `descr`,`includes`,`notes`,`img`) VALUES (:parser_id, :number, :old_number, :descrip, :includes, :notes,:img)";
		$query = $this->_em->getConnection()->prepare($sql);
		$query->bindValue('parser_id', $parser_id);
		$query->bindValue('number', $data['number']);
		$query->bindValue('old_number', $data['old_number']);
		$query->bindValue('descrip',$data['descrip']);
        $query->bindValue('includes',$data['includes']);
        $query->bindValue('notes',$data['notes']);
		$query->bindValue('img', '');
		$query->execute();
        return true;
    }
//вытаскивает названия существующих в базе столбцов
    public function GetRows()
    {
        $sql = "SHOW COLUMNS FROM `items` ";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll();
        return $rows;
    }

    public function AddNewRows($addarr)
    {
        $sql = "ALTER TABLE `items` ADD "."$addarr"." TEXT";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute();
        return true;
    }

    public function AddBoschItems($item,$data1,$data2,$parser_id){

        /*$sql = "INSERT INTO `items` (`parser_id`,"."`$data1`".") VALUES (:parser_id, "."`$data2`".")";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->bindValue('parser_id', $parser_id, \PDO::PARAM_INT);
        //$query->bindValue('parser_id', $parser_id);
        $query->bindValue($data1, $data2);
        $query->execute();
        return true;*/

        $sql = "INSERT INTO items (parser_id,`pn`, `"."$data1"."`) VALUES (:parser_id, :pn, $data2)";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->bindValue('parser_id', $parser_id);
        //$query->bindValue('data2', $data2);
        $query->bindValue('pn', $item);
        $query->execute();
        return true;
    }

    public function UpdateParser($parser_id){ 

		$sql = "UPDATE `parsers` SET `date_start` = NOW() WHERE `id` = :parser_id ";
		$query = $this->_em->getConnection()->prepare($sql);
		$query->bindValue('parser_id', $parser_id);
		$query->execute();
        return true;
    }

    public function DeleteItems($parser_id){ 

		$sql = "DELETE FROM `items` WHERE `parser_id` = :parser_id";
		$query = $this->_em->getConnection()->prepare($sql);
		$query->bindValue('parser_id', $parser_id);
		$query->execute();
        return true;
    }

    public function ExportDatabase () {
        $this->_em->getConnection()->prepare($sql);
        $DB_DBName = "databasename";         //MySQL Database Name
        $DB_TBLName = "tablename"; //MySQL Table Name
        $filename = "excelfilename";         //File Name
        /*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/
//create MySQL connection
        $sql = "Select * from $DB_TBLName";
        $Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database
        $Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());
//execute query
        $result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());
        $file_ending = "xls";
//header info for browser
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        /*******Start of Formatting for Excel*******/
//define separator (defines columns in excel & tabs in word)
        $sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
        for ($i = 0; $i < mysql_num_fields($result); $i++) {
            echo mysql_field_name($result,$i) . "\t";
        }
        print("\n");
//end of printing column names
//start while loop to get data
        while($row = mysql_fetch_row($result))
        {
            $schema_insert = "";
            for($j=0; $j<mysql_num_fields($result);$j++)
            {
                if(!isset($row[$j]))
                    $schema_insert .= "NULL".$sep;
                elseif ($row[$j] != "")
                    $schema_insert .= "$row[$j]".$sep;
                else
                    $schema_insert .= "".$sep;
            }
            $schema_insert = str_replace($sep."$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
        }
    }
}
?>