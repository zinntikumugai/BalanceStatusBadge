<?php

namespace zinntikumugai\MultiLightBlockExplorerAPI;

class MultiLightBlockExplorerAPI {
    private $APIURL = 'http://namuyan.dip.jp/MultiLightBlockExplorer/apis.php?data=';
    private $coin = '';

    function __construct($coin){
        $this->coin = $this->setCoin($coin);
    }

    public function getCoin() {
        return $this->coin;
    }

    private function setCoin($coinName) {
        $c = '';
        switch ($coinName) {
            case 'Monacoin':
            case 'MonaCoin':
            case 'mona':
                $c = 'mona';
                break;

            case 'Kumacoin':
            case 'KumaCoin':
            case 'kuma':
                $c = 'kuma';
                break;

            case 'Bitzeny':
            case 'BitZeny':
            case 'zeny':
                $c = 'zeny';
                break;

            case 'Sayacoin':
            case 'SayaCoin':
            case 'saya':
                $c = 'saya';
                break;

            case 'SHA1coin':
            case 'SHA1Coin':
            case 'sha1':
                $c = 'sha1';
                break;

            case '1337':
                $c = '1337';
                break;

            case 'Ringo':
            case 'ringo':
                $c = 'ringo';
                break;

            case 'Fujicoin':
            case 'FujiCoin':
            case 'fuji':
                $c = 'fuji';
                break;

            case 'Esper2':
            case 'esp2':
                $c = 'esp2';
                break;

            default:
                throw new Exception('Missing!!,not crypto');
                break;
        }
        return $c;
    }

    private function get($url, $ops = []) {
        $ch = curl_init();
        $ops = array_replace([
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false
        ], $ops);
        curl_setopt_array($ch, $ops);
        $data = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($data);
        return $data;
    }

    private function makeURL($action = '',$data = '') {
        $url = $this->APIURL .$this->coin .'/api/' .$action .($action==='' ? '':'/') .$data;
    //    echo $url .PHP_EOL;
        return $url;
    }

    public function getBlock($hash) {
        return $this->get($this->makeURL('block', $hash));
    }

    public function getBlockIndex($height) {
        return $this->get($this->makeURL('block-index', $height));
    }

    public function getTx($txid) {
        return $this->get($this->makeURL('tx', $txid));
    }

    public function getRawTx($rawTxid) {
        return $this->get($this->makeURL('rawtx', $rawTxid));
    }

    public function getAddrValidate($addr) {
        return $this->get($this->makeURL('addr-validate', $addr));
    }

    public function getAddr($addr) {
        return $this->get($this->makeURL('addr', $addr));
    }

    public function getAddrBalance($addr) {
        return $this->get($this->makeURL('addr', $addr .'/balance'));
    }

    public function getAddrTotalRecived($addr) {
        return $this->get($this->makeURL('addr', $addr .'/totalReceived'));
    }

    public function getAddrTotalSent($addr) {
        return $this->get($this->makeURL('addr', $addr .'/totalSent'));
    }

    public function getAddrUnconfirmedBalance($addr) {
        return $this->get($this->makeURL('addr', $addr .'/unconfirmedBalance'));
    }

    public function getAddrUtxo($addr) {
        /* API Missing?
        return $this->get($this->makeURL('addr', $addr .'/utxo'));
        */
        return $this->getAddrsUtxos([$addr]);
    }

    public function getAddrsUtxos($addr = []) {
        if($addr === []) {
            throw new Exception('Empty addrs!!');
            return;
        }
        $data = '';
        foreach ($addr as $key => $value) {
            $data .= $value .($key!==(count($addr)-1) ? ',':'');
        }
        return $this->get($this->makeURL('addrs', $data .'/utxo'));
    }

    public function getBlockTxid($hash) {
        return $this->get($this->makeURL('txs', '?block=' .$hash));
    }

    public function getAddrTxid($addr) {
        return $this->get($this->makeURL('txs', '?address=' .$addr));
    }

/* API Missing?
    public function getAddrTxids($addr) {
        return $this->get($this->makeURL('addrs', $addr .'txs'));
    }
*/

    public function getAPIGetInfo() {
        return $this->get($this->makeURL('', 'status?q=getInfo'));
    }

    public function getAPIGetBlockCount() {
        return $this->get($this->makeURL('', 'status?q=getBlockCount'));
    }

    public function getAPIGetDifficulty() {
        return $this->get($this->makeURL('', 'status?q=getDifficulty'));
    }

    public function getAPIStatus() {
        return array_merge(
            ['getAPIGetInfo' => $this->getAPIGetInfo()],
            ['getAPIGetBlockCount' => $this->getAPIGetBlockCount()],
            ['getAPIGetDifficulty' => $this->getAPIGetDifficulty()]
        );
    }

    public function getCoindSync() {
        return $this->get($this->makeURL('', 'sync'));
    }
}

?>
