'use strict';

$(document).ready(function(){

        var pieData='';
        $.ajax({
            type: "get",
            url :'/user/pie-data',
            async : false,
            success : function(data){
                pieData=data.data
            }});

    // Pie Chart
    if($('.flot-pie')[0]){
        $.plot('.flot-pie', pieData, {
            series: {
                pie: {
                    innerRadius:0.5,
                    show: true
                }
            },
            legend: {
                show: false
            }
        });
    }
    
    // Donut Chart
    if($('.flot-donut')[0]){
        $.plot('.flot-donut', pieData, {
            series: {
                pie: {
                    innerRadius: 0.5,
                    show: true,
                    stroke: { 
                        width: 2
                    }
                }
            },
            legend: {
                container: '.flot-chart-legend--donut',
                backgroundOpacity: 0.5,
                noColumns: 0,
                backgroundColor: "white",
                lineWidth: 0,
                labelBoxBorderColor: '#fff'
            }
        });
    }
});