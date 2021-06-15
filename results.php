
<h1 class="resultHeading mt-4 mb-2">Your Results</h1>

<section id="resultsPage">

    <div id="resultsWrapper">        
        <div id="chart"></div>
        
        <div id="resultsTableContainer">
            <table id="resultsTable" class="table">

            </table>

            <div class="resultsButton">
                
                    <a class="Print" onclick="print()" href="#">Print</a>
                    <a class="Save-as-PDF" id="export-pdf" onclick="exportPage()">Save as PDF</a>
            </div>

        </div>
        
        <canvas style="display:none;" id="canvas" width="800" height="400"></canvas>
        <div style="display:none;" id="png-container"></div>
    </div>
   
    <div class="resultsDescription">
            <p>Ready for the next step?</p>
            <a href="https://free.assessment.discoveryourvalues.com/">Let's explore your personal values.</a>
    </div>


    <!-- Modal Start-->
  <!-- <div class="modal fade" id="email_modal" role="dialog"> -->
    <!-- <div class="modal-dialog"> -->

      <!-- Modal content-->
      <!-- <div class="modal-content" style="    max-width: 500px;margin: 0px auto;"> -->

        <!-- <div class="modal-body" style="    padding: 2rem 2rem 0.325rem;"> -->
        <!-- <label for="email" style="    font-size: 16px;margin: 0.25em 0px 1.7em;font-weight: 600;">Enter your email to see your results</label> -->
        <!-- <div class="form-group"> -->
            <!-- <input type="email" class="form-control" id="email" placeholder="Enter email" -->
                <!-- style="margin: 0em 0 1em;" -->
            <!-- > -->
            <!-- <div style="font-size: small;text-align: center;"> -->
              <!-- <input style="    top: 1px;position: relative; "type="checkbox" required="true" id="confirmTerms"> -->
                <!-- <span> -->
                  <!-- I accept the -->
                  <!-- <a href="https://www.podia.com/terms" target="_blank"> Terms of Service</a> and -->
                  <!-- <a href="https://www.podia.com/privacy" target="_blank"> Privacy Policy </a> -->
                <!-- </span> -->
            <!-- </div> -->
            <!-- <small id="email_error" style="color: red !important;" class="form-text text-muted"></small> -->

            <!-- <div style="margin-bottom: 20px;text-align: center;margin-top: 2rem;"> -->
            <!-- <button type="button" id="submit_email" class="btn btn-link px-2" -->
            <!-- style="margin: 0px auto;border: 1px solid gray;color: grey;"> -->
                <!-- See Your Results -->
            <!-- </button> -->
        <!-- </div> -->
        <!-- </div> -->
      <!-- </div> -->

    <!-- </div> -->
  <!-- </div> -->
    <!-- Modal End -->


</section>


<script type="text/javascript">
    //console.log(globalOptions);
    //console.log(typeof globalOptions);
    if (typeof globalOptions === "undefined"){
        console.log("1");
        window.location.replace("index.php");
    }
    // $(document).ready(function(){
    //     $('#email_modal').modal({"backdrop": "static", "keyboard": false});
    //     $('#email_modal').modal('hide');
    // });
</script>

