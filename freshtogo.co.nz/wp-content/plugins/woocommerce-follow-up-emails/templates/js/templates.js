jQuery(document).ready(function($) {
    var editor = null;
    $(".edit-html").click(function(e) {
        e.preventDefault();

        var parent_div = $(this).parents("div").eq(0);
        parent_div.block({ message: null, overlayCSS: { background: '#fff url('+ FUE_Templates.ajax_loader +') no-repeat center', opacity: 0.6 } });
        var that = this;

        $.get( ajaxurl, {
            action: "fue_load_template_source",
            template: $(that).data("template"),
            security: FUE_Templates.get_template_nonce
        }, function(src) {
            parent_div.unblock();

            if ( src.indexOf("Error:") == 0 ) {
                alert( src );
                return false;
            }

            $("ul.fue-templates").slideUp(function() {
                $("#template_editor").slideDown();
            });

            $("#current_template").val( $(that).data("template") );

            editor = ace.edit("editor");
            editor.setTheme("ace/theme/chrome");
            editor.getSession().setMode("ace/mode/html");
            editor.setValue( src );
        });

    });

    $(".edit-html-close").click(function() {
        if ( editor ) {
            editor.destroy();

            var oldDiv = editor.container;
            var newDiv = oldDiv.cloneNode(false);

            oldDiv.parentNode.replaceChild(newDiv, oldDiv);

            $("#template_editor").slideUp(function() {
                $("ul.fue-templates").slideDown();
            });

            $("#current_template").val("");
        }
    });

    $(".edit-html-save").click(function() {
        var source = editor.getValue();

        $(".edit-html-spinner").css({
            display: "inline-block",
            visibility: "visible"
        });

        $(".edit-html-status")
            .html("")
            .removeClass("updated error");

        $.post(ajaxurl, {
            action: "fue_save_template_source",
            template: $("#current_template").val(),
            security: FUE_Templates.save_template_nonce,
            source: source
        }, function(resp) {
            if ( resp.status == "ERROR" ) {
                $(".edit-html-status")
                    .addClass("error")
                    .html( resp.error );
            } else {
                $(".edit-html-status")
                    .addClass("updated")
                    .html("<span class='dashicons dashicons-yes'></span> Updated");
            }

            $(".edit-html-spinner").hide();
        }, 'json')

    });

    $(".create-template").on("click", function() {
        editor = ace.edit("template_source_editor");
        editor.setTheme("ace/theme/chrome");
        editor.getSession().setMode("ace/mode/html");

        $(".templates-new").slideUp(function() {
            $(".template-form").slideDown(function() {
                $(".switch-tmce").click();
            });
        })
    });

    $(".cancel-new-template").click(function() {
        editor.setValue("");
        $(".template-form").slideUp(function() {
            $(".templates-new").slideDown();
        })
    });

    var current_editor = 'rte';
    $(".switch-editor").click(function(e) {
        e.preventDefault();

        if ( current_editor == 'rte' ) {
            // switch to source view
            current_editor = 'src';
            $("#template_source_editor").show();
            editor = ace.edit("template_source_editor");
            editor.setTheme("ace/theme/chrome");
            editor.getSession().setMode("ace/mode/html");
            editor.setValue( tinyMCE.get('template_source').getContent() );

            $("#wp-template_source-wrap").hide();
        } else {
            // switch to rte
            current_editor = 'rte';

            $("#wp-template_source-wrap").show();

            if ( editor ) {
                tinyMCE.get('template_source').setContent( editor.getValue() );

                editor.destroy();

                var oldDiv = editor.container;
                var newDiv = oldDiv.cloneNode(false);

                oldDiv.parentNode.replaceChild(newDiv, oldDiv);
            }
            $("#template_source_editor").hide();

        }
    });

    $(".create-template-form").submit(function() {
        if ( current_editor == 'src' ) {
            if ( editor ) {
                tinyMCE.get('template_source').setContent(editor.getValue());
            }
        }

        return true;
    });

});