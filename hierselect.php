<?php
// This file is NOT part of Moodle - http://moodle.org/
//
/**
 * Class for registering HTML_QuickForm_hierselect in MoodleQuickForm.
 * Based on this triaged patch: https://tracker.moodle.org/browse/MDL-20589
 *
 * @package    local_hierselect
 * @copyright  2016 Instituto Infnet
*/
require_once('HTML/QuickForm/hierselect.php');

/**
 * HTML class for a select type element
 *
 * @author       Steve Bourget
 * @access       public
 */
class MoodleQuickForm_hierselect extends HTML_QuickForm_hierselect{
		/**
	 * html for help button, if empty then no help
	 *
	 * @var string
	 */
	var $_helpbutton='';
	var $_hiddenLabel=false;

	function MoodleQuickForm_hierselect($elementName=null, $elementLabel=null, $attributes=null, $seperator=null) {
			parent::HTML_QuickForm_hierselect($elementName, $elementLabel, $attributes, $seperator);
	}
	function setHiddenLabel($hiddenLabel){
			$this->_hiddenLabel = $hiddenLabel;
	}
	function toHtml(){
			if ($this->_hiddenLabel){
				$this->_generateId();
			return '<label class="accesshide" for="'.$this->getAttribute('id').'" >'.
						$this->getLabel().'</label>'.parent::toHtml();
		} else {
				 return parent::toHtml();
		}
	}


   /**
	* Automatically generates and assigns an 'id' attribute for the element.
	*
	* Currently used to ensure that labels work on radio buttons and
	* checkboxes. Per idea of Alexander Radivanovich.
	* Overriden in moodleforms to remove qf_ prefix.
	*
	* @access private
	* @return void
	*/
	function _generateId()
	{
			static $idx = 1;

		if (!$this->getAttribute('id')) {
				$this->updateAttributes(array('id' => 'id_'. substr(md5(microtime() . $idx++), 0, 6)));
		}
	} // end func _generateId
	/**
	 * set html for help button
	 *
	 * @access   public
	 * @param array $help array of arguments to make a help button
	 * @param string $function function name to call to get html
	 */
	function setHelpButton($helpbuttonargs, $function='helpbutton'){
			debugging('component setHelpButton() is not used any more, please use $mform->setHelpButton() instead');
	}
	/**
	 * get html for help button
	 *
	 * @access  public
	 * @return  string html for help button
	 */
	function getHelpButton(){
			return $this->_helpbutton;
	}

	/**
	 * Slightly different container template when frozen. Don't want to use a label tag
	 * with a for attribute in that case for the element label but instead use a div.
	 * Templates are defined in renderer constructor.
	 *
	 * @return string
	 */
	function getElementTemplateType(){
			if ($this->_flagFrozen){
				return 'static';
		} else {
				return 'default';
		}
	}
}
