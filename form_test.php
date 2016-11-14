<?php
/**
 * demo code for hierachical select in Moodle
 */

require_once(__DIR__.'/../../config.php');
require_once(__DIR__.'/../../lib/formslib.php');
require_once(__DIR__.'/register.php');


// normally should be in another file named xxxxx_form.php
class demo_hierselect_form extends moodleform {
    function definition() {
        global $CFG;


        $mform = & $this->_form;

        $mform->addElement('header', 'general', ''); //fill in the data depending on page params

        // add hierselect element
        // level 0 array
        $letters = array();
        $letters[0] = 'A';
        $letters[1] = 'B';
        $letters[2] = 'C';

        // level 1 array
        $words = array();
        $words[0][0] = 'Aardvark';
        $words[0][1] = 'Apple';
        $words[0][2] = 'Armadillo';
        $words[1][0] = 'Ball';
        $words[1][1] = 'Banana';
        $words[2][0] = 'Cat';
        $words[2][1] = 'Chicken';
        $words[2][2] = 'Can';
        $words[2][3] = 'Cow';

        $attribs = array('size' => '4'); // height of lists is 4 items
        $hier = &$mform->addElement('hierselect', 'select', get_string('categories'), $attribs);
        $hier->setOptions(array($letters, $words));
        $mform->addRule('select', null, 'required');

        $this->add_action_buttons();
    }
}

//collect choices made if form has been submitted
//if none default is the second item of both lists
$mainchoice=optional_param('list[0]',1,PARAM_INT); // first item
$subchoice=optional_param('list[1]',1,PARAM_INT);  //related item

//dummy return
$return_url= new moodle_url('/local/form_test.php');

//required since I do not call require_login()
$PAGE->set_url('/local/form_test.php');
$context = get_context_instance(CONTEXT_COURSE,1);
$PAGE->set_context($context);



//build a dummy object from parameters
$dummy_data=new stdClass();
$dummy_data->list=array($mainchoice,$subchoice);

$editform = new demo_hierselect_form($CFG->wwwroot . '/local/form_test.php', null);
$editform->set_data($dummy_data);

//cancelled back to default
if ($editform->is_cancelled()) {
    redirect($return_url);
//submitted collect data and do something useful
} elseif ($data = $editform->get_data()) {
    // just a debug printing nothing saved in database
    print("you have selected ");
    print_r($data);
    //should redirect to caller
    //I do not do it to show that my choices are indeed selected in the two lists
}


$strheading = "local demo";
$PAGE->navbar->add($strheading);

/// Print header
$PAGE->set_title("demo code for hierarchical select");
$PAGE->set_heading("demo code for hierarchical select");
echo $OUTPUT->header();
//print the form
$editform->display();
//and the foote
echo $OUTPUT->footer();




