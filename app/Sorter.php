<?php

class Sorter {
	/**
	*	This class is responsible for sorting the provided boarding passes in order with their origin and destinations.
	**/

	function __construct($boardingPasses) {
		$this->boardingPasses = $boardingPasses;
		$this->sortedBoardingPasses = [];
		$this->firstOrigin;
	}

	/**
	*	Sorts the boarding passes provided
	*	
	*/
	public function sort() {
		$origins = $destinations = [];
		foreach ($this->boardingPasses as $key => $boardingPass) {
			$origins[$boardingPass->getFrom()] = $boardingPass;
			$destinations[$boardingPass->getTo()] = $boardingPass;
		}
		$this->getFirstOrigin($origins, $destinations);
		$this->setSortedBoardingPasses($origins, $destinations);
		return $this->sortedBoardingPasses;
	}

	/**
	*	This function gets the first origin by checking which of the origin is not in the destination array.
	*	@param array $origins
	*	@param array $destinations
	*/
	private function getFirstOrigin ($origins, $destinations) {
		foreach($origins as $origin => $boardingPass) {
			if(!isset($destinations[$origin])) {
				$this->firstOrigin = $boardingPass;
				return;
			}
		}
	}

	/**
	*	This function sets the sorted passes by getting the destination of the current pass and searching for the same as origin.
	*	@param array $origins
	*	@param array $destinations
	*/
	private function setSortedBoardingPasses ($origins, $destinations) {
		$this->sortedBoardingPasses[] = $this->firstOrigin;
		$nextDestination = $this->firstOrigin->getTo();
		while(isset($origins[$nextDestination])) {
			$this->sortedBoardingPasses[] = $origins[$nextDestination];
			$nextDestination = $origins[$nextDestination]->getTo();
		}
	}
}