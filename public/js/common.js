/**
 * Created by Administrator on 4/21/2016.
 */
$(document).ready(function () {
    $('.service_block_add_new_field_btn').on('click', function() {
        $('.service_block_add_new_field').removeClass('dspNone').addClass('dspBlock');
        $('.service_block_add_field').addClass('dspNone');
    });
    $('.service_block_drop_new_field_btn').on('click', function() {
        $('.service_block_add_new_field').removeClass('dspBlock').addClass('dspNone');
        $('.service_block_add_field').addClass('dspBlock').removeClass('dspNone');
    });


});