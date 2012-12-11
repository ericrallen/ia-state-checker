<?php

	//state checker class
	class ia__State_Checker {

		//VARS
		//private
		//array for standard US states and territories with their abbreviations
		protected $state_array = array(
			'AL' => 'Alabama',
			'AK' => 'Alaska',
			'AZ' => 'Arizona',
			'AR' => 'Arkansas',
			'CA' => 'California',
			'CO' => 'Colorado',
			'CT' => 'Connecticut',
			'DE' => 'Delaware',
			'DC' => 'District of Columbia',
			'FL' => 'Florida',
			'GA' => 'Georgia',
			'HI' => 'Hawaii',
			'ID' => 'Idaho',
			'IL' => 'Illinois',
			'IN' => 'Indiana',
			'IA' => 'Iowa',
			'KS' => 'Kansas',
			'KY' => 'Kentucky',
			'LA' => 'Louisiana',
			'ME' => 'Maine',
			'MD' => 'Maryland',
			'MA' => 'Massachusetts',
			'MI' => 'Michigan',
			'MN' => 'Minnesota',
			'MS' => 'Mississippi',
			'MO' => 'Missouri',
			'MT' => 'Montana',
			'NE' => 'Nebraska',
			'NV' => 'Nevada',
			'NH' => 'New Hampshire',
			'NJ' => 'New Jersey',
			'NM' => 'New Mexico',
			'NY' => 'New York',
			'NC' => 'North Carolina',
			'ND' => 'North Dakota',
			'OH' => 'Ohio',
			'OK' => 'Oklahoma',
			'OR' => 'Oregon',
			'PA' => 'Pennsylvania',
			'RI' => 'Rhode Island',
			'SC' => 'South Carolina',
			'SD' => 'South Dakota',
			'TN' => 'Tennessee',
			'TX' => 'Texas',
			'UT' => 'Utah',
			'VT' => 'Vermont',
			'VA' => 'Virginia',
			'WA' => 'Washington',
			'WV' => 'West Virginia',
			'WI' => 'Wisconsin',
			'WY' => 'Wyoming',
			'AS' => 'American Samoa',
			'GU' => 'Guam',
			'MP' => 'Northern Mariana Islands',
			'PR' => 'Puerto Rico',
			'VI' => 'United States Virgin Islands',
			'UM' => 'US Minor Outlying Islands',
			'FM' => 'Micronesia',
			'MH' => 'Marshall Islands',
			'PW' => 'Palau',
			'AAUS' => 'Armed Forces America',
			'AEUS' => 'Armed Forces Europe',
			'APUS' => 'Armed Forces Pacific',
			'CZ' => 'Panama Canal',
			'PI' => 'Philippines'
		);

		//array for other representations of the names of some states
		protected $non_standard_array = array(
			'SC' => array(
				'S. Carolina',
				'S Carolina'
			),
			'NC' => array(
				'N. Carolina',
				'N Carolina'
			),
			'SD' => array(
				'S. Dakota',
				'S Dakota'
			),
			'ND' => array(
				'N. Dakota',
				'N Dakota'
			),
			'NJ' => array(
				'Jersey',
				'N Jersey',
				'N. Jersey'
			),
			'DC' => array(
				'Washington DC',
				'D.C.'
			),
			'NH' => array(
				'N Hampshire',
				'N. Hampshire'
			),
			'WV' => array(
				'W. Virginia',
				'W virginia'
			),
			'NY' => array(
				'N York',
				'N. York'
			),
			'RI' => array(
				'R Island',
				'R. Island'
			),
			'MN' => array(
				'Minn.',
				'Minn'
			)
		);

		//public
		var $entered, $state;

		//CONSTRUCTOR
		public function __construct($s = null) {
			if($this->_instance) {
				return $this;
			} else {
				if(is_string($s)) {
					$this->entered = $s;
					$this->state = $this->check_state();
					$this->_instance = $this;
					return $this;
				} else {
					return false;
				}
			}
		}

		//PROTECTED METHODS
		//create super_slug from value
		protected function state_slug($val) {
			if(is_string($val)) {
				$output = strtolower(str_replace(' ', '_', str_replace('-', ' ', str_replace('.', '', $val))));
				return $val;
			}
		}

		//PRIVATE METHODS
		//check entered state
		private function check_state() {
			//"super slug" the state name
			$this->check = $this->state_slug($this->entered);
			$r_state = $this->check_standard_array();
			//if we had a match, return it
			if($r_state) {
				return $r_state;
			//otherwise
			} else {
				$r_state = $this->check_non_standard_array();
				if($r_state) {
					return $r_state;
				} else {
					return $this->entered;
				}
			}
		}

		//check against state array
		private function check_standard_array() {
			$state = '';
			//iterate through state array and compare "super slugs"
			foreach($this->state_array as $key => $val) {
				$check_key = $this->state_slug($key);
				$check_val = $this->state_slug($val);
				//if we find a match, set the state to the abbreviation and exit the loop
				if($this->check == $check_key || $this->check == $check_val) {
					$state = $key;
					break(1);
				}
			}
			return $state;
		}

		//check against non-standard array
		private function check_non_standard_array() {
			$state = '';
			//check non-standard representations
			foreach($this->non_standard_array as $key => $vals) {
				foreach($vals as $test) {
					$check_test = $this->state_slug($test);
					if($this->check == $check_test) {
						$state = $key;
						break(2);
					}
				}
			}
			return $state;
		}

	}

?>