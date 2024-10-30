<?php
/**
 * Settings Glossary Functions
 *
 * @package CAMPUS_DIRECTORY
 * @since WPAS 4.0
 */
if (!defined('ABSPATH')) exit;
add_action('campus_directory_settings_glossary', 'campus_directory_settings_glossary');
/**
 * Display glossary information
 * @since WPAS 4.0
 *
 * @return html
 */
function campus_directory_settings_glossary() {
	global $title;
?>
<div class="wrap">
<h2><?php echo esc_html($title); ?></h2>
<p><?php esc_html_e('Integrated information repository for academic people', 'campus-directory'); ?></p>
<p><?php esc_html_e('The below are the definitions of entities, attributes, and terms included in Campus Directory.', 'campus-directory'); ?></p>
<div id="glossary" class="accordion-container">
<ul class="outer-border">
<li id="emd_person" class="control-section accordion-section open">
<h3 class="accordion-section-title hndle" tabindex="1"><?php esc_html_e('People', 'campus-directory'); ?></h3>
<div class="accordion-section-content">
<div class="inside">
<table class="form-table"><p class"lead"><?php esc_html_e('Any person who is a faculty, graduate or undergraduate student, staff.', 'campus-directory'); ?></p><tr><th style='font-size: 1.1em;color:cadetblue;border-bottom: 1px dashed;padding-bottom: 10px;' colspan=2><div><?php esc_html_e('Attributes', 'campus-directory'); ?></div></th></tr>
<tr>
<th><?php esc_html_e('Photo', 'campus-directory'); ?></th>
<td><?php esc_html_e('For best results choose a photo close to 150x150px dimensions with crop thumbnail to exact dimensions option selected in WordPress media settings Photo does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('First Name', 'campus-directory'); ?></th>
<td><?php esc_html_e(' First Name is a required field. Being a unique identifier, it uniquely distinguishes each instance of Person entity. First Name is filterable in the admin area. First Name does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Last Name', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Last Name is a required field. Being a unique identifier, it uniquely distinguishes each instance of Person entity. Last Name is filterable in the admin area. Last Name does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Person Type', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Person Type is a required field. Person Type is filterable in the admin area. Person Type does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Bio', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Bio does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Office', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Office is filterable in the admin area. Office does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Address', 'campus-directory'); ?></th>
<td><?php esc_html_e('The mailing address of this person Address does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Email', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Email is filterable in the admin area. Email does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Phone', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Phone is filterable in the admin area. Phone does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Website', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Website does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Personal Website', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Personal Website does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Linkedin', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Linkedin does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Twitter', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Twitter does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Curriculum Vitae', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Curriculum Vitae does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Education', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Education does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Awards And Honors', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Awards And Honors does not have a default value. ', 'campus-directory'); ?></td>
</tr>
<tr>
<th><?php esc_html_e('Academic Appointments', 'campus-directory'); ?></th>
<td><?php esc_html_e(' Academic Appointments does not have a default value. ', 'campus-directory'); ?></td>
</tr><tr><th style='font-size:1.1em;color:cadetblue;border-bottom: 1px dashed;padding-bottom: 10px;' colspan=2><div><?php esc_html_e('Taxonomies', 'campus-directory'); ?></div></th></tr>
<tr>
<th><?php esc_html_e('Academic Area', 'campus-directory'); ?></th>

<td><?php esc_html_e('Academic area of expertise Academic Area accepts multiple values like tags', 'campus-directory'); ?>. <?php esc_html_e('Academic Area does not have a default value', 'campus-directory'); ?>.<div class="taxdef-block"><p><?php esc_html_e('There are no preset values for <b>Academic Area.</b>', 'campus-directory'); ?></p></div></td>
</tr>

<tr>
<th><?php esc_html_e('Title', 'campus-directory'); ?></th>

<td><?php esc_html_e(' Title accepts multiple values like tags', 'campus-directory'); ?>. <?php esc_html_e('Title does not have a default value', 'campus-directory'); ?>.<div class="taxdef-block"><p><?php esc_html_e('There are no preset values for <b>Title.</b>', 'campus-directory'); ?></p></div></td>
</tr>

<tr>
<th><?php esc_html_e('Research Area', 'campus-directory'); ?></th>

<td><?php esc_html_e(' Research Area accepts multiple values like tags', 'campus-directory'); ?>. <?php esc_html_e('Research Area does not have a default value', 'campus-directory'); ?>.<div class="taxdef-block"><p><?php esc_html_e('There are no preset values for <b>Research Area.</b>', 'campus-directory'); ?></p></div></td>
</tr>

<tr>
<th><?php esc_html_e('Location', 'campus-directory'); ?></th>

<td><?php esc_html_e(' Location accepts multiple values like tags', 'campus-directory'); ?>. <?php esc_html_e('Location does not have a default value', 'campus-directory'); ?>.<div class="taxdef-block"><p><?php esc_html_e('There are no preset values for <b>Location.</b>', 'campus-directory'); ?></p></div></td>
</tr>

<tr>
<th><?php esc_html_e('Directory Tag', 'campus-directory'); ?></th>

<td><?php esc_html_e('Generic taxonomy which binds people, courses and publications together. Directory Tag accepts multiple values like tags', 'campus-directory'); ?>. <?php esc_html_e('Directory Tag does not have a default value', 'campus-directory'); ?>.<div class="taxdef-block"><p><?php esc_html_e('There are no preset values for <b>Directory Tag.</b>', 'campus-directory'); ?></p></div></td>
</tr>
<tr><th style='font-size: 1.1em;color:cadetblue;border-bottom: 1px dashed;padding-bottom: 10px;' colspan=2><div><?php esc_html_e('Relationships', 'campus-directory'); ?></div></th></tr>
<tr>
<th><?php esc_html_e('Support Staff', 'campus-directory'); ?></th>
<td><?php esc_html_e('Allows to display and create connections with People', 'campus-directory'); ?>. <?php esc_html_e('One instance of People can associated with many instances of People, and vice versa', 'campus-directory'); ?>.  <?php esc_html_e('The relationship can be set up in the edit area of People using Support Staff relationship box', 'campus-directory'); ?>. </td>
</tr>
<tr>
<th><?php esc_html_e('Advisees', 'campus-directory'); ?></th>
<td><?php esc_html_e('Allows to display and create connections with People', 'campus-directory'); ?>. <?php esc_html_e('One instance of People can associated with many instances of People, and vice versa', 'campus-directory'); ?>.  <?php esc_html_e('The relationship can be set up in the edit area of People using Advisor relationship box', 'campus-directory'); ?>. </td>
</tr>
<tr>
<th><?php esc_html_e('Supported Faculty', 'campus-directory'); ?></th>
<td><?php esc_html_e('Allows to display and create connections with People', 'campus-directory'); ?>. <?php esc_html_e('One instance of People can associated with many instances of People, and vice versa', 'campus-directory'); ?>.  <?php esc_html_e('The relationship can be set up in the edit area of People using Support Staff relationship box', 'campus-directory'); ?>. </td>
</tr>
<tr>
<th><?php esc_html_e('Advisor', 'campus-directory'); ?></th>
<td><?php esc_html_e('Allows to display and create connections with People', 'campus-directory'); ?>. <?php esc_html_e('One instance of People can associated with many instances of People, and vice versa', 'campus-directory'); ?>.  <?php esc_html_e('The relationship can be set up in the edit area of People using Advisor relationship box. ', 'campus-directory'); ?> </td>
</tr></table>
</div>
</div>
</li>
</ul>
</div>
</div>
<?php
}