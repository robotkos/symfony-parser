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
//����������� �������� ������������ � ���� ��������
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


}
?>