<?PHP
error_reporting("E_ALL");
ini_set( 'display_errors' , 'On' );
ini_set('error_reporting', E_ALL);

date_default_timezone_set('Asia/Manila');

require_once('db_connect.php');


class EditInbound extends Database{

	public $id;
	public $customer;
	public $blading;
	public $receipt;
	public $pallet;
	public $quantity;
	public $desc;
	public $storage;
	public $inventory;
	public $exdate;
	public $endate;
	public $pickdate;
	public $datecreated;


		public function __construct(){

			parent::__construct();
			$this->populateData();
	}

		public function populateData(){

		if (isset($_POST['customer'])&& 
			isset($_POST['blading'])&& 
			isset($_POST['receipt'])&& 
			isset($_POST['pallet'])&& 
			isset($_POST['quantity'])&& 
			isset($_POST['desc'])&& 
			isset($_POST['storage'])&& 
			isset($_POST['inventory'])&& 
			isset($_POST['exdate'])&& 
			isset($_POST['endate'])&& 
			isset($_POST['id'])&& 
			isset($_POST['pickdate'])) {
			
				$this->customer = $_POST['customer'];
				$this->blading	= $_POST['blading'];
				$this->receipt  = $_POST['receipt'];
				$this->pallet   = $_POST['pallet'];
				$this->quantity = $_POST['quantity'];
				$this->desc     = $_POST['desc'];
				$this->storage  = $_POST['storage'];
				$this->inventory= $_POST['inventory'];
				$this->exdate 	= date("Y-m-d",strtotime($_POST['exdate']));
				$this->endate   = date("Y-m-d",strtotime($_POST['endate']));
				$this->pickdate = date("Y-m-d",strtotime($_POST['pickdate']));
				$this->datecreated = date("Y-m-d ");
				$this->id = $_POST['id'];


		}
	}

	public function editInbound(){

		$conn = $this->_connection;
		$query = "UPDATE `inbound` SET 
				`client`='{$this->customer}', 
				`bill_of_blading`='{$this->blading}',
				`delivery_receipt`='{$this->receipt}',
				`pallet_code`='{$this->pallet}',
				`quantity`='{$this->quantity}',
				`description`='{$this->desc}',
				`storage_type`='{$this->storage}',
				`inventory_type`='{$this->inventory}',
				`expiration_date`='{$this->exdate}',
				`entry_date`='{$this->endate}',
				`pick_date`='{$this->pickdate}' WHERE 
				`id`={$this->id}";

		if ($conn->query($query)) {
			return "Inbound Successfully Updated.";
		}else{
			return $query;
		}

	}
}


$EditInbound = new EditInbound();
echo $EditInbound->editInbound();


?>