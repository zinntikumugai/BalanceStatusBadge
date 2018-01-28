<?php

require_once __DIR__ .'/../lib/MultiLightBlockExplorerAPI.php';
require_once __DIR__ .'/StaticBadge.php';
require_once __DIR__ .'/MBSDB.php';
require_once __DIR__ .'/../config.php';

use zinntikumugai\MultiLightBlockExplorerAPI\MultiLightBlockExplorerAPI;
/*
api.php?data=通貨/アドレス/アイコン/右側の色/左の文字/右に表示する値/右に表示する値のオプション
api.php?data=zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/寄付/balance
[(Z)寄付][390 ZNY]
api.php?data=zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/寄附金額/balance
[(Z)寄付金額][390 ZNY]

//アイコンなし
api.php?data=zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v0/blue/BitZeny/balance
[BitZeny][390 ZNY]

//残高
api.php?data=zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/balance
[(Z)BitZeny][14595.5768801 ZNY]
//小数点以下(四捨五入)
api.php?data=zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/balance/3
[(Z)BitZeny][14595.576 ZNY]
//受取額
api.php?data=zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/totalReceived
[(Z)BitZeny][19967.88241312 ZNY]
//出金額
api.php?data=zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZenyOUT/totalSent
[(Z)BitZeny][5372.30553302 ZNY]
//トランザクション数
api.php?data=zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/transaction
[(Z)BitZeny][7]
api.php?data=zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/transaction/transaction
[(Z)BitZeny][7 transaction]

*/
class MBSAPI {

    const PARAMETERMISS = 0x1000;
    const PARAMETERKNOW = 0x1001;

    private $inData = '';

    private $coinName = null;
    private $color = null;
    private $address = null;
    private $rightStr = null;
    private $leftStr = null;
    private $logo = null;

    private $prms = [];
    private $outData = [];

    function __construct($data) {
        $this->create($data);
        //return json_encode($this->outData);
    }

    public function get() {
        return json_encode($this->outData);
    }

    public function testview() {
        return '[' .$this->getLogo(true) .$this->leftStr .'][' .$this->rightStr .']';
    }

    private function create($data = null) {
        if($data === null) {
            setErrors(self::PARAMETERMISS);
            return;
        }

        $this->inData = $data;
        $this->prms = explode('/', $data);
        if(count($this->prms) <= 5) {
            echo count($this->prms);
            $this->setErrors(self::PARAMETERKNOW);
            return;
        }

        $this->coinName = $this->prms[0];
        $this->address = $this->prms[1];
        $this->logo = $this->prms[2];
        $this->color = $this->prms[3];
        $this->leftStr = $this->prms[4];
        if(isset($this->prms[6]))
            $this->rightStr = $this->getRightStr($this->prms[5], $this->prms[6]);
        else
            $this->rightStr = $this->getRightStr($this->prms[5]);

        $SB = StaticBadge::sget(
            $this->leftStr,
            $this->rightStr,
            $this->color,
            'svg', [
                'logo' => $this->getLogo()
            ]
        );

        $this->outData['status'] = 'success';
        $this->outData['data'] = $SB;
    }

    private function getCoinStr($coin) {
        $coins = [
            'mona' => 'MONA',
            'kuma' => 'KUMA',
            'zeny' => 'ZNY',
            'saya' => 'SYC',
            'sha1' => 'SHA',
            'ringo' => 'RIN',
            'esp2' => 'ESP',
            'fuji' => 'FJC',
            '1337' => '1337',
        ];
        if(isset($coins[$coin]))
            return $coins[$coin];
        else
            return null;
    }

