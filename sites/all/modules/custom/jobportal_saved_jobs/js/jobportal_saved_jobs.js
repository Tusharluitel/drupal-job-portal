(function ($, Drupal) {
    'use strict';

    Drupal.behaviors.jobportalSavedJobs = {
        attach: function (context, settings) {
            if ($(document).data('savedJobsBound')) {
                return;
            }
            $(document).data('savedJobsBound', true);
            $(document).delegate('.saved-job-btn[data-nid]', 'click', function () {
                var $btn = $(this);
                var nid = $btn.data('nid');
                var $msg = $btn.siblings('.saved-job-msg');

                var toggleUrl = Drupal.settings.basePath + 'saved-jobs/toggle/' + nid;

                $btn.attr('disabled', 'disabled');

                $.ajax({
                    url: toggleUrl,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        if (data.saved) {
                            $btn.text('Saved').addClass('is-saved');
                            showMsg($msg, 'Job saved!');
                        } else {
                            $btn.text('Save Job').removeClass('is-saved');
                            showMsg($msg, 'Job unsaved.');
                        }
                    },
                    error: function (xhr) {
                        showMsg($msg, 'Error ' + xhr.status + '. Please try again.');
                    },
                    complete: function () {
                        $btn.removeAttr('disabled');
                    }
                });
            });

            $(document).delegate('.btn-unsave[data-nid]', 'click', function () {
                var $btn = $(this);
                var nid = $btn.data('nid');
                var $card = $btn.closest('.saved-job-card');
                var url = Drupal.settings.basePath + 'saved-jobs/toggle/' + nid;

                $btn.attr('disabled', 'disabled').text('Removing...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        if (!data.saved) {
                            $card.css({
                                opacity: 0,
                                transform: 'translateX(30px)'
                            });
                            setTimeout(function () {
                                $card.remove();
                                if ($('.saved-job-card').length === 0) {
                                    location.reload();
                                }
                            }, 320);
                        }
                    },
                    error: function (xhr) {
                        $btn.removeAttr('disabled').text('Unsave');
                        alert('Error ' + xhr.status + '. Please try again.');
                    }
                });
            });

            function showMsg($el, text) {
                $el.text(text).addClass('visible');
                setTimeout(function () {
                    $el.removeClass('visible');
                }, 2500);
            }
        }
    };

}(jQuery, Drupal));
