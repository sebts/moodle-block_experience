<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Form for editing Experience block instances.
 *
 * @package   block_experience
 * @copyright  2015 Southeastern Baptist Theological Seminary <http://www.sebts.edu>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_experience_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $CFG;

        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        $mform->addElement('text', 'config_title', get_string('config_title', 'block_experience'));
        $mform->setDefault('config_title', get_string('newblock', 'block_experience'));
        $mform->setType('config_title', PARAM_MULTILANG);

        $mform->addElement('text', 'config_frame_height', get_string('config_frame_height', 'block_experience'), array('size' => 3));
        $mform->setDefault('config_frame_height', get_config('experience', 'default_height'));
        $mform->setType('config_frame_height', PARAM_INT);

        $mform->addElement('text', 'config_frame_width', get_string('config_frame_width', 'block_experience'), array('size' => 3));
        $mform->setDefault('config_frame_width', get_config('experience', 'default_width'));
        $mform->setType('config_frame_width', PARAM_INT);
    }
}
