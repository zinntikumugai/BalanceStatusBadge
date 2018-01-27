<?php
    require_once __DIR__ .'/Model/StaticBadge.php';

    $logo = [
        'bitzeny-1' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAMAAABHPGVmAAAAM1BMVEWlpaWmpqampqampqampqampqalpaWlpaWmpqb///+8vLzq6uqwsLD29vbc3NzS0tLHx8c+KuJWAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfiARoRGhLL7My2AAACNUlEQVRo3s3aSXKEMAwFUEKz+Ga+/2nT6SFxgmXpy0NFK6oYXskGG2SGwR43RDEN1QNCVANuyMbUMId6+cAcHQg3M4KMsXUarmTgjB4GoaAoehg2BWivAO0VoL0CtFeA9grQXgHaK0AHpQdyOSjwoSmogKi5VEDUBkMLBPpcG59/Srv/buZmZGQRee9j83xsbtodNuYQyDvnfCK/ldTu/XnuCiiJ5Awoj6HVyCMwIMgZhkTKEYuB/KBlM1QEGiKcthKJvJGJRaILL4/NXX9FBok8jcWYyCsVESnvdTdC9fobEXad4Sh9RCLFn4g4QJsRVGosB3LyjcUj0YV3eRa5IBNvzFwid8WbCGFwiKfXWSQ4E3Eg0eZeH/E2FoOs3sZikIvRAIkHKtJgEZdhRvy9bke2kkSsiGMWiZGxeWN9DcOte906n0QXXlshhY1FIx7DhJQmAkMlYqcSkT602cZaMwfPr3dkEuEaS/yYnyr2emL3qJeHogsfPkSvQYXoDc5kBPKj0fGIJA74UBHyEVly5aj8LLIxiQSyJEG/O6SOUMuP7Hjy8zKeLhNV6vVcIrmi2mWKt9wkQulOOukgHhG9nlo2MKYrcGo1lR0YTchQMIts6XKlWuK+GPIX6CGUbdVavb2x5NqwuuxgKCzfZ8FrLJoRKcEbuvGthHJEX9QqR/TludkfJqPPYmafZdk+C8x9lsr7LPp3+n2hz48YLuW//hzT6Tcfs/NR/l/U2DSJnj+RCRJx4ifBrPuB9E7GOQAAAABJRU5ErkJggg==',
        'bitzeny-2' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOBAMAAAGaYQB0AAAAHlBMVEX////MzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMw6yahhAAAACXRSTlMAQFCQoLDQ4PBnVUN0AAAAaElEQVQI1wXBIQ7CMBiA0W8Jpq51VCJxc8uOMDdF0nsQEo6A+0nXke+2vEdCdt48PqQgZQzOYA2SznisQS01mNxhVTisO/4MXAxGuWeSHdjUDtVbKe2L+loU7U+V5tVzG1xUnWFqjswfmY0oro8lrF8AAAAASUVORK5CYII='
    ];

    function get($url) {
        $ch = curl_init();
        $ops = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
        );

        curl_setopt_array($ch, $ops);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    $url = "http://namuyan.dip.jp/MultiLightBlockExplorer/apis.php?data=zeny/api/addr/" .'ZiL2c3P5FvMfmzMraxoyt3fmqYMeHTBGmc' ."/balance";
    $vak = get($url);

    $SB = new StaticBadge('BitZeny', 39, 'blue', 'svg');
    $urls = [

        $SB->get(),
        StaticBadge::sget('BitZeny', 39, 'blue', 'svg'),
        StaticBadge::sget('BitZeny', 39, 'blue', 'svg', [
                                                        'logo' => $logo['bitzeny-2'],
                                                        'logoWidth'=>14
                                                    ]),
        StaticBadge::sget('Donation', 39, 'blue', 'svg', [
                                                        'logo' => $logo['bitzeny-1'],
                                                        'logoWidth'=>14
                                                    ]),
        StaticBadge::sget('寄付', 39, 'blue', 'svg', [
                                                        'logo' => $logo['bitzeny-1'],
                                                        'logoWidth'=>14
                                                    ]),
        StaticBadge::sget('Pool', $vak, 'green', 'svg', [
                                                    'logo' => $logo['bitzeny-1'],
                                                    //'logoWidth'=>14,
                                                    //'link' => 'bitzeny:ZiL2c3P5FvMfmzMraxoyt3fmqYMeHTBGmc'    //公開場所でやる話だこれ
                                                ]),
        StaticBadge::sget('BitZeny', 'Donation', 'lightgrey', 'svg', [
                                                    'logo' => $logo['bitzeny-1'],
                                                ]),
    ];
//    var_dump($urls);
    $data = "";
    foreach ($urls as $key => $value) {
        //$data .= "\n<br>" .get($value);
        $data .= <<<EOF
<pre>$value</pre>
<img src="$value">\n
EOF;
    }
    //echo $data;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php echo $data; ?>
    </body>
</html>
