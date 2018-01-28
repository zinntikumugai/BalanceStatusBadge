# BalanceStatusBadge
[SHIELDS-GITHUB-LICENS]: https://img.shields.io/github/license/zinntikumugai/BalanceStatusBadge.svg
[SHIELDS-GITHUB-LANGUAGE]: https://img.shields.io/github/languages/top/zinntikumugai/BalanceStatusBadge.svg
[WEBSITE-STATUS-BSBZINNTIKUMUGAI]: https://img.shields.io/website-up-down-green-red/http/bsb.bitzeny.zinntikumugai.xyz.svg?label=status
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
[API-MLBE]: http://namuyan.dip.jp/MultiLightBlockExplorer/
<!-- end of link references field -->

![SHIELDS-GITHUB-LICENS]
![SHIELDS-GITHUB-LANGUAGE]

![BSB-ZNY-BALANCE]
![BSB-MONA-BALANCE]
![BSB-KUMA-BALANCE]

暗号通貨の**アドレスの残高**などを表示できるバッジです  

# 何ができるの？
- 暗号通貨のアドレスから残高など求められます
    - アドレス
    - 残高
    - 入金額
    - 出金額
    - トランザクション数
- (一部)ロゴを含めることができます
- (おまけ)MarkDownなどでURIリンクを使えるようにします(かなり強引ですが)

# 対応状況
| アイコン | 意味 |
|----|----|
| ✔ | 動作確認OK |
| ❕ | 動きますが確認していません、まだ非対応なところがあります(アイコン等) |
| ✋ | 今後対応予定 |
| ✘ | 技術的に難しいです |


| 状況 | 通貨 | 値 | API |
|-----|------|----|-----|
| ✔ | BitZeny | zeny | [MultiLightBlockExplorer][API-MLBE] |
| ✔ | KumaCoin | kuma | [MultiLightBlockExplorer][API-MLBE] |
| ✔ | MonaCoin | mona | [MultiLightBlockExplorer][API-MLBE] |
| ❕ | SHA1coin | sha1 | [MultiLightBlockExplorer][API-MLBE] |
| ❕ | Sayacoin | saya | [MultiLightBlockExplorer][API-MLBE] |
| ❕ | Espar2 | esp2 | [MultiLightBlockExplorer][API-MLBE] |
| ❕ | Ringo | ringo | [MultiLightBlockExplorer][API-MLBE] |
| ❕ | Fujicoin | fuji | [MultiLightBlockExplorer][API-MLBE] |
| ✋ | BitCoin | btc | - |
| ✋ | NEM | xem | - |

# 使い方
[詳しくはExampleを参考してください](Example.md)

## サーバー
`hostname` の項目を以下のサーバーのいずれかに変更してください

| hostname | status | Region |
|----|----|-----|
| bsb.bitzeny.zinntikumugai.xyz |  ![WEBSITE-STATUS-BSBZINNTIKUMUGAI] | 人畜無害 |

## アイコン作成
```
hostname/API.php?data=対応通貨/アドレス/アイコンバージョン(v0で非表示)/(右側の)色/[左側の内容]/[右側の表示内容]/[オプション]
```

## URIアドレス生成
```
hostname/API.php?url=通貨:アドレス
hostname/API.php?url=bitzeny:ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb
hostname/API.php?url=monacoin:MAmh5GUAYDJkfUSDBsPuEXQwfgXFp4btTe
hostname/API.php?url=kumacoin:KEK3zkYT1jkf2f8K9XE6SDpFoi8JJZgcPc
```

# ライセンス/License
MIT

# 寄付/Donation

- _BitZeny_
    `ZjiBu815mTSv9LnWzHUn25ErkSS7kGRLyb`
    [![BSB-ZNY-BALANCE]][BSB-ZNY-LINK]
- _MonaCoin_
    `MAmh5GUAYDJkfUSDBsPuEXQwfgXFp4btTe`
    [![BSB-MONA-BALANCE]][BSB-MONA-LINK]
- _KumaCoin_
    `KEK3zkYT1jkf2f8K9XE6SDpFoi8JJZgcPc`
    [![BSB-KUMA-BALANCE]][BSB-KUMA-LINK]
- _BitCoin_
    `1BKp366eUeSmbNqvcZitY7sJrBsRBmNEbU`

~~暗号通貨より日本円(JPY)が欲しい現実~~
