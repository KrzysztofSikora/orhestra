jQuery(function(jQuery) {
    
    var file_frame,
            lksgallery = {
        admin_thumb_ul: '',
        init: function() {
            this.admin_thumb_ul = jQuery('#lksgallery_thumbs');
            this.admin_thumb_ul.sortable({
                placeholder: '',
				revert: true,
            });

            this.admin_thumb_ul.on('click', '.lksgallery_remove_image', function() {
                if (confirm('Are you sure you want to delete this?')) {
                    jQuery(this).parent().fadeOut(1000, function() {
                        jQuery(this).remove();
                    });
                }
                return false;
            });
            
            jQuery('.add_new_img').on('click', function(event) {
                event.preventDefault();
                if (file_frame) {
                    file_frame.open();
                    return;
                }

                file_frame = wp.media.frames.file_frame = wp.media({
                    title: jQuery(this).data('uploader_title'),
                    button: {
                        text: jQuery(this).data('uploader_button_text'),
                    },
                    multiple: true
                });

                file_frame.on('select', function() {
                    var images = file_frame.state().get('selection').toJSON(),
                            length = images.length;
                    for (var i = 0; i < length; i++) {
                        lksgallery.get_thumbnail(images[i]['id']);

                    }
                    
                });
                
            });
			
			jQuery('#all_delete_btn').on('click', function() {
                if (confirm('Are you sure you want to delete all the image slides?')) {
                    lksgallery.admin_thumb_ul.empty();                                        
                }
                return false;
            });
           
        },
        get_thumbnail: function(id, cb) {
            cb = cb || function() {
            };
            var data = {
                action: 'lksgallery_get_thumbnail',
                imageid: id
            };
            jQuery.post(ajaxurl, data, function(response) {
                lksgallery.admin_thumb_ul.append(response);
                cb();
                
            });

        },
        get_all_thumbnails: function(post_id, included) {
            var data = {
                action: 'rpggallery_get_all_thumbnail',
                post_id: post_id,
                included: included
            };
            jQuery('#rpggallery_spinner').show();
            jQuery.post(ajaxurl, data, function(response) {
                lksgallery.admin_thumb_ul.append(response);
                jQuery('#rpggallery_spinner').hide();
            });
        }
    };
    lksgallery.init();
});