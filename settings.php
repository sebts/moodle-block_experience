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
 * Settings for the Experience block
 *
 * @copyright  2015 Southeastern Baptist Theological Seminary <http://www.sebts.edu>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package   block_experience
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext(
        'block_experience_subdomain',
        get_string('global_subdomain', 'block_experience'),
        get_string('global_subdomain_desc', 'block_experience'),
        ''
    ));
    $settings->add(new admin_setting_configtext(
        'block_experience_token',
        get_string('global_token', 'block_experience'),
        get_string('global_token_desc', 'block_experience'),
        ''
    ));
    $settings->add(new admin_setting_configtext(
        'experience/default_width',
        get_string('global_frame_width', 'block_experience'),
        get_string('global_frame_width_desc', 'block_experience'),
        210,
        PARAM_INT
    ));
    $settings->add(new admin_setting_configtext(
        'experience/default_height',
        get_string('global_frame_height', 'block_experience'),
        get_string('global_frame_height_desc', 'block_experience'),
        570,
        PARAM_INT
    ));
}
