<?php

class Pass {

	/**
	*	This class denoates a Boarding Pass.
	**/

	private $type;
	private $number;
	private $from;
	private $to;
	private $seat;
	private $gate;
	private $counter;


	
	public function getType () {
		return $this->type;
	}

	public function setType ($type) {
		$this->type = $type;
		return $this;
	}


	public function getNumber () {
		return $this->number;
	}

	public function setNumber ($number) {
		$this->number = $number;
		return $this;
	}


	public function getFrom () {
		return $this->from;
	}

	public function setFrom ($from) {
		$this->from = $from;
		return $this;
	}


	public function getTo () {
		return $this->to;
	}

	public function setTo ($to) {
		$this->to = $to;
		return $this;
	}

	
	public function getSeat () {
		return $this->seat;
	}

	public function setSeat ($seat) {
		$this->seat = $seat;
		return $this;
	}

	public function getGate () {
		return $this->gate;
	}

	public function setGate ($gate) {
		$this->gate = $gate;
		return $this;
	}


	public function getCounter () {
		return $this->counter;
	}

	public function setCounter ($counter) {
		$this->counter = (($counter == null)?false:$counter);
		return $this;
	}

	/**
	*	using magic function to print the object as string
	* 	@return output text based on the type of pass
	**/
	public function __toString () {
		if($this->getType() == "train") {
			return $this->trainText();
		} else if($this->getType() == "bus") {
			return $this->busText();
		} else {
			return $this->flightText();
		}
	}

	/**
	*	Formatting for the desired output text
	**/
	private function trainText () {
		return "Take " . $this->getType() . " " . $this->getNumber() . " from " . $this->getFrom() . " to " . $this->getTo() . ". Sit in seat " . $this->getSeat();
	}

	/**
	*	Formatting for the desired output text
	**/
	private function busText () {
		return "Take the " . $this->getNumber() . " " . $this->getType() . " from " . $this->getFrom() . " to " . $this->getTo() . ". No seat assignment.";;
	}

	/**
	*	Formatting for the desired output text
	**/
	private function flightText () {
		$str = "From " . $this->getFrom() . ", take " . $this->getNumber() . " to " . $this->getTo() . ". Gate " . $this->getGate() . ", seat " . $this->getSeat() . ".";
		$str .= PHP_EOL;
		$str .=  ($this->getCounter() == false) ? " \t   Baggage will we automatically transferred from your last leg." : " \t   Baggage drop at ticket counter " . $this->getCounter() . "."; 
		return $str;
	}

}