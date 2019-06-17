
getGraph();
/* ChartJS
 * -------
 * Here we will create a few charts using ChartJS
 */

//-----------------------
//- MONTHLY SALES CHART -
//-----------------------

// Get context with jQuery - using jQuery's .get() method.
var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
// This will get the first returned node in the jQuery collection.
var salesChart = new Chart(salesChartCanvas);
var salesChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: false,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
};
var dateOptions = {month: 'long', day: 'numeric' };
function getGraph() {
    $.ajax({
        method : 'GET',
        url : '/graph/group'
    }).done(function(groups){
        var labels = [];
        var tabCountUser = [];
        $.each(groups, function(index, group){
            labels.push(convertDate(group.created_date, false).toLocaleDateString('fr-FR', dateOptions));
            tabCountUser.push(group.count_group);
        });
        var salesChartData = {
            labels: labels,
            //["January", "February", "March", "April", "May", "June", "July"]
            datasets: [
                {
                    label: "Electronics",
                    fillColor: "#FB942F",
                    strokeColor: "#FB942F",
                    pointColor: "#FB942F",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgb(220,220,220)",
                    data: tabCountUser
                    //[65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };
        salesChart.Line(salesChartData, salesChartOptions);
    }).error(function (data) {
        console.log(data);
        displayMessage(data.responseJSON.message, 'panelError', 2000);
    });
}