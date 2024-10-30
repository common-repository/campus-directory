<?php if (!defined('ABSPATH')) exit;
global $search_people_shc_count; ?><div class="emd-search-results">
    <table class="table emd-table">
        <thead>
            <tr>
                <th><?php esc_html_e('Name', 'campus-directory'); ?></th>
                <?php if (emd_is_item_visible('ent_person_photo', 'campus_directory', 'attribute', 1)) { ?>

                <th><?php esc_html_e('Photo', 'campus-directory'); ?></th>
                <?php
} ?>
<?php if (emd_is_item_visible('ent_person_type', 'campus_directory', 'attribute', 1)) { ?>

                <th><?php esc_html_e('Type', 'campus-directory'); ?></th>
                <?php
} ?>
<?php if (emd_is_item_visible('ent_person_office', 'campus_directory', 'attribute', 1)) { ?>

                <th><?php esc_html_e('Office', 'campus-directory'); ?></th>
                <?php
} ?>
<?php if (emd_is_item_visible('ent_person_phone', 'campus_directory', 'attribute', 1)) { ?>

                <th><?php esc_html_e('Phone', 'campus-directory'); ?></th>
                <?php
} ?>
<?php if (emd_is_item_visible('ent_person_email', 'campus_directory', 'attribute', 1)) { ?>

                <th><?php esc_html_e('Email', 'campus-directory'); ?></th>
                <?php
} ?>

            </tr>
        </thead>