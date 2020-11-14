/****************************************************************************
 * Teachfy LMS v1.0.0
 * Learning Management System by Themeqx
 * Copyright 2020 | Themeqx | https://themeqx.com
 ****************************************************************************/

$(function() {
    "use strict";

    if (jQuery().tooltip){
        $('[data-toggle="tooltip"]').tooltip();
    }

    if (jQuery().select2){
        $('select.select2').select2();
    }


    /**
     * Admin Sidebar Menu
     */
    $(document).on('click', 'ul#side-menu > li > a', function(e){
        var $that = $(this);
        if ($that.closest('li').find('ul.nav-second-level').length){
            e.preventDefault();
            $that.closest('li').find('ul.nav-second-level').slideToggle();
            $that.toggleClass('opened');
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url ;
    }).addClass('active').parent().parent().addClass('in').parent();

    if (element.is('li')) {
        element.find('> a').addClass('opened');
        element.addClass('active');
    }
    var secondElement = $('ul.nav-second-level a').filter(function() {
        return this.href == url;
    }).addClass('active');
    $('ul#side-menu > li.active > ul.nav-second-level').show();

    /**
     * END: Sidebar Menu
     */


    function fa_icon_format(icon) {
        var originalOption = icon.element;
        return '<i class="la ' + $(originalOption).data('icon') + '"></i> ' + icon.text;
    }
    $("select.select2icon").select2({
        templateResult: fa_icon_format,
        escapeMarkup : function(markup) {
            return markup;
        }
    });



    $(document).on('change', '#admin_share_input, #instructor_share_input', function(e) {
        var input = $(this).attr('name');
        var share = parseInt( $(this).val());
        var admin_share = parseInt( $('#admin_share_input').val());
        var instructor_share = parseInt( $('#instructor_share_input').val());

        if (input === 'admin_share'){
            $('#instructor_share_input').val(100-share);
        }else{
            $('#admin_share_input').val(100-share);
        }

        if ( (admin_share + instructor_share) > 100){
            var shareExceedText = '<p class="bg-dark text-white p-3 mt-3"> <i class="la la-info-circle"></i> Please make sure that (admin share + instructor share) should be <strong>100</strong>, no more, no less</p>';
            $('#share_input_response').html(shareExceedText);
        }else{
            $('#share_input_response').html('');
        }
    });


    /**
     * Send settings option value to server
     */
    $('#settings_save_btn').click(function(e){
        e.preventDefault();

        var $this = $(this);
        var form_data = $this.closest('form').serialize();
        $.ajax({
            url : pageData.routes.save_settings,
            type: "POST",
            data: form_data,
            success : function (data) {
                if (data.success){
                    toastr.success(data.msg, 'Success', toastr_options);
                }else {
                    toastr.error(data.msg, 'Failed', toastr_options);
                }
            }
        });
    });

    /**
     * Delete Confirm
     */

    $(document).on('click', '.delete_confirm', function(e) {
        if ( ! confirm('Are you sure? It can not be undone')){
            return false;
        }
    });


    $(document).on('change', '.bulk_check_all', function(){
        $('input.check_bulk_item:checkbox').not(this).prop('checked', this.checked);
    });


});
