'use strict';

$(document).ready(function(){
    // Make some sample data
    var pieData = [
        {data:2, color: '#ff6b68', label: '最佳回答'},
        {data: 2, color: '#03A9F4', label: '技术分享'},
        {data: 3, color: '#32c787', label: '项目star'},
        {data: 2, color: '#f5c942', label: '专题分享'},
        {data: 1, color: '#d066e2', label: '其他'}
    ];
    
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