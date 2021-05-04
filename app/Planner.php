<?php

class Planner {

	/**
	*	This class is responsible for reading the input from JSON file and printing the required journey route.
	**/
	function __construct() {
		$input = file_get_contents("data/input.json");
		if ($input === false) {
		    throw new Exception('Invalid input json');
		}
		$this->boardingPasses = json_decode($input, true);
		
		$this->shufflePasses();
		if(count($this->boardingPasses) > 0) {
			$this->setPassObject();
			$this->sortPassObjects();
		} else {
			echo "No input provided";
		}
		
	}

	/**
	*	This function calls the Sort function from Sorter Class
	**/
	private function sortPassObjects () {
		$sorter = new Sorter($this->boardingPasses);
		$this->sortedBoardingPasses = $sorter->sort();
	}

	/**
	*	This function Prints the output withn some decoration.
	**/
	public function showMyJourneyRoute() {
		$this->emptyLine();
		$this->newLine();
		echo "\t\t\tHere is your journey route ";
		$this->newLine();
		$this->newLine();
		foreach($this->sortedBoardingPasses as $k=>$boradingPass) {
			$this->printFormatted($k, $boradingPass);
		}
		$this->welcomeAtDestination();
		$this->newLine();
		$this->emptyLine();
		echo "\t\t\t\tHappy Journey! ";
		$this->newLine();
		$this->emptyLine();
	}

	/**
	*	Shuffle the array randomly and sleep for a second.
	**/
	private function shufflePasses () {
		$this->newLine();
		echo "*********************** Randomly shuffling the passes ************************************";
		$this->newLine();
		shuffle($this->boardingPasses);
		sleep(1);// Just taking some rest :-P
	}

	/**
	*	Converting Json array element to Pass object
	**/
	private function setPassObject () {
		foreach ($this->boardingPasses as $key => $boardingPass) {
			$pass = new Pass();
			$pass->setType($boardingPass['type'])
				->setNumber($boardingPass['number'])
				->setFrom($boardingPass['from'])
				->setTo($boardingPass['to'])
				->setSeat($boardingPass['seat'])
				->setGate($boardingPass['gate'])
				->setCounter($boardingPass['counter']);
			$this->boardingPasses[$key] = $pass;
		}
	}

	/**
	*	Prints a single board pass informations as output
	*	@param integer $index 
	*	@param string $boradingPass (or object)
	**/
	private function printFormatted ($index, $boradingPass) {
		echo "\t";
		echo ($index + 1) . ". ";
		echo $boradingPass; 
		$this->newLine();
	}

	/**
	*	Prints last line of journey route at arrival.
	**/
	private function welcomeAtDestination () {
		$count = count($this->sortedBoardingPasses);
		if($count > 0) {
			$this->printFormatted($count, "You have arrived at your final destination.");
		}
		
	}

	/**
	*	A decoration function, to show a line with multiple occurence of * with a new line.
	**/
	private function emptyLine () {
		echo "******************************************************************************************";
		$this->newLine();
	}

	/**
	*	A decoration function, to print a new line.
	**/
	private function newLine () {
		echo PHP_EOL;
	}
}