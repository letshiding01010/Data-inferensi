<?php
include "Statistic.php";?>
<html>
    <head>
        <title>Data Statistic</title>
        <script src="Chart.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
        <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
        </style>
    </head>
    <body><!doctype html>
<html>

<head>
    <title>Data Statistic</title>
    <script src="../Chart.bundle.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>

<body>
    <div style="width:75%;">
        <canvas id="canvas"></canvas>

        


    </div>
    <script>
        var Data = ["Q1", "Q2", "Q3", "Mean", "Varian", "Std Deviasi", "Modus", "Median"];
        
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
            //return 0;
        };
        var randomColorFactor = function() {
            return Math.round(Math.random() * 255);
        };
        var randomColor = function(opacity) {
            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
        };

        var config = {
            type: 'line',
            data: {
                labels: ["Q1", "Q2", "Q3", "Mean", "Varian", "Std Deviasi", "Modus", "Median"],
                datasets: [{
                    label: "Data",
                    data: [
                    <?php echo $statistic->q1($data) ?>,
                    <?php echo $statistic->q2($data) ?>,
                    <?php echo $statistic->q3($data) ?>,
                    <?php echo $statistic->mean($data) ?>,
                    <?php echo $statistic->Varian($data) ?>,
                    <?php echo $statistic->std_deviasi($data) ?>,
                    <?php echo count($statistic->modus($data)) ?>,
                    <?php echo $statistic->median($data) ?>,


                    ],
                    fill: false,
                    borderDash: [5, 5],
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Analisis Data'

                },
                tooltips: {
                    mode: 'label',
                    callbacks: {
                        // beforeTitle: function() {
                        //     return '...beforeTitle';
                        // },
                        // afterTitle: function() {
                        //     return '...afterTitle';
                        // },
                        // beforeBody: function() {
                        //     return '...beforeBody';
                        // },
                        // afterBody: function() {
                        //     return '...afterBody';
                        // },
                        // beforeFooter: function() {
                        //     return '...beforeFooter';
                        // },
                        // footer: function() {
                        //     return 'Footer';
                        // },
                        // afterFooter: function() {
                        //     return '...afterFooter';
                        // },
                    }
                },
                hover: {
                    mode: 'dataset'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Data'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            suggestedMin: 1,
                            suggestedMax: <?php echo $statistic->get_total_data($data) ?>,
                        }
                    }]
                }
            }
        };

        $.each(config.data.datasets, function(i, dataset) {
            dataset.borderColor = randomColor(0.4);
            dataset.backgroundColor = randomColor(0.5);
            dataset.pointBorderColor = randomColor(0.7);
            dataset.pointBackgroundColor = randomColor(0.5);
            dataset.pointBorderWidth = 1;
        });

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);
        };


        
    </script>
</body>

