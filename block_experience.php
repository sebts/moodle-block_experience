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
        global $CFG, $OUTPUT, $USER;

        if ($this->content === null) {
            $this->content = new stdClass;
            if (isloggedin() && !isguestuser()) {
                if (!empty($CFG->block_experience_subdomain)) {
                    $width = !empty($this->config->frame_width) ? $this->config->frame_width : get_config('experience', 'default_width');
                    $height = !empty($this->config->frame_height) ? $this->config->frame_height : get_config('experience', 'default_height');
                    $this->content->text = html_writer::tag('iframe', null, array(
                        'id' => 'experience',
                        'onload' => 'return false;',
                        'src' => "http://{$CFG->block_experience_subdomain}.experience.com/stu/gadget",
                        'framespacing' => '0',
                        'frameborder' => '0',
                        'style' => "width: {$width}px; height: {$height}px; display: block; margin: 0 auto;",
                    ));

                    $registerUrl = new moodle_url("https://{$CFG->block_experience_subdomain}.experience.com/er/speedbump/token_required.jsp",
                        array(
                            'token' => $CFG->block_experience_token,
                        ));
                    $registerBtn = $OUTPUT->single_button($registerUrl, get_string('link_register', 'block_experience'), 'post');

                    $signInUrl = "https://{$CFG->block_experience_subdomain}.experience.com/er/security/login.jsp";
                    $signInBtn = $OUTPUT->single_button($signInUrl, get_string('link_signin', 'block_experience'), 'get');

                    $this->content->footer =
                        html_writer::tag('div',
                        $registerBtn . $signInBtn,
                        array('style' => 'display: flex; justify-content: center;'));
                } else {
                    if (has_capability('moodle/site:manageblocks', context_system::instance())) {
                        $settingLink = $OUTPUT->action_link('/admin/settings.php?section=blocksettingexperience',
                            get_string('update_settings_admin_title', 'block_experience'));
                        $this->content->text = sprintf(get_string('update_settings_admin', 'block_experience'), $settingLink);
                    }
                    else {
                        $this->content->text = get_string('update_settings_user', 'block_experience');
                    }
                }
            }
        }
        return $this->content;
    }
}
