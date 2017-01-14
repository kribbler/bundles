<div class="wrap">
    <h2>
        <?php _e('Manage Subscribers', 'follow_up_emails'); ?>
    </h2>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] > 0): ?>
        <div id="message" class="updated"><p><?php printf( _n('1 email has been deleted', '%d emails have been deleted', intval($_GET['deleted']), 'follow_up_emails'), intval($_GET['deleted'])); ?></p></div>
    <?php endif; ?>

    <?php if (isset($_GET['added'])): ?>
        <div id="message" class="updated"><p><?php printf(_n('1 subscriber has been added', '%d subscribers have been added', intval($_GET['added']), 'follow_up_emails'), intval($_GET['added'])); ?></p></div>
    <?php endif; ?>

    <?php if (isset($_GET['added_subscriber'])): ?>
        <div id="message" class="updated"><p><?php printf( __('%s has been added', 'follow_up_emails'), wp_kses_post( sanitize_email( $_GET['added_subscriber'] ) ) ); ?></p></div>
    <?php endif; ?>

    <?php if (isset($_GET['imported'])): ?>
        <div id="message" class="updated"><p><?php printf( _n('1 has been added', '%d emails have been added', intval($_GET['imported']), 'follow_up_emails'), intval($_GET['imported'])); ?></p></div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) ): ?>
        <div id="message" class="error"><p><?php echo esc_html($_GET['error']); ?></p></div>
    <?php endif; ?>

    <form action="admin-post.php" method="post" enctype="multipart/form-data">

        <div class="tablenav top">
            <div class="tablenav-pages">
                <span class="displaying-num"><?php printf( _n( '%d item', '%d items', $newsletter->found_subscribers, 'follow_up_emails' ), $newsletter->found_subscribers ); ?></span>
                <span class="pagination-links">
                <?php echo $page_links; ?>
                </span>
            </div>

            <div class="alignleft actions bulkactions">
                <input type="email" name="email" placeholder="Add email" />
                <input type="submit" name="button_add" id="post-query-submit" class="button button-secondary" value="<?php _e('Add', 'follow_up_emails'); ?>">
            </div>
            <div class="alignleft actions">
                <select id="filter_list">
                    <?php $selected_filter = isset($_GET['list']) ? $_GET['list'] : '-1'; ?>
                    <option value="-1" <?php selected( $selected_filter, -1 ); ?>><?php _e('Filter by list', 'follow_up_emails'); ?></option>
                    <option value="" <?php selected( $selected_filter, '' ); ?>><?php _e('Uncategorized', 'follow_up_emails'); ?></option>
                    <?php foreach ( $lists as $list ): ?>
                    <option value="<?php echo $list['id']; ?>" <?php selected( $selected_filter, $list['id'] ); ?>><?php echo $list['list_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="button run-filter"><?php _e('Filter', 'follow_up_emails'); ?></button>
            </div>
            <br class="clear">
        </div>
        <table class="wp-list-table widefat fixed posts manual-table">
            <thead>
            <tr>
                <th scope="col" id="cb" class="manage-column column-cb check-column" style=""><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></th>
                <th scope="col" class="manage-column column-email_address <?php echo $email_order_class; ?> <?php echo $email_order; ?>" style="">
                    <a href="<?php echo add_query_arg( array('orderby' => 'email', 'order' => $new_email_order), $base_url ); ?>">
                        <span><?php _e('Email Address', 'follow_up_emails'); ?></span> <span class="sorting-indicator"></span>
                    </a>
                </th>
                <th scope="col" class="manage-column column-email_list" style=""><?php _e('List', 'follow_up_emails'); ?></th>
                <th scope="col" class="manage-column column-date <?php echo $date_order_class; ?> <?php echo $date_order; ?>" style="width:200px;">
                    <a href="<?php echo add_query_arg( array('orderby' => 'date_added', 'order' => $new_date_order), $base_url ); ?>">
                        <span><?php _e('Date', 'follow_up_emails'); ?></span> <span class="sorting-indicator"></span></th>
                    </a>
                <th scope="col" class="manage-column column-actions" style="width: 50px;">&nbsp;</th>
            </tr>
            </thead>
            <tbody id="the_list">
            <?php
            if ( empty($subscribers) ):
                ?>
                <tr>
                    <td colspan="4" align="center"><?php _e('No rows found', 'followup_emails'); ?></td>
                </tr>
            <?php else:
                foreach ($subscribers as $subscriber):
                    $subscriber_lists = '';

                    foreach ( $subscriber['lists'] as $list ) {
                        $subscriber_lists .= '<a href="admin.php?page=followup-emails-subscribers&list='. $list['id'] .'">'. esc_html( $list['name'] ) .'</a>, ';
                    }
                    $subscriber_lists = rtrim( $subscriber_lists, ', ' );
                    ?>
                    <tr>
                        <th class="check-column"><input type="checkbox" id="cb-select-<?php echo esc_attr($subscriber['id']); ?>"  name="email[]" value="<?php echo esc_attr($subscriber['id']); ?>" /></th>
                        <td><?php echo esc_html($subscriber['email']); ?></td>
                        <td><?php echo $subscriber_lists; ?></td>
                        <td><?php echo date( $date_format, strtotime($subscriber['date_added']) ); ?></td>
                        <td></td>
                    </tr>
                <?php
                endforeach;
            endif;
            ?>
            </tbody>
        </table>

        <div class="tablenav bottom">
            <div class="tablenav-pages">
                <span class="displaying-num"><?php printf( _n( '%d item', '%d items', $newsletter->found_subscribers, 'follow_up_emails' ), $newsletter->found_subscribers ); ?></span>
                <span class="pagination-links">
                <?php echo $page_links; ?>
                </span>
            </div>

            <div class=" actions bulkactions">
                <input type="hidden" name="action" value="fue_subscribers_manage" />
                <select name="action2" id="action2" style="max-width: 300px;">
                    <option value=""><?php _e('Bulk actions', 'follow_up_emails'); ?></option>
                    <option value="move"><?php _e('Move subscriber to existing list', 'follow_up_emails'); ?></option>
                    <option value="new"><?php _e('Create new list and move subscriber', 'follow_up_emails'); ?></option>
                    <option value="delete"><?php _e('Remove subscriber and email address', 'follow_up_emails'); ?></option>
                </select>

                <div id="lists" style="display:none;">
                    <select name="list[]" id="list" class="select2" multiple style="width: 300px; clear: both;" data-placeholder="<?php _e('Select lists', 'follow_up_emails'); ?>">
                        <option></option>
                        <?php foreach ( $lists as $list ): ?>
                        <option value="<?php echo $list['id']; ?>"><?php echo $list['list_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="new_list" style="display: none; clear: both;">
                    <input type="text" name="new_list_name" id="new_list_name" placeholder="<?php _e('List name', 'follow_up_emails'); ?>" style="float: left;" />
                </div>

                <input type="submit" name="button_action" id="doaction2" class="button action" value="Apply">
            </div>

        </div>

    </form>
</div>
<script>
    jQuery(document).ready(function($) {
        $("#action2").change(function() {
            switch ( $(this).val() ) {

                case 'move':
                    $("#lists").show();
                    $("#new_list").hide();
                    break;

                case 'new':
                    $("#new_list").show();
                    $("#lists").hide();
                    break;

                default:
                    $("#lists").hide();
                    $("#new_list").hide();
                    break;

            }
        }).change();

        $("#list").select2();

        $(".run-filter").click(function() {
            var filter = $("#filter_list").val();

            window.location.href = 'admin.php?page=followup-emails-subscribers&list='+ filter;
        });
    });
</script>