    private function getLogo($d = false) {
        $logos = [
            'zeny' => [
                /* 50x50*/  'x1' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAMAAABHPGVmAAAAM1BMVEWlpaWmpqampqampqampqampqalpaWlpaWmpqb///+8vLzq6uqwsLD29vbc3NzS0tLHx8c+KuJWAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfiARoRGhLL7My2AAACNUlEQVRo3s3aSXKEMAwFUEKz+Ga+/2nT6SFxgmXpy0NFK6oYXskGG2SGwR43RDEN1QNCVANuyMbUMId6+cAcHQg3M4KMsXUarmTgjB4GoaAoehg2BWivAO0VoL0CtFeA9grQXgHaK0AHpQdyOSjwoSmogKi5VEDUBkMLBPpcG59/Srv/buZmZGQRee9j83xsbtodNuYQyDvnfCK/ldTu/XnuCiiJ5Awoj6HVyCMwIMgZhkTKEYuB/KBlM1QEGiKcthKJvJGJRaILL4/NXX9FBok8jcWYyCsVESnvdTdC9fobEXad4Sh9RCLFn4g4QJsRVGosB3LyjcUj0YV3eRa5IBNvzFwid8WbCGFwiKfXWSQ4E3Eg0eZeH/E2FoOs3sZikIvRAIkHKtJgEZdhRvy9bke2kkSsiGMWiZGxeWN9DcOte906n0QXXlshhY1FIx7DhJQmAkMlYqcSkT602cZaMwfPr3dkEuEaS/yYnyr2emL3qJeHogsfPkSvQYXoDc5kBPKj0fGIJA74UBHyEVly5aj8LLIxiQSyJEG/O6SOUMuP7Hjy8zKeLhNV6vVcIrmi2mWKt9wkQulOOukgHhG9nlo2MKYrcGo1lR0YTchQMIts6XKlWuK+GPIX6CGUbdVavb2x5NqwuuxgKCzfZ8FrLJoRKcEbuvGthHJEX9QqR/TludkfJqPPYmafZdk+C8x9lsr7LPp3+n2hz48YLuW//hzT6Tcfs/NR/l/U2DSJnj+RCRJx4ifBrPuB9E7GOQAAAABJRU5ErkJggg==',

                /* 50x50 デカすぎ 'x3' => ''*/
                /* 20x20 */ 'v1' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAM1BMVEWmpqampqampqampqalpaWmpqalpaWlpaWmpqb///+8vLzq6uqwsLD29vbc3NzS0tLHx8disYh4AAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfiARsNNAMH29gZAAAAWklEQVQY03XRSQ7AIAwDwBztS///3KI0i9W6PoA0rIGIJ8iEBhNDy4DR03NSiMRsq2+sEdb63avtqNjlkHij2CAtivXxfUVQ7jkTpaQ1Tu2kFv//dP6RP99xA0v6Ch/ljGUeAAAAAElFTkSuQmCC',
                /* x */ 'v2' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOBAMAAAGaYQB0AAAAHlBMVEX////MzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMw6yahhAAAACXRSTlMAQFCQoLDQ4PBnVUN0AAAAaElEQVQI1wXBIQ7CMBiA0W8Jpq51VCJxc8uOMDdF0nsQEo6A+0nXke+2vEdCdt48PqQgZQzOYA2SznisQS01mNxhVTisO/4MXAxGuWeSHdjUDtVbKe2L+loU7U+V5tVzG1xUnWFqjswfmY0oro8lrF8AAAAASUVORK5CYII=',
                /* 20x20*/  'v3' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH4gEbDi8BQqXM9gAABPNJREFUOMt1lH9IkwkYx7/v++6H07m9bq4sXTXYGOjKfBkEzsuCuNXEojBIo9ATC7O4K9DgoKDkkuQMFIT+sJ0cBCJE4R+RncFhIhLzIufyV9kGTZPhNm72+s7t3XN/HB0l3heeP58Pz8Pz8GGwRYhop9frdb9+/boiGAyWrK6uGmRZBs/zUb1eP71r166XJ0+e/KOiomJpcy+zCcT09PQ0vnjx4nwoFCr/9OkTp1arodfrkUqlEIvFsLa2Bp7n0zk5OeP79+/vHxwc/G2robCysqK9cOHCnfLyckmj0VBdXR319fWRz+ejcDhM4XCYhoeH6eHDh3TlyhXKzs4mQRDEa9eutRORevOKTGtr6x2Hw0EWi4W6u7spHo/TlywvL1NXVxd5PB66dOkSTUxM0N27d2nHjh1UWlpKZ8+ebf8GeODAgSZBECS73U79/f20vr5OREQbGxu0uLhIly9fJoZhCAABoKamJorH4+T1eonneRIEQXzw4EEDAODixYuFeXl5L10uFz158oREUSSv10ttbW1UW1tLdrv9P9DX1dnZSZlMhlpbWwkAnTlz5k8i2gmHw/GD0WhMd3d308bGBhER9fT0EM/zW4I0Gg0BoMOHD1M0GqWpqSmyWq1ktVpTHR0d57nc3NwfAZS5XC44nU5wHAen0wmtVguDwQBZlqFSqZBIJFBbW4v6+npIkoQ9e/aguroahYWFiEQiePbsGXv06NFVhSRJJfn5+dBqtVCpVAAAlmWRyWSgVCrhdrvx4cMH2Gw2XL9+HaWlpaipqQHHccjJyQEAVFdXY2BgAAzDODiVStVmtVoNR44cgc1m+/c5GQZGoxHT09MYGBhANBpFKBRCKpXCwYMHkclkYDAYwLIskskkCgsLIcsyioqKRIUkSUxubi5kWf7m8llZWdi+fTuuXr0Kj8eDd+/eYWZmBl6vF2tra2hpaYFer4fP54Narca5c+cgiiIUPM/HZFlGLBYDEWF8fBzv37/HmzdvMDQ0hG3btmF+fh7BYBCJRAKLi4s4deoUdDodAMBkMoFlWUQiEczNzcXYffv2BSRJwvz8PKLRKEZGRtDQ0IB79+4BAFpaWnDz5k0cOnQIr169QiQSQSQSQTKZBABYrVZoNBr4fD7EYrFpzuPxGP1+f9XU1BRbVFSEvXv34unTp/j8+TOKi4vR3t4Ok8kEp9OJYDAIv9+PhYUFWCwWlJWVIZVKYWJiAkNDQ+l4PN7LNjY2DpeUlEzodDqMjY0hPz8fbrcbADAzM4OFhQUAQHZ2Nurq6mAymZBOpzE3N4doNIpAIIDJyUksLy+Pi6L4nLt///7fx48fV4ii6A6FQlw6nUZVVRUYhkFBQQGqqqpgNBoBADabDZlMBuFwGBaLBUqlEqIoIhQKSSsrKx2Dg4OjHACMjo7+NTIyolUqla5AIICPHz+ipqYGzc3NMJvNX0sEZrMZLMtClmXY7XYsLS1hcnKy89GjR79+40Mi0t+6detntVr909jYmCqRSKCyshLHjh3D7t27sb6+jkAggMePH0OSJBQUFKC8vDw5OzvbdePGjV8YhhG3FOzt27ebtVptPc/zgt/v5xQKBQBAlmUkk0mIogi73S5nZWWNV1ZW/i4IQt//GvtLent7zadPn/7+7du3383Ozhb7/f48lmWh0+liHMcFBEEYPXHixHOGYcKbe/8B9BNpU6+7a1AAAAAASUVORK5CYII=',
            ],
            'kuma' => [

                /* 128x128  'x1' => '' */
                /* 20x20 */ 'v1' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH4gEbDTs21vAA9QAABFRJREFUOMttlU2IXuUdxX/P1/183/nIRKWLTjQJwrioVEswLYNQNCs3LlwJSmgJCO4EV0IREdy4EArSlUrbVRdFyCoEK2RRiEhpEpy2i4BKmEx15s773vfe+9z7fHXRBrHmfzb/szhn+TuC+9yl505v7z764AXt/C6D3QmT3XQ+YmNspiT2rDbXbi30ld9f/uKr/8+K77knMX/86cMXaz1/uVDFOTsEPbqIjxBiREnIZEIX2g9KXx/q2Ue/+vQvH/A57l6FuvecevrUxu8e23pzrurfSJ8/0tsoU15g6opyPmO2Nqea1WilySJyjfTjOsuffeHxn833YvfZwZcL+13hk5j3H9t6c13Vr3mXm1TVyDxjVmbMZGJNwbqGuRaUZQ5FjikrClXo9fnG+d2ds/oPh3/7lH2iBPjwJ9sXK1G+OrlMiNmMKGDZrVh1HYUEQyK6ET/0fHu8oB09zDfJth4ktq2ox/7Vj1965SKAuvTcj7Z35vVbKpaPpKom1xJhe+oiR2uFDYFumuh9xKJJeUVdVDBajIx4BHLZaJTaKs48dFX//NTJC6WX57pBMMs0VZjIZxVCADGQYkRpg8pLyCoiAvxImDp838Bsg6lfkefluV+eOX1B16ranQanZVWyUZcYm1AkYvCMIVJkOaqokDonpcg4rJBjT3ATMUbSNDIgcHf3tQppVybvdoYpYPKcInpkikTvOHCBvwfo8xqpc4KfOF42fN40fG0HfIj4mPDDwJgU7aojLQ93dLDDpo8ZWknSZEnBI5Rhluc8ICVGSpztCLZDTCNzAjoJAokEyJSIUhIBxm5Tj+NIJnOUABJgCnQ5Y1Mp5GCRfcuXXYePnoeE4GSCAkhCIJQiyzNMVGRKME0B7RPNXAsE4Mo5zeg5mUDanlW7oPOOfecJUqBTxEUoMgVKsUBwwhiETeRG0/rQSBvDnpERnGM0JXf6nn8vGvxqQR0cK+epQmTDR5YhsZYZijxnKSQHztMmEMFRFRljEnuyjfJaUsnraUD7ibXkaLoV1k2QEgIQ/1NpDBtlAVrSekeRBkxKZDj6EPy3Y7wmv+jFlUGK65nRSFOwuX4CkwJTSISYUEKglEIbQ51nIBPd2JNsw3o1QyZBDBPfWHf95vFwRd34V7N45qmH9dra1rOlLrUxGZXWiMmCEOTGELRGKEmtEn5scX3DbL5Jns2Jq4bDIdivLe/89vI/P1EAl+OdG88/ujOvtDwf24VAG4TJEEVJmWXMtCTDE4PFC4mpTyD1nNg1tGNM+0N67/Xbt95ln/hf2uwT/yHsZ784u621kk+o9kj3yyVHvWMVJTZKpqSIyWBUgQoB3y85stHuD7z3wUH79sFfF/19AfvnF399sVgev5xWq3Pt4aEOtkcJyLSiyA1aC5bj6JsxXL87qY/euH3ze4AV952AS89sP33m9IV86nZVe7SjhqNNPzkGH5pmcHtHU7x283i68qert38wAf8BFsZBvt9viK4AAAAASUVORK5CYII=',
            ],
            'mona' => [
                /* 14ｘ14*/  'v1' =>  'data:image/png;base64,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'
            ],
        ];
        if(isset($this->logo) && $this->logo === 'v0')
            return;
        if($d !== false)
            return '(' .substr(ucfirst($this->coinName),0,1) .')';
        else if(isset($logos[$this->coinName][$this->logo]))
            return $logos[$this->coinName][$this->logo];
            else
            return;

    }

    private function getRightStr($mode = null, $prm = null) {
        if($this->coinName === null || $this->address === null)
            return;

        $str = '';
        $MLBE = new MultiLightBlockExplorerAPI($this->coinName);

        switch ($mode) {
            //アドレス
            case 'address':
                $str .= $this->address;
                break;
            //残高
            case 'balance':
                $tmp = new MBSDB($this->address);
                if($tmp->check() === false)
                    $tmp->update($MLBE->getAddr($this->address));

                $data = $tmp->getData('balance');
                if(isset($prm))
                    $data = round($data, $prm);
                $str .= $data .' ' .$this->getCoinStr($this->coinName);
                break;

            //受取
            case 'totalReceived':
                $tmp = new MBSDB($this->address);
                if($tmp->check() === false)
                    $tmp->update($MLBE->getAddr($this->address));

                $data = $tmp->getData('total_received');
                if(isset($prm))
                    $data = round($data, $prm);
                $str .= $data .' ' .$this->getCoinStr($this->coinName);
                break;

            //出金
            case 'totalSent':
                $tmp = new MBSDB($this->address);
                if($tmp->check() === false)
                    $tmp->update($MLBE->getAddr($this->address));

                $data = $tmp->getData('total_sent');
                if(isset($prm))
                    $data = round($data, $prm);
                $str .= $data .' ' .$this->getCoinStr($this->coinName);
                break;

            //トランザクション
            case 'transaction':
                $tmp = new MBSDB($this->address);
                if($tmp->check() === false)
                    $tmp->update($MLBE->getAddr($this->address));

                $data = $tmp->getData('transactions');
                $str .= $data;
                if(isset($prm))
                    $str .= ' ' .$prm;
                break;

            default:
                $str = $mode;
                break;
        }
        return $str;
    }

    private function setErrors($ec) {
        $str = '';
        switch ($ec) {
            case self::PARAMETERMISS:
                $str = 'Paramat missing.';
                break;

            case self::PARAMETERKNOW:
                $str = 'パラメーターが足りません';
                break;

            default:
                $str = 'errer.';
                break;
        }
        $this->outData['status'] = 'error';
        $this->outData['message'] = $str;
    }
}


?>
