<div class="templates-new">
    <div class="row">
        <form action="" method="post" enctype="multipart/form-data">
            <?php _e('Upload your ZIP file', 'follow_up_emails'); ?>

            <input type="file" name="template" value="Select file" class="upload" />

            <input type="hidden" name="action" value="template_upload" />
            <?php echo wp_nonce_field( 'fue_upload_template' ); ?>
            <input type="submit" class="button big button-primary" value="<?php _e('Install Template', 'follow_up_emails'); ?>" />
        </form>
    </div>
    <div class="row">
        <?php _e('Create a template from scratch', 'follow_up_emails'); ?>

        <input type="button" class="button big button-primary create-template" value="<?php _e('Create a Template', 'follow_up_emails'); ?>" />
    </div>
    <div class="clear"></div>
</div>
<div class="template-form" style="display: none;">
    <form method="post" class="create-template-form">
        <p class="form-field">
            <label for="template_name"><?php _e('Template Name', 'follow_up_emails'); ?></label>
            <input type="text" name="template_name" id="template_name" />
        </p>

        <p class="form-field">
            <label for="template_source"><?php _e('Template Source', 'follow_up_emails'); ?></label>
            <a href="#" class="switch-editor button"><?php _e('Change Editor', 'follow_up_emails'); ?></a>
            <?php wp_editor('', 'template_source', array('editor_height' => 'editor_height')); ?>
            <div id="template_source_editor"></div>
        </p>

        <p class="submit">
            <input type="hidden" name="action" value="template_create">
            <?php echo wp_nonce_field( 'fue_create_template' ); ?>
            <input type="submit" name="submit" class="button-primary" value="<?php _e('Save Template', 'follow_up_emails'); ?>" />
        </p>
    </form>
</div>