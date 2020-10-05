<?php
namespace App;

use DateTime;

class dayIterator implements \Iterator {
    public $day;
    public $first_day;
    public $last_day;
    public $public_holidays;
    public $is_sunday = false;
    public $is_public_holiday = false;
    public $option = "month";

    public function __construct($option = "month") {
        $now = new \DateTime(); 
        $this->first_day = new \DateTime($now->format('y-m-01'));
        $this->last_day = new \DateTime($now->format('y-m-t')); 
        
        $this->day = clone $this->first_day;
        foreach ( file( resource_path('csv/syukujitsu.csv') ) as $public_holiday ) {
            $this->public_holidays[] = new DateTime($public_holiday);
        }
        $this->option = $option;
    }

    public function rewind() {
        $this->day = clone $this->first_day;
        $this->is_sunday = false;
        $this->is_public_holiday = false;
    }

    public function current() {
        return $this;
    }

    public function key() {
    }

    public function next() {
        $this->day->add(new \DateInterval('P1D'));

        $this->is_public_holiday = false;
        $this->is_sunday = false;

        // 祝日の判定
        foreach($this->public_holidays as $public_holiday) {
            if($this->day == $public_holiday) {
                $this->is_public_holiday = true;        
            }
        }
        // 日曜日の判定
        if($this->day->format('D') == 'Sun') {
            $this->is_sunday = true;        
        }
    }

    public function valid() {
        if($this->option == "month") {
            return $this->day->format('m') == $this->last_day->format('m');
        } elseif($this->option == "year") {
            return $this->day->format('y') == $this->last_day->format('y');
        }
        
    }
}
