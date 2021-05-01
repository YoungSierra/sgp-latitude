<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        @include('partials.meta')
        <!--  App CSS (Do not remove) -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </head>
    <body class="c-app">
        @include('partials.aside')
        <div class="c-wrapper" id="app">
            @include('partials.navbar')
            <div class="c-body">
                <main class="c-main pt-3 fade-in">
                    <div class="container-fluid px-3">
                        @yield('content')
                    </div>
                </main>
            </div>
            @include('partials.footer')
        </div>
        <!-- App JS (Do not remove) -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/functions.js') }}"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script>

        if(window.location.pathname.includes('projects') && document.getElementById('chartContainer1')){
            window.onload = function() {
                
                var chart1 = new CanvasJS.Chart("chartContainer1", {
                    animationEnabled: true,
                    title: {
                        text: "COSTOS GESTORA"
                    },
                    subtitles: [{
                        text: ""
                    }],
                    data: [{
                        type: "pie",
                        yValueFormatString: "#,##0.00\"%\"",
                        indexLabel: "{label} ({y})",
                        dataPoints: <?php  echo json_encode(isset($dataPoints1) ? $dataPoints1 : [], JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart1.render();
                

                var chart2 = new CanvasJS.Chart("chartContainer2", {
                    animationEnabled: true,
                    theme: "light2",
                    title:{
                        text: "COSTOS FIJOS PLATAFORMA"
                    },
                    axisY: {
                        title: ""
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "$ #,##0.## ",
                        indexLabel: "{y}",
                        dataPoints: <?php echo json_encode(isset($dataPoints2) ? $dataPoints2 : [], JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart2.render();

                var chart3 = new CanvasJS.Chart("chartContainer3", {
                    animationEnabled: true,
                    title: {
                        text: "GESTORA PARTICIPANTES"
                    },
                    subtitles: [{
                        text: ""
                    }],
                    data: [{
                        type: "pie",
                        yValueFormatString: "#,##0.00\"%\"",
                        indexLabel: "{label} ({y})",
                        dataPoints: <?php  echo json_encode(isset($dataPoints3) ? $dataPoints3 : [], JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart3.render();
                

                var chart4 = new CanvasJS.Chart("chartContainer4", {
                    animationEnabled: true,
                    theme: "light2",
                    title:{
                        text: "RELACIONES CORPORATIVAS"
                    },
                    axisY: {
                        title: ""
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "$ #,##0.## ",
                        indexLabel: "{y}",
                        dataPoints: <?php echo json_encode(isset($dataPoints4) ? $dataPoints4 : [], JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart4.render();
              
            }   
        }             

        function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            
            // Specify file name
            filename = filename?filename+'.xls':'excel_data.xls';
            
            // Create download link element
            downloadLink = document.createElement("a");
            
            document.body.appendChild(downloadLink);
            
            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            
                // Setting the file name
                downloadLink.download = filename;
                
                //triggering the function
                downloadLink.click();
            }
        }

        if(window.location.pathname.includes('home') && document.getElementById('grafica1')){
            window.onload = function() {
                
                var chart1 = new CanvasJS.Chart("grafica1", {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "ÚLTIMOS 10 PROYECTOS"
                    },
                    subtitles: [{
                        text: ""
                    }],
                    data: [{
                        type: "pie",
                        yValueFormatString: "#,##0.00\"%\"",
                        indexLabel: "{label} ({y})",
                        dataPoints: <?php  echo json_encode(isset($dataGrafica1) ? $dataGrafica1 : [], JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart1.render();
                

                var chart2 = new CanvasJS.Chart("grafica2", {
                    animationEnabled: true,
                    theme: "light2",
                    title:{
                        text: "ÚLTIMOS 10 PROYECTOS"
                    },
                    axisY: {
                        title: ""
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "$ #,##0.## ",
                        indexLabel: "{y}",
                        dataPoints: <?php echo json_encode(isset($dataGrafica2) ? $dataGrafica2 : [], JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart2.render();
                  
            }   
        }             

        </script>
    </body>
</html>