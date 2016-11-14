<?php
// This file is NOT part of Moodle - http://moodle.org/
//
/**
 * Command for registering HTML_QuickForm_hierselect in MoodleQuickForm, just include or require this file in the form definition.
 * Based on this triaged patch: https://tracker.moodle.org/browse/MDL-20589
 *
 * @package    local_hierselect
 * @copyright  2016 Instituto Infnet
*/
MoodleQuickForm::registerElementType('hierselect', "$CFG->dirroot/local/hierselect/hierselect.php", 'MoodleQuickForm_hierselect');
