(function ($, Drupal) {
    Drupal.behaviors.jobportalRatingDashboard = {
        attach: function (context, settings) {
            if (settings.jobportalRatingDashboard && !$('body').hasClass('jobportal-dashboard-processed')) {
                $('body').addClass('jobportal-dashboard-processed');

                var dashboardData = settings.jobportalRatingDashboard;

                var primaryColors = [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(236, 72, 153, 0.8)',
                    'rgba(6, 182, 212, 0.8)',
                    'rgba(132, 204, 22, 0.8)',
                    'rgba(249, 115, 22, 0.8)',
                    'rgba(99, 102, 241, 0.8)'
                ];

                var borderColors = primaryColors.map(color => color.replace('0.8', '1'));

                var ctxBar = document.getElementById('ratingsBarChart');
                if (ctxBar && dashboardData.orgLabels && dashboardData.avgRatings) {
                    new Chart(ctxBar, {
                        type: 'bar',
                        data: {
                            labels: dashboardData.orgLabels,
                            datasets: [{
                                label: 'Average Rating (Out of 5)',
                                data: dashboardData.avgRatings,
                                backgroundColor: primaryColors.slice(0, dashboardData.orgLabels.length),
                                borderColor: borderColors.slice(0, dashboardData.orgLabels.length),
                                borderWidth: 1,
                                borderRadius: 4,
                                borderSkipped: false,
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                    titleFont: { size: 14, family: 'Inter' },
                                    bodyFont: { size: 14, family: 'Inter' },
                                    padding: 12,
                                    cornerRadius: 8,
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 5,
                                    grid: {
                                        color: 'rgba(241, 245, 249, 1)',
                                    },
                                    ticks: {
                                        font: { family: 'Inter' }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: { family: 'Inter' }
                                    }
                                }
                            }
                        }
                    });
                }

                var ctxLine = document.getElementById('ratingsLineChart');
                if (ctxLine && dashboardData.trendMonths && dashboardData.trendCounts) {

                    var gradient = ctxLine.getContext('2d').createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)');
                    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

                    new Chart(ctxLine, {
                        type: 'line',
                        data: {
                            labels: dashboardData.trendMonths,
                            datasets: [{
                                label: 'Total Ratings Submitted',
                                data: dashboardData.trendCounts,
                                backgroundColor: gradient,
                                borderColor: 'rgba(59, 130, 246, 1)',
                                borderWidth: 3,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: 'rgba(59, 130, 246, 1)',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                fill: true,
                                tension: 0.4 // Smooth curves
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                    titleFont: { size: 14, family: 'Inter' },
                                    bodyFont: { size: 14, family: 'Inter' },
                                    padding: 12,
                                    cornerRadius: 8,
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(241, 245, 249, 1)',
                                    },
                                    ticks: {
                                        stepSize: 1, // Whole numbers for counts
                                        font: { family: 'Inter' }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: { family: 'Inter' }
                                    }
                                }
                            }
                        }
                    });
                }
            }
        }
    };
})(jQuery, Drupal);