<script type="text/javascript">
    
    console.log("options", globalOptions);
    console.log("Data", optionsObject);
    
    //****** */Sorting Result Array*****
    var resultsArray = optionsObject; // = sortObject(optionsObject);
    function addcolors(){
        var index = 0;
        var layer0Colors = [
            'rgba(244, 166, 154, 0.875)',
            'rgba(246, 195, 134, 0.875)',
            'rgba(255, 221, 149, 0.875)',
            'rgba(172, 183, 146, 0.875)',
            'rgba(168, 197, 172, 0.875)',
            'rgba(172, 224, 239, 0.875)',
            'rgba(182, 194, 226, 0.875)',
            'rgba(184, 155, 179, 0.875)'
        ]
        var layer0 = $('.layer-0')[0]
        console.log(layer0)

        layer0.childNodes.forEach(element => {
            console.log(element)   
            element.setAttribute('fill',layer0Colors[index])
            index++;
        })

        index = 0;
        var layer1Colors = [
            'rgba(237, 106, 86, 0.875)',
            'rgba(240, 155, 54, 0.875)',
            'rgba(255, 199, 78, 0.875)',
            'rgba(160, 180, 112, 0.875)',
            'rgba(110, 158, 117, 0.875)',
            'rgba(110, 158, 117, 0.875)',
            'rgba(134, 154, 207, 0.875)',
            'rgba(137, 88, 129, 0.875)'
        ]
        var layer1 = $('.layer-1')[0]
        console.log(layer1)
        layer1.childNodes.forEach(element => {
            console.log(element)   
            element.setAttribute('fill',layer1Colors[index])
            element.setAttribute('stroke-width','1px');
            element.setAttribute('stroke','#000000');
            element.setAttribute('opacity','0.3');
            index++;
        })

        var axis = $('#chart .axis')[0];
        axis.setAttribute('display','none')

        var axispath = $('#chart .axis path')[0];
        axispath.setAttribute('fill','none')
        axispath.setAttribute('stroke','#999')
        axispath.setAttribute('shape-rendering','crispEdges')

        var chartcircleouter = $("#chart circle.outer")[0]
        chartcircleouter.setAttribute('stroke','#aaa')
        chartcircleouter.setAttribute('stroke-dasharray','4, 4')
        

        index = 0
        var chart_tickcirles = $("#chart .tick-circles")[0]
        chart_tickcirles.childNodes.forEach(element => {
            console.log(element)   
            element.setAttribute('stroke','#ddd')
            element.setAttribute('stroke-dasharray','2, 2')
            index++;
        })
        
        index = 0
        var chart_text = $('#chart .labels')[0]
        chart_text.childNodes.forEach(element => {
            console.log(element)
            element.setAttribute('fill','#333')
            element.setAttribute('font-size','11px')
            element.setAttribute('font-weight','bold')
            index++;
        })
        

    }

    function makecanvas(){

        //Afzaals code
        var svg = document.querySelector('svg');
        console.log("svg", svg)
        var svgString = new XMLSerializer().serializeToString(svg);

        // var svg = $('.svg-container')[0].childNodes[0]
        // svg.setAttribute('xmlns','http://www.w3.org/2000/svg')
        // svg.setAttribute('xmlns:xlink','http://www.w3.org/1999/xlink')
        // console.log(svg.outerHTML)
        // var p = new DOMParser()
        // var svgxml = p.parseFromString(svg.outerHTML, "application/xml")
        // var svgString = new XMLSerializer().serializeToString(svgxml);

        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var DOMURL = self.URL || self.webkitURL || self;
        var img = new Image();
        
        var svgblob = new Blob([svgString], {type: "image/svg+xml;charset=utf-8"});
        
        //var svgblob = "data:image/svg+xml;base64," + btoa("<svg>...");
        
        var url = DOMURL.createObjectURL(svgblob);
        //var url = DOMURL.createObjectURL(svgxml);
        img.onload = function() {
            ctx.drawImage(img, 0, 0);
            var png = canvas.toDataURL("image/png");
            document.querySelector('#png-container').innerHTML = '<img src="'+png+'"/>';
            DOMURL.revokeObjectURL(png);
        };
        img.src = url;
        var imgData=ctx.getImageData(0,0,canvas.width,canvas.height);
        var data=imgData.data;
        for(var i=0;i<data.length;i+=4){
            if(data[i]<255){
                data[i]=255;
                data[i+1]=255;
                data[i+2]=255;
                data[i+3]=255;
            }
        }
        ctx.putImageData(imgData,0,0);
        console.log(img)
    }

    function exportPage() {
        
        var doc = new jsPDF('l', 'mm', 'a4');
        var img = document.querySelector('img');
        console.log(img)
        //doc.internal.scaleFactor = 1.55;
        doc.addImage(img,  "JPEG", 20, 30, 250,135);
        doc.setFontSize(20);
        doc.setFontType("bold");
        doc.text('Your Results', 130, 20);

        doc.setFontSize(18);
        doc.text('Life Domain', 150, 45);
        doc.text('Now', 210, 45);
        doc.text('Future', 235, 45);
        doc.text('Gap', 260, 45);

        doc.setFontType("normal");
        doc.setFontSize(15);
        var x = 12;
        var table = $('table tbody');
        table.find('tr').each(function (i) {
            var $tds = $(this).find('td'),
            life_domain = $tds.eq(0).text(),
            now = $tds.eq(1).text(),
            future = $tds.eq(2).text(),
            gap = $tds.eq(3).text();
            doc.text(life_domain, 150, 45+x);
            doc.text(now, 210, 45+x);
            doc.text(future, 235, 45+x);
            doc.text(gap, 260, 45+x);
            x = x + 12;
        });
        doc.setFontType("bold");
        doc.setFontSize(19);
        doc.text("Ready for the next step?", 108, 175);
        doc.setFontType("normal");
        doc.text("Let's explore your personal values.", 95, 190);
        doc.save('Wheel-of-Life.pdf');

    }

    function removeSkippedQuestions(){
        for (let i = 0; i < optionsObject.length; i++){
            console.log(optionsObject);
            if(optionsObject[i].now == -1 || optionsObject[i].future == -1){
                let removed = optionsObject.splice(i, 1);
                i = -1;
            } else {
                console.log("no problem");
            }
        }
    }
    removeSkippedQuestions();

    function sortObject(obj) {
        var arr = [];
        var prop;
        for (prop in obj) {
            if (obj.hasOwnProperty(prop)) {
                arr.push(obj[prop]);
            }
        }
        arr.sort(function (a, b) {
            return b.diff - a.diff;
        });
        return arr; // returns array
    }
    
    function clearTable(table) {
        table.empty();
    }

    function fillTable(table) {
        addTableHeader(table);
        addTableBody(table);
        console.log(table);
    }

    function addTableHeader(table) {
        let header = ["Life Domain", "Now", "Future", "Gap"];
        let row = $('<tr>');

        for (let i = 0; i < header.length; i++) {
            let column = $('<th>').text(header[i]);
            row.append(column);
        }
        let thead = $('<thead>')
        thead.append(row);

        table.append(thead);

    }


    function addTableBody(table) {
        let tbody = $('<tbody>')
        
        tbody.append(tbody);

        for (let i = 0; i < resultsArray.length; i++) {
            let row = $('<tr>');
            let colName = resultsArray[i];



            row.append($('<td>').text(colName.SectionName));
            row.append($('<td>').text(colName.now));
            row.append($('<td>').text(colName.future));
            row.append($('<td>').text(colName.diff));

            tbody.append(row);
        }

        table.append(tbody);


    }

    function createNowChartData(){
        let nowData = {}
        for (let i = 0; i < resultsArray.length; i++) {
            let colName = resultsArray[i]
            nowData[colName.SectionName] = colName.now
        }
        console.log(nowData)
        return nowData
    }

    function createFutureChartData(){
        let futureData = {}
        for (let i = 0; i < resultsArray.length; i++) {
            let colName = resultsArray[i]
            futureData[colName.SectionName] = colName.future
        }
        console.log(futureData)
        return futureData
    }

    function createDataforChart(nowData, futureData){
        let ChartData = [
            {
                data:{}
            }, 
            {
                data:{}
            },
        ];

        
        ChartData[0].data = nowData;
        ChartData[1].data = futureData;
        

        console.log(ChartData)
        return ChartData
    }

    function createChart(chartData){
        console.log('creating Chart')
        
		var chart = radialBarChart()
			.barHeight(180)
			.reverseLayerOrder(true)
			.capitalizeLabels(true)
			.domain([0,10])
			.tickValues([1,2,3,4,5,6,7,8,9,10])
			.tickCircleValues([1,2,3,4,5,6,7,8,9,10]);
        d3.select('#chart')
            .append("div")
            .classed("svg-container", true) //container class to make it responsive
//            .append("svg")
            .datum(chartData)
            .call(chart)
            //responsive SVG needs these 2 attributes and no width and height attr
            //.attr("preserveAspectRatio", "xMinYMin meet")
            //.attr("viewBox", "0 0 350 350")
            // //class to make it responsive
            // .classed("svg-content-responsive", true); 

            var svg = $('.svg-container svg')[0];
            svg.setAttribute("preserveAspectRatio", "xMinYMin meet")
            svg.setAttribute("viewBox", "0 0 400 400")
        
        

    }
    
    function startResultPage() {
        
        let NowData = createNowChartData();
        let FutureData = createFutureChartData();
        let CHARTDATA = createDataforChart(NowData, FutureData);
        createChart(CHARTDATA);
        addcolors();
        

        resultsArray = sortObject(optionsObject);
        let selectedTable = $("#resultsTable");
        console.log(selectedTable);
        clearTable(selectedTable);
        fillTable(selectedTable);

        
    }
    startResultPage()

