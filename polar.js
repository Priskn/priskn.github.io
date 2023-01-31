var date;
var nbConnect;
var nbMsgSent;
var nbMsgQuoted;
var nbAnswers;
var nbUploads;

function addData(data) {
    date = data.date;
    var nbConnect = data.nbConnect;
    nbMsgSent = data.nbMsgSent;
    nbMsgQuoted = data.nbMsgQuoted;
    nbAnswers = data.nbAnswers;
    nbUploads = data.nbUploads;
    console.log("b : "+date,nbConnect)
    Highcharts.chart('container', chart);
}


$.getJSON("quota.json", addData);




console.log("a : ", date,nbConnect)

var chart = {

    chart: {
        polar: true
    },

    title: {
        text: 'Highcharts Polar Chart'
    },

    subtitle: {
        text: 'Also known as Radar Chart'
    },

    pane: {
        startAngle: 0,
        endAngle: 360
    },

    xAxis: {
        tickInterval: 45,
        min: 0,
        max: 360,
        labels: {
            format: '{value}°'
        }
    },

    yAxis: {
        min: 0
    },

    plotOptions: {
        series: {
            pointStart: 0,
            pointInterval: 45
        },
        column: {
            pointPadding: 0,
            groupPadding: 0
        }
    },

    series: [{
        type: 'column',
        name: 'Column',
        data: [nbConnect,nbMsgSent,nbMsgQuoted,nbAnswers,nbUploads],
        pointPlacement: 'between'
    }]
}


Highcharts.chart('container', chart);


Highcharts.ajax({
    url: "scores.json",
    success: function (data) {

    }
})