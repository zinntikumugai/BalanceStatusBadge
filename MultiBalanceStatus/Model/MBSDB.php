<?php

class MBSDB {
    private $DB = null;
    private $address = null;

    private $data = null;

    private $ndate = null;
    private $odate = null;


    function __construct($addr, $data = null) {
        global $config;

        $this->address = $addr;
        $this->ndate = new DateTime("", new DateTimeZone($config['timezone']));
    }

    public function getData($name) {
        return $this->data->$name;
    }

    private function conect() {
        global $config;

        $db = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['dbname']);
        if($db->connect_error) {
            echo 'DBError. ' .$db->connect_error;
            exit();
        }else {
            $db->set_charset("utf8");
        }
        $this->DB = $db;
    }

    private function disconnect() {
        $this->DB->close();
    }

/*
* true: 使えるデータ → $this->data
* false: 古いデータ
*/
    public function check() {
        global $config;

        $this->conect();
        $SQL = <<<EOF
SELECT * FROM `cache` WHERE EXISTS ( SELECT * FROM `cache` WHERE `cache`.`address` = "$this->address" ) AND `cache`.`address` = "$this->address"
EOF;
        if($res = $this->DB->query($SQL)) {
            //var_dump($SQL,$res);
            if($res->num_rows == 0) {
                $this->disconnect();
                return false;
            }

            $row = $res->fetch_assoc();

            $this->data = new DATA($row);
            $this->odata = $row['last_date'];

            $olddate = new DateTime($this->odata, new DateTimeZone($config['timezone']));
            $diff = $this->ndate->diff($olddate);

            if($diff->s >= $config['time']){
                $this->disconnect();
                return false;
            }
        }
        $this->disconnect();
        return true;
    }

/**
* data: /api/addr/
*/
    public function update($data) {
        global $config;
        $date = new DateTime('', new DateTimeZone($config['timezone']));
        $datestr = $date->format('Y-m-d H:i:s');

        $this->conect();
        $this->data = new DATA($data);

        $balance = $this->data->balance;
        $total_received = $this->data->total_received;
        $total_sent = $this->data->total_sent;
        $unconfirmed_balance = $this->data->unconfirmed_balance;
        $transactions = $this->data->transactions;

        $SQL = <<<EOF
INSERT INTO `cache` (`address`, `balance`, `total_received`, `total_sent`, `unconfirmed_balance`, `transactions`, `last_date`) VALUES
("$this->address", "$balance", "$total_received", "$total_sent", "$unconfirmed_balance", "$transactions", '$datestr')
 on duplicate key update balance="$balance", total_received="$total_received", total_sent="$total_sent", unconfirmed_balance="$unconfirmed_balance", transactions="$transactions", last_date="$datestr"
EOF;

        if($res = $this->DB->query($SQL)){
            //var_dump($SQL,$res,$this->DB->insert_id);
            echo "update".PHP_EOL;
        }
        $this->disconnect();

    }
}

class DATA {

    public $balance;
    public $total_received;
    public $total_sent;
    public $unconfirmed_balance;
    public $transactions;

    function __construct($arg){
    //気力失せた
        if(is_array($arg)) {
            $this->balance = $arg['balance'];
            $this->total_received = $arg['total_received'];
            $this->total_sent = $arg['total_sent'];
            $this->unconfirmed_balance = $arg['unconfirmed_balance'];
            $this->transactions = is_array($arg['transactions']) ? count($arg['transactions']):$arg['transactions'];
        }
        else {
            $this->balance = $arg->balance;
            $this->total_received = $arg->totalReceived;
            $this->total_sent = $arg->totalSent;
            $this->unconfirmed_balance = $arg->unconfirmedBalance;
            $this->transactions = is_array($arg->transactions) ? count($arg->transactions):$arg->transactions;
        }

    }
}



?>