</script>

<script type="text/javascript">
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $(document).ready(function(){
        $("#submit_email").click(function(){
            let email = $('#email')[0].value;

            if ( email != "" && isEmail(email) ) {
                let checkbox = $('#confirmTerms');
                if (checkbox.is(':checked')) {
                    $.ajax ({
                        cache: false,
                        async: true,
                        url: 'save.php',
                        data: {
                            email: email,
                            resultsArray: JSON.stringify(resultsArray)
                        },
                        method: 'POST',
                        success: function (data){
                            console.log("Data:", data);
                            data = JSON.parse(data);
                            let e = "email=" + (data['email']);
                            console.log(e);
                            $.ajax({
                                type: "POST",
                                url: 'https://hooks.zapier.com/hooks/catch/2680951/xram3a/',
                                data: e,
                                dataType: "json"
                            });
                        }
                    });
                    $('#email_modal').modal('hide');
                    $('#email_error').html(" ");
                    makecanvas();
                }
                else {
                    console.log('unchecked');
                    $('#email_error').html("Please accept our Terms of Services and Privacy Policy");
                }
            } else if (email == "") {
                $('#email_error').html("Please enter a email address");
            } else if ( !(isEmail(email)) ) {
                $('#email_error').html("Please enter a valid email address");
            }

        });

    });
</script>


<script type="text/javascript">
    

</script>

<?php $footer_id = "results"; ?>



<?php require_once 'footer.php'?>