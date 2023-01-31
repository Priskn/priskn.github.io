var dataPoints = [];
var dataX = [];
var usr;

function addData(data) {
    var sco = data.scores;
    usr = data.name;
    for (var i = 0; i < sco.length; i++) {
        dataPoints.push([
            sco[i]['date'].toString(),
            sco[i]['score']
        ]);
        dataX.push(sco[i]['date'].toString());
    }

}


$.getJSON("scores.json", addData);


Highcharts.addEvent(Highcharts.Point, 'click',
    function () {
        console.log(usr + "---" + this.category);
        document.location.href='specificdate.php?name='+usr+'&week='+this.category;
    });


var chart = {

    title: {
        text: 'Activité de l\'utilisateur : ' + usr,
        align: 'left'
    },


    yAxis: {
        title: {
            text: 'Scores'
        }
    },

    xAxis: {
        accessibility: {
            rangeDescription: 'Range: 0 to 20'
        },
        categories: dataX
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 0
        }
    },

    series: [{
        data: dataPoints
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

}


Highcharts.ajax({
    url: "scores.json",
    success: function (data) {
        Highcharts.chart('container', chart);

    }
})
