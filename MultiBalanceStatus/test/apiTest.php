<?php
require_once __DIR__ ."/../Model/MBSAPI.php";
$date1 = new DateTime();
$ms1 = microtime(true);
$datas = [

    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/寄付/balance',
    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/寄附金額/balance',
    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/balance',
    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/balance/3',

    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/totalReceived',
    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/totalReceived/3',
    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/totalSent',
    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/totalSent/2',
    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/transaction',
    'zeny/Zm5s2assk5YPRX5DB2QYGGpiB4PsDFa5z7/v1/blue/BitZeny/transaction/transaction',

    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/寄付/balance',
    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/寄附金額/balance',
    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/BitZeny/balance',
    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/BitZeny/balance/3',

    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/BitZeny/totalReceived',
    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/BitZeny/totalReceived/3',
    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/BitZeny/totalSent',
    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/BitZeny/totalSent/2',
    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/BitZeny/transaction',
    'zeny/ZjJrwjC51eeNMMEyBpinkXqQ8zxDQogZW8/v1/blue/BitZeny/transaction/transaction',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/寄付/balance',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/寄附金額/balance',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/BitZeny/balance',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/BitZeny/balance/3',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/BitZeny/totalReceived',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/BitZeny/totalReceived/3',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/BitZeny/totalSent',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/BitZeny/totalSent/2',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/BitZeny/transaction',
    'zeny/ZigzVrLu3LjnB1bMqQKJXmvPyKYZAcPESw/v1/blue/BitZeny/transaction/transaction',

    'mona/MDa3UuJBvADBigXsiTNgB3GU6ginf4tnJB/v0/yellowgreen/MonaCoin/balance',
    'mona/MDa3UuJBvADBigXsiTNgB3GU6ginf4tnJB/v1/yellowgreen/MonaCoin/balance',

];

$apires = [];
foreach ($datas as $key => $value) {
    $apires[$key] = new MBSAPI($value);
}

foreach ($apires as $key => $value) {
    echo $value->testview() .PHP_EOL;
}
$date2 = new DateTime();
$ms2 = microtime(true);
$mdiff = $ms2 - $ms1;
$diff = $date2->diff($date1);
echo $diff->s .'.' .substr(explode('.',$mdiff)[1],0,3) .'s'.PHP_EOL;
?>
