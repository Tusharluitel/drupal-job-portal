
(function ($) {
    Drupal.behaviors.jobportalSearch = {
        attach: function (context, settings) {
            var $input = $('#jobportal-search-input', context);
            var $results = $('#jobportal-search-results', context);

            if (!$input.length || $input.data('jobportal-search-attached')) {
                return;
            }
            $input.data('jobportal-search-attached', true);

            var searchTimeout;
            var baseUrl = '/api/jobs/search';

            $(document).bind('click', function (e) {
                if (!$(e.target).closest('.hero-search-wrapper').length) {
                    $results.hide().empty();
                }
            });

            $input.bind('keyup', function (e) {
                var key = e.keyCode || e.which;
                if (key === 38 || key === 40 || key === 27) {
                    return;
                }

                var query = $.trim($(this).val());

                clearTimeout(searchTimeout);

                if (query.length < 2) {
                    $results.hide().empty();
                    return;
                }

                searchTimeout = setTimeout(function () {
                    $.ajax({
                        url: baseUrl,
                        type: 'GET',
                        data: { jobs: query },
                        dataType: 'json',
                        beforeSend: function () {
                            $results
                                .html('<div class="search-result-item search-loading">Searching\u2026</div>')
                                .show();
                        },
                        success: function (data) {
                            $results.empty();

                            if (!data || data.length === 0) {
                                $results
                                    .html('<div class="search-result-item search-no-results">No jobs found for "<strong>' + query + '</strong>"</div>')
                                    .show();
                                return;
                            }

                            $.each(data, function (i, job) {
                                var companyHtml = job.company
                                    ? '<span class="result-company">' + job.company + '</span>'
                                    : '';

                                var $item = $('<a></a>')
                                    .addClass('search-result-item')
                                    .attr('href', job.url)
                                    .html(
                                        '<span class="result-icon">\uD83D\uDCBC</span>' +
                                        '<span class="result-details">' +
                                        '<span class="result-title">' + job.title + '</span>' +
                                        companyHtml +
                                        '</span>'
                                    );

                                $results.append($item);
                            });

                            $results.show();
                        },
                        error: function () {
                            $results
                                .html('<div class="search-result-item search-error">Something went wrong. Please try again.</div>')
                                .show();
                        }
                    });
                }, 280);
            });

            $input.bind('keydown', function (e) {
                var key = e.keyCode || e.which;
                var $items = $results.find('a.search-result-item');
                var $active = $items.filter('.is-active');

                if (key === 40) { // Arrow Down
                    e.preventDefault();
                    if ($active.length && $active.next('a.search-result-item').length) {
                        $active.removeClass('is-active');
                        $active.next('a.search-result-item').addClass('is-active').focus();
                    } else {
                        $items.first().addClass('is-active').focus();
                    }
                } else if (key === 38) { // Arrow Up
                    e.preventDefault();
                    if ($active.length && $active.prev('a.search-result-item').length) {
                        $active.removeClass('is-active');
                        $active.prev('a.search-result-item').addClass('is-active').focus();
                    } else {
                        $input.focus();
                    }
                } else if (key === 27) { // Escape
                    $results.hide().empty();
                    $input.focus();
                }
            });
        }
    };
})(jQuery);
