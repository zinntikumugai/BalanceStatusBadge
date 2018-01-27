<?php

class StaticBadge {
    const BASEURL = 'https://img.shields.io/badge/';
    private $subject = null;
    private $status = null;
    private $color = null;
    private $out = null;
    private $ops = [];

    function __construct($sub = 'subject', $sta = 'stats', $col = 'red', $out = 'svg', $ops = []) {
        $this->subject = urlencode($sub);
        $this->status = urlencode($sta);
        $this->color = $col;
        $this->out = '.' .$out;
    }

    public function get() {
        return self::BASEURL .$this->subject .'-' .$this->status .'-' .$this->color .$this->out .($this->ops!==[] ? '?' .http_build_query($this->ops):'');
    }

    public static function sget($sub = 'subject', $sta = 'stats', $col = 'red', $out = 'svg', $ops = []) {
        return self::BASEURL .$sub .'-' .$sta .'-' .$col .'.' .$out .($ops!==[] ? '?' .http_build_query($ops):'');
    }
}

?>
