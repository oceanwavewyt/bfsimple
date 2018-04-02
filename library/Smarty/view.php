<?php
class view {
	protected $smarty;
	public function __construct($request) {
		$this->smarty = new Smarty();
		$template = $request->getConfig('base',"template");
		$compile  = PROJECT_ROOT."/".$template;
		$this->smarty->template_dir = rtrim(PROJECT_ROOT,'/')."/modules/".$request->get('module').'/view/';
		$this->smarty->compile_dir  = $compile;
	}
	/**
	 * Return the template engine object
	 *
	 * @return Smarty
	 */
	public function getEngine() {
		return $this->smarty;
	}
	/**
	 * Assign a variable to the template
	 *
	 * @param string $key The variable name.
	 * @param mixed $val The variable value.
	 * @return void
	 */
	public function __set($key, $val) {
		$this->smarty->assign ( $key, $val );
	}
	/**
	 * Clear all assigned variables
	 *
	 * Clears all variables assigned to Zend_View either via
	 * {@link assign()} or property overloading
	 * ({@link __get()}/{@link __set()}).
	 *
	 * @return void
	 */
	public function clearVars() {
		$this->smarty->clear_all_assign();
	}
	
	/**
	 * Processes a template and returns the output.
	 *
	 * @param string $name The template to process.
	 * @return string The output.
	 */
	public function display($name) {
		is_dir($this->smarty->compile_dir) || mkdir($this->smarty->compile_dir);
		if(!is_writable($this->smarty->compile_dir) || !is_dir($this->smarty->compile_dir)){
			throw new Exception($this->smarty->compile_dir." is not writable!");
		}
		return $this->smarty->display ( $name );
	}
	
	public function fetch($name) {
		return $this->smarty->fetch ( $name );
	}
}

?>
