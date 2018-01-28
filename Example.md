# BalanceStatusBadge Examples

[BSB-ZNY-BALANCE]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/v1/blue/balance/balance
[BSB-ZNY-ADDRESS]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/v1/blue/address/address
[BSB-ZNY-NOP]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/v1/blue//nop
[BSB-ZNY-TOTALRECEIVED]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/v1/blue/totalReceived/totalReceived
[BSB-ZNY-TOTALSENT]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/v1/blue/totalSent/totalSent
[BSB-ZNY-TRANSACTION]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/v1/blue/transaction/transaction
[BSB-MONA-BALANCE]:  http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=mona/MAmh5GUAYDJkfUSDBsPuEXQwfgXFp4btTe/v0/yellowgreen/balance/balance
[BSB-KUMA-BALANCE]:  http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=kuma/KEK3zkYT1jkf2f8K9XE6SDpFoi8JJZgcPc/v1/b8860b/balance/balance
[BSB-ZNY-LINK]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?url=bitzeny:ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb
[BSB-MONA-LINK]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?url=monacoin:MAmh5GUAYDJkfUSDBsPuEXQwfgXFp4btTe
[BSB-KUMA-LINK]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?url=kumacoin:KEK3zkYT1jkf2f8K9XE6SDpFoi8JJZgcPc

[BSB-ZNY-BALANCE-ICON-V0]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/v0/blue/balance/balance
[BSB-ZNY-BALANCE-ICON-V2]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/v2/blue/balance/balance
[BSB-ZNY-BALANCE-ICON-V3]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/v3/blue/balance/balance
[BSB-ZNY-BALANCE-ICON-X1]: http://bsb.bitzeny.zinntikumugai.xyz/API.php?data=zeny/ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb/x1/blue/balance/balance
# Example
![BSB-ZNY-BALANCE]
![BSB-MONA-BALANCE]
![BSB-KUMA-BALANCE]

## アイコン
各通貨のアイコンを表示できます。対応していないものは表示されません

| 設定値 | 備考 | 例 |
|:------|------|----:|
| v0 | 非表示 | ![BSB-ZNY-BALANCE-ICON-V0] |
| v1 | 一般的or初期 | ![BSB-ZNY-BALANCE] |
| v2 |  | ![BSB-ZNY-BALANCE-ICON-V2] |
| v3 |  | ![BSB-ZNY-BALANCE-ICON-V3] |
| v1 | 高解像度版 | ![BSB-ZNY-BALANCE-ICON-X1] |

__高解像度版は通常は無駄です__

### パラメータ

| パラメーター | 備考 | 例 |
|---|---|---|
| アイコンバージョン | v0で非表示 | v1 |
| 左側の内容 | ただのテキスト | 寄付 |

## 取得可能な値

| 設定値 | 内容 | オプション | 例 |
|:----|----:|----:|----:|
| address | アドレス | なし | ![BSB-ZNY-ADDRESS] |
| balance | 残高 | 小数点以下の桁数 | ![BSB-ZNY-BALANCE] |
| totalReceived | 合計入金額 | 小数点以下の桁数 | ![BSB-ZNY-TOTALRECEIVED] |
| totalSent | 合計送金額 | 小数点以下の桁数 | ![BSB-ZNY-TOTALSENT] |
| transaction | トランザクション数 | 単位 | ![BSB-ZNY-TRANSACTION] |

## 色
以下のものまたはカラーコード
- brightgreen
- green
- yellowgreen
- yellow
- orage
- red
- lightgrey
- blue

# アドレスURI生成
大抵のウォレットではURIで支払画面を呼び出せます  
Markdownなどでは使えないことが多い(リンクとして認識しない)ので強引にやっちまう機能です(内部的にもただリダイレクトしてるだけですし...)  
ウォレットで生成した場合などで金額も指定できるっぽいです(無保証)
```
hostname/API.php?url=通貨:アドレス
hostname/API.php?url=bitzeny:ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb
hostname/API.php?url=monacoin:MAmh5GUAYDJkfUSDBsPuEXQwfgXFp4btTe
hostname/API.php?url=kumacoin:KEK3zkYT1jkf2f8K9XE6SDpFoi8JJZgcPc
```
