<?php
// Container for an array of options
class WINPM_Next_Post_Options {
	protected $key;		// the option key name
	protected $defaults;	// the default options value

	/**
	 * Create a new set of options
	 *
	 * @param string $key Option key name
	 * @param array $defaults An associative array of default options value
	 */
	public function __construct( $key, $defaults = array() ) {
		$this->key = $key;
		$this->defaults = $defaults;

		if(!get_option( $this->key ))
			$this->reset_option();
	}

	/**
	 * Get option values for one fields
	 *
	 * @param string|array $field The field to get
	 * @return one field value
	 */
	public function get( $field = null, $default = null ) {
		$data = array_merge( $this->defaults, unserialize( get_option( $this->key, array() )) );
		return $data[$field];
	}

	/**
	 * Reset option to defaults
	 *
	 * @return null
	 */
	public function reset_option() {
		update_option( $this->key, serialize($this->defaults) );
	}

	/**
	 * Delete the option
	 *
	 * @return null
	 */
	public function delete() {
		delete_option( $this->key );
	}

}
?>