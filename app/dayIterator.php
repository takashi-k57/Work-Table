<?php
namespace App;
class dayIterator implements \Iterator {
    private $day;
    private $first_day;
    private $last_day;

    public function __construct() {
        $now = new \DateTime(); 
        $this->first_day = new \DateTime($now->format('y-m-01')); 
        $this->last_day = new \DateTime($now->format('y-m-t')); 
        $this->day = clone $this->first_day;
    }

    public function rewind() {
        $this->day = clone $this->first_day;
    }

    public function current() {
        return $this->day;
    }

    public function key() {
    }

    public function next() {
        $this->day->add(new \DateInterval('P1D'));
    }

    public function valid() {
        return $this->day->format('m') == $this->last_day->format('m');
    }
}
