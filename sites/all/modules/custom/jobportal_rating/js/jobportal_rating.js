(function ($) {
  Drupal.behaviors.jobportalRatingAddMore = {
    attach: function (context, settings) {

      $('#add-pro-btn', context).once('add-pro').click(function (e) {
        e.preventDefault();
        var proHtml = '<div class="dynamic-item" style="margin-top: 10px; display: flex; align-items: center;">' +
          '<input type="text" name="pros[]" class="form-text" placeholder="Enter another pro" style="flex-grow: 1; margin-right: 10px;" />' +
          '<button type="button" class="remove-item button" style="background:none; border:none; color:#ef4444; cursor:pointer; font-size: 1.2rem; padding: 0;">&times;</button>' +
          '</div>';
        $('#pros-container .dynamic-inputs').append(proHtml);
      });

      $('#add-con-btn', context).once('add-con').click(function (e) {
        e.preventDefault();
        var conHtml = '<div class="dynamic-item" style="margin-top: 10px; display: flex; align-items: center;">' +
          '<input type="text" name="cons[]" class="form-text" placeholder="Enter another con" style="flex-grow: 1; margin-right: 10px;" />' +
          '<button type="button" class="remove-item button" style="background:none; border:none; color:#ef4444; cursor:pointer; font-size: 1.2rem; padding: 0;">&times;</button>' +
          '</div>';
        $('#cons-container .dynamic-inputs').append(conHtml);
      });

      $('.rating-form-wrapper').delegate('.remove-item', 'click', function (e) {
        e.preventDefault();
        $(this).closest('.dynamic-item').remove();
      });

    }
  };
})(jQuery);
