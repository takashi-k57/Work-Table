<?php
namespace App;

use DateTime;

class dayIterator implements \Iterator {
    public $day;
    public $first_day;
    public $last_day;
    public $syukujitsus;
    public $is_holiday;

    public function __construct() {
        $now = new \DateTime(); 
        $this->first_day = new \DateTime($now->format('y-m-01')); 
        $this->last_day = new \DateTime($now->format('y-m-t')); 
        $this->day = clone $this->first_day;
        foreach ( file( resource_path('csv/syukujitsu.csv') ) as $syukujitsu ) {
            $this->syukujitsus[] = new DateTime($syukujitsu);
        }
    }

    public function rewind() {
        $this->day = clone $this->first_day;
    }

    public function current() {
        return $this;
    }

    public function key() {
    }

    public function next() {
        $this->day->add(new \DateInterval('P1D'));

        // 祝日でも日曜日でもなければfalse
        $this->is_holiday = false;
        // 祝日の判定
        foreach($this->syukujitsus as $syukujitsu) {
            if($this->day == $syukujitsu) {
                $this->is_holiday = true;        
            }
        }
        // 日曜日の判定
        if($this->day->format('D') == 'Sun') {
            $this->is_holiday = true;        
        }
    }

    public function valid() {
        return $this->day->format('m') == $this->last_day->format('m');
    }
}
