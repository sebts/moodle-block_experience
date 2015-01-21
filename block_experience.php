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
 * @copyright 2015 Southeastern Baptist Theological Seminary <http://www.sebts.edu>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_experience extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_experience');
    }

    function has_config() {
        return true;
    }

    function specialization() {
        $title = isset($this->config->title) ? $this->config->title : get_string('newblock', 'block_experience');
        $this->title = format_string($title);
    }

    function instance_allow_multiple() {
        return true;
    }

    function get_content() {
        global $CFG;

        require_once($CFG->libdir . '/filelib.php');

        if ($this->content === null) {
            $this->content = new stdClass;
            if (isset($CFG->block_experience_subdomain_job)) {
                $width = isset($this->config->frame_width) ? $this->config->frame_width : get_config('experience', 'default_width');
                $height = isset($this->config->frame_height) ? $this->config->frame_height : get_config('experience', 'default_height');
                $this->content->text = "<iframe onload='return false' id='experience' " .
                    "src='http://{$CFG->block_experience_subdomain_job}.experience.com/stu/gadget' " .
                    "framespacing='0' frameborder='0' " .
                    "style='width: {$width}px; height: {$height}px; margin-left: auto; margin-right: auto; display: block;' " .
                    "></iframe>";
            }
            $this->content->footer = ''; // Put register and SSO links here.
        }
        return $this->content;
    }
}
