<script>
    var UsersChart = function() {
        var _componentEcharts = function() {
            if (typeof echarts == 'undefined') {
                console.warn('Warning - echarts.min.js is not loaded.');
                return;
            }
            // Define elements
            var customers_chart_element = document.getElementById('customers_chart');
            // Weekly statistics chart config
            if (customers_chart_element) {
                // Initialize chart
                var customers_chart = echarts.init(customers_chart_element);
                // Options
                customers_chart.setOption({
                    // Define colors
                    color: ['#EF5350', '#03AEE4'],
                    // Global text styles
                    textStyle: {
                        fontFamily: 'Cairo',
                        fontSize: 14
                    },
                    // Chart animation duration
                    animationDuration: 750,
                    // Setup grid
                    grid: {
                        left: 0,
                        right: 10,
                        top: 35,
                        bottom: 0,
                        containLabel: true
                    },
                    // Add legend
                    legend: {
                        data: [`{{ trans('dash.home.charts.stores_analytics') }}`,
                            `{{ trans('dash.home.charts.bazars_analytics') }}`],
                        {{--data: [`{{ trans('dash.home.charts.active_driver_men') }}`,`{{ trans('dash.home.charts.active_driver_women') }}`],--}}
                        itemHeight: 8,
                        itemGap: 20,
                        textStyle: {
                            padding: [0, 5]
                        }
                    },
                    // Add tooltip
                    tooltip: {
                        trigger: 'axis',
                        backgroundColor: 'rgba(0,0,0,0.75)',
                        padding: [10, 15],
                        textStyle: {
                            fontSize: 13,
                            fontFamily: 'Cairo'
                        },
                        axisPointer: {
                            type: 'shadow',
                            shadowStyle: {
                                color: 'rgba(0,0,0,0.025)'
                            }
                        }
                    },

                    // Horizontal axis
                    xAxis: [{
                        type: 'category',
                        data: [
                            "{{ now()->subMonths(11)->format('Y-m') }}",
                            "{{ now()->subMonths(10)->format('Y-m') }}",
                            "{{ now()->subMonths(9)->format('Y-m') }}",
                            "{{ now()->subMonths(8)->format('Y-m') }}",
                            "{{ now()->subMonths(7)->format('Y-m') }}",
                            "{{ now()->subMonths(6)->format('Y-m') }}",
                            "{{ now()->subMonths(5)->format('Y-m') }}",
                            "{{ now()->subMonths(4)->format('Y-m') }}",
                            "{{ now()->subMonths(3)->format('Y-m') }}",
                            "{{ now()->subMonths(2)->format('Y-m') }}",
                            "{{ now()->subMonths(1)->format('Y-m') }}",
                            "{{ now()->format('Y-m') }}",
                        ],
                        axisLabel: {
                            color: '#333'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#999'
                            }
                        },
                        splitLine: {
                            show: true,
                            lineStyle: {
                                color: '#eee',
                                type: 'dashed'
                            }
                        }
                    }],

                    // Vertical axis
                    yAxis: [
                        {
                            type: 'value',
                            name: "العدد",
                            axisTick: {
                                show: false
                            },
                            axisLabel: {
                                color: '#333',
                                formatter: '{value}'
                            },
                            axisLine: {
                                lineStyle: {
                                    color: '#999'
                                }
                            },
                            splitLine: {
                                show: true,
                                lineStyle: {
                                    color: ['#eee']
                                }
                            },
                            splitArea: {
                                show: true,
                                areaStyle: {
                                    color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.015)']
                                }
                            }
                        }
                    ],

                    // Add series
                    series: [






                        {
                            name: `{{ trans('dash.home.charts.stores_analytics') }}`,
                            type: 'bar',
                            data: [
                                {{ $stores_analytics[now()->subMonths(11)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(10)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(9)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(8)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(7)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(6)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(5)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(4)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(3)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(2)->format('Y-m')] }},
                                {{ $stores_analytics[now()->subMonths(1)->format('Y-m')] }},
                                {{ $stores_analytics[now()->format('Y-m')] }}
                            ]
                        },
                        {
                            name: `{{ trans('dash.home.charts.bazars_analytics') }}`,
                           // type: 'line',
                            type: 'bar',
                            data: [
                                {{ $bazars_analytics[now()->subMonths(11)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(10)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(9)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(8)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(7)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(6)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(5)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(4)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(3)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(2)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->subMonths(1)->format('Y-m')] }},
                                {{ $bazars_analytics[now()->format('Y-m')] }}
                            ]
                        },

                    ]
                });

                //customers_chart.on('click', function (e) {
                    // printing data name in console
                //});
            }


            //
            // Resize charts
            //

            // Resize function
            var triggerChartResize = function() {
                customers_chart_element && customers_chart.resize();
            };

            // On sidebar width change
            $(document).on('click', '.sidebar-control', function() {
                setTimeout(function () {
                    triggerChartResize();
                }, 0);
            });

            // On window resize
            var resizeCharts;
            window.onresize = function () {
                clearTimeout(resizeCharts);
                resizeCharts = setTimeout(function () {
                    triggerChartResize();
                }, 200);
            };
        };
        return {
            init: function() {
                _componentEcharts();
            }
        }
    }();


</script>