<?
class getList {
	protected $conn;
	protected $user = 'lancelam_lance';
	protected $pass = 'lambert';
	protected $dbname = 'lancelam_lancelamb';
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
}
?>