<?
class sortList {
	protected $conn;
	protected $user = 'root';
	protected $pass = 'root';
	protected $dbname = 'lancelambert';
	protected $host = 'localhost';
 
	public function __construct() {
		$this->conn = mysql_connect($this->host, $this->user, $this->pass);
		mysql_select_db($this->dbname,$this->conn);
	}
 
	public function getList() {
		$sql = "SELECT * FROM subSections ORDER BY orderid";
		$recordSet = mysql_query($sql,$this->conn);
		$results = array();
		while($row = mysql_fetch_assoc($recordSet)) {
			$results[] = $row;
		}
		return $results;
	}
 
	public function updateList($orderArray) {
		$orderid = 1;
		foreach($orderArray as $catid) {
			$catid = (int) $catid;
			$sql = "UPDATE subSections SET orderid={$orderid} WHERE catid={$catid}";
			$recordSet = mysql_query($sql,$this->conn);
			$orderid++;
		}
	}
}
?>