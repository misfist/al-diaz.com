/*
 * Filtering ajax caching
 *
 */
jQuery(document).ready(function ($) {

    $.post(ajaxurl, {
            plugin_id: 'cpac',
            action: 'cac_update_filtering_cache',
            storage_model: CAC_FC_Storage_Model,
        },
        function ( response ) {

            if ( response.success ) {

                var $select_boxes =  $('select.cpac_filter');

                // populate select options with new data
                if ( response.data ) {

                    var $data = $('<div>').html( response.data );

                    $select_boxes.each(function () {
                        var $el = $(this);
                        var name = $(this).attr('name');
                        var $select = $data.find('select[name="' + name + '"]');

                        if ($select.length > 0) {

                            $el.html('').html($select.html());

                            var current = $el.data('current');
                            if (current) {
                                $el.find('option[value="' + current + '"]').attr('selected', 'selected');
                            }
                        }

                        // No filter values found
                        else {
                            $el.remove();
                        }
                    });
                }

                // there are no select options, we can remove the "loading values" messages
                else {
                    $select_boxes.remove();
                }
            }

            // Error
           else {
                // do nothing
            }
        },
        'json'
    );
});