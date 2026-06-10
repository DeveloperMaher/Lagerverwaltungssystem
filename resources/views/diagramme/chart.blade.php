
@include('diagramme/functions')  

@include('head')  

    <!-- custum CSS files -->
    <link rel="stylesheet" href="{{ asset('css/chart.css')}}">
</head>
<body>

    @include('subheader')

    <div class="text-center mb-4 title">
        <h3>Diagramme</h3>
        <p class="text-muted">Diagramme geben Auskünfte über die Materialien (Pfosten, Matten und Eckpfosten) im Lager,
            <strong>ausschließlich</strong> die Materialien der Kunden
        </p>
    </div>
  
    <div class="px-5">
        <div class="form-control position-relative border border-secondary mt-5 mb-5">
            <canvas id="myChart" style='cursor: pointer;'></canvas>
            <!-- start button for first chart -->
            <div class="btn-add">
                <button type= "button" class= 'open-fenster-pf' 
                data-toggle="tooltip" data-placement="top"
                title="Mindestbestandswert (Diagramm der Pfosten) zurückzusetzen">
                <i class="fa fa-user-edit"></i></button>
            </div>
            <!-- End button for first chart -->
        </div>
        <!-- start form pfostendiagramm -->
        <div class="change-value-chart-pf" id ="change-value-chart">
            <h3><i class="fa fa-chart-bar"></i>&nbsp;&nbsp;Pfosten Diagramm</h3>

            <form action="{{url('diagramme/chart')}}" method="post">
                @csrf
                @method('post')
                <input class="input-chart-one" min= "1" type="number" id="wert-one" name="chart_one" 
                data-toggle="tooltip" data-placement="top" title="Nur Nummer erlaubt" placeholder="den Wert eingeben" required>
                <div class="btns">
                    <button class = "btn btn-success p-1 change-one" type="submit" name="submit_one">ändern</button>
                    <button class = "btn btn-outline-success p-1 default" type="submit" name="reset_one" onclick= "resetThresholdOne();">standard</button>
                </div>
            </form>

            <div class="paragraphs">
                <p><strong>*</strong> Pflichtfeld</p>
                <p><strong>*</strong> Der Wert, bei dem die Farbe der Spalte rot erscheinen soll, was auf Materialmangel im Lager hinweist</p>
                <p><strong>*</strong> Der aktuelle Mindestbestandswert ist : <strong>{{$threshold_one}}</strong></p>
            </div>

        </div>
        <!-- end form pfostendiagramm -->
        
        @include('diagramme/chartmatten')     
        @include('diagramme/charteck')     
        
        <!-- ------------------------------------------------------------------------------ -->
        <div class="d-flex justify-content-center">
            <a href= "{{url('home')}}" id="closeChart" class="btn btn-danger p-1 mb-4" 
            data-toggle="tooltip" data-placement="top" title="schließen und zurück zur Startseite">schließen</a>
        </div>
    </div>
    
    

    <!-- Start Footer Section -->  
    @include('footer')                       
    <!-- End Footer Section -->  

    <script src="{{asset('js/script.js')}}"></script>


    <script>
        function resetThresholdOne() {
            document.getElementById("wert-one").value = "10";
        }
        function resetThresholdTwo() {
            document.getElementById("wert-two").value = "10";
        }
        function resetThresholdThree() {
            document.getElementById("wert-three").value = "3";
        }
    </script>

    <script>
        const ctx = document.getElementById('myChart');
        ctx.style.height = '500px';  
        let massPopChart = new Chart(ctx, {
        
            type: 'bar',
            data: {
               labels:['Pf.830', 'Pf.1030','Pf.1230', 'Pf.1430', 'Pf.1630','Pf.1830','Pf.2030'],
               datasets:[{
                   label:'Pfosten Anthrazit RAL 7016',

                   // fetch all numbers of materials from database 
                   data: [
                      {{ mattenDbNr("pfosten", "Anthrazit RAL 7016", "0830") }},
                      {{ mattenDbNr("pfosten", "Anthrazit RAL 7016", "1030") }},
                      {{ mattenDbNr("pfosten", "Anthrazit RAL 7016", "1230") }},
                      {{ mattenDbNr("pfosten", "Anthrazit RAL 7016", "1430") }},
                      {{ mattenDbNr("pfosten", "Anthrazit RAL 7016", "1630") }},
                      {{ mattenDbNr("pfosten", "Anthrazit RAL 7016", "1830") }},
                      {{ mattenDbNr("pfosten", "Anthrazit RAL 7016", "2030") }}
                    ],
                
                   // Change the background of the columns to red if the number is less than 10
                   backgroundColor: [
                        '{{ bgColorOne(mattenDbNr("pfosten", "Anthrazit RAL 7016", "0830"), 7016, $threshold_one) }}',
                        '{{ bgColorOne(mattenDbNr("pfosten", "Anthrazit RAL 7016", "1030"), 7016, $threshold_one) }}',
                        '{{ bgColorOne(mattenDbNr("pfosten", "Anthrazit RAL 7016", "1230"), 7016, $threshold_one) }}',
                        '{{ bgColorOne(mattenDbNr("pfosten", "Anthrazit RAL 7016", "1430"), 7016, $threshold_one) }}',
                        '{{ bgColorOne(mattenDbNr("pfosten", "Anthrazit RAL 7016", "1630"), 7016, $threshold_one) }}',
                        '{{ bgColorOne(mattenDbNr("pfosten", "Anthrazit RAL 7016", "1830"), 7016, $threshold_one) }}',
                        '{{ bgColorOne(mattenDbNr("pfosten", "Anthrazit RAL 7016", "2030"), 7016, $threshold_one) }}',
                    ],

                   borderWidth:1,
                   borderColor:'#333',
                   hoverBorderWidth:2,
                   hoverBorderColor:'#000',
                   hoverBackground:'#eee',
                 },{
                   label:'Pfosten Grün RAL 6005',
                   data:[
                     {{mattenDbNr("pfosten","Grün RAL 6005","0830")}},
                     {{mattenDbNr("pfosten","Grün RAL 6005","1030")}},
                     {{mattenDbNr("pfosten","Grün RAL 6005","1230")}},
                     {{mattenDbNr("pfosten","Grün RAL 6005","1430")}},
                     {{mattenDbNr("pfosten","Grün RAL 6005","1630")}},
                     {{mattenDbNr("pfosten","Grün RAL 6005","1830")}},
                     {{mattenDbNr("pfosten","Grün RAL 6005","2030")}}
                    ],
                  
                   backgroundColor: [
                    '{{ bgColorOne(mattenDbNr("pfosten", "Grün RAL 6005", "0830"), 6005, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Grün RAL 6005", "1030"), 6005, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Grün RAL 6005", "1230"), 6005, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Grün RAL 6005", "1430"), 6005, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Grün RAL 6005", "1630"), 6005, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Grün RAL 6005", "1830"), 6005, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Grün RAL 6005", "2030"), 6005, $threshold_one) }}',
                    ],

                   borderWidth:1,
                   borderColor:'#333',
                   hoverBorderWidth:2,
                   hoverBorderColor:'#000',
                   hoverBackground:'transparent',
                   cursor:'pointer',
                 },{
                   label:'Pfosten Feuerverzinkt',
                   data: [
                        {{ mattenDbNr("pfosten", "Feuerverzinkt", "0830") }},
                        {{ mattenDbNr("pfosten", "Feuerverzinkt", "1030") }},
                        {{ mattenDbNr("pfosten", "Feuerverzinkt", "1230") }},
                        {{ mattenDbNr("pfosten", "Feuerverzinkt", "1430") }},
                        {{ mattenDbNr("pfosten", "Feuerverzinkt", "1630") }},
                        {{ mattenDbNr("pfosten", "Feuerverzinkt", "1830") }},
                        {{ mattenDbNr("pfosten", "Feuerverzinkt", "2030") }}
                    ],

            
                   backgroundColor:[
                    '{{ bgColorOne(mattenDbNr("pfosten", "Feuerverzinkt", "0830"), 0, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Feuerverzinkt", "1030"), 0, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Feuerverzinkt", "1230"), 0, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Feuerverzinkt", "1430"), 0, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Feuerverzinkt", "1630"), 0, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Feuerverzinkt", "1830"), 0, $threshold_one) }}',
                    '{{ bgColorOne(mattenDbNr("pfosten", "Feuerverzinkt", "2030"), 0, $threshold_one) }}',
                 ],
                   borderWidth:1,
                   borderColor:'#333',
                   hoverBorderWidth:2,
                   hoverBorderColor:'#000',
                   hoverBackground:'transparent',
                   cursor:'pointer',
               }],
           },
 
           options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
             
                scales: {
                    x: {
                        grid: {
                        color: '#999',
                        borderColor: 'grey',
                        tickColor: 'grey'
                        },
                        title: {
                        color: '#333',
                        display: true,
                        text: 'Höhe der Pfosten',
                        font: {
                                size: 14
                            }
                        },
                    },
                    y: {
                        
                        grid: {
                        color: '#ccc',
                        borderColor: 'grey',
                        tickColor: 'grey'
                        },
                        title: {
                        color: '#333',
                        display: true,
                        text: 'Anzahl der Pfosten',
                        font: {
                                size: 14
                            }
                        },
                        
                    },
                 },
              
                responsive: true,
                maintainAspectRatio: false,
                height: 400,
                elements: {
                    line: {
                        backgroundColor: '#f00',
                    },
                    bar: {
                        borderColor: '#ff0000'
                    },
                },

               plugins:{
                    annotation: {
                        annotations: {
                            line: {
                                type: 'line',
                                yMin: <?php echo $threshold_one;?>,
                                yMax: <?php echo $threshold_one;?>,
                                borderColor: '#f00',
                                borderWidth: 1,
                                label: {
                                    display: true,
                                    color: '#fff',
                                    backgroundColor: '#d8170a',
                                    content: 'Mindestbestandswert',
                                    enabled: true,
                                    shadowBlur: 0.5,
                                 
                                    position: 'center',
                                    font:{
                                        size: 11,
                                    },  
                                },
                            },
                        },
                    },
                    title:{
                       display:true,
                       text: 'Die Anzahl der Pfosten im Lager <?php echo date("Y");?>',
                       padding:30,
                       color:'#666',
                       font: {
                        size: 20,
                       },
                    },
                    legend:{
                        display:true,
                        position:'bottom',
                        labels:{
                            color:'#333',
                            boxWidth:20,
                            padding: 25,
                            font:{
                                size: 13,
                            },    
                        },
                     },
                     tooltip:{
                        enabled:true,
                        bodyColor: '#fff',
                        padding: 10,
                        boxPadding:10,
                        borderWidth: 2,
                        borderColor: "#333",
                        titleColor:'#fff',
                        titleFontSize:15,
                        bodyFontColor:'#000',
                        mode:'nearest'
                    },
               },
            
               layout:{
                   padding:{
                       left:50,
                   }
               },
           },
        });

    </script>
   
    <script>
        const inputValueChart = document.querySelector('.input-chart-one');
        const changeValueBtn = document.querySelector('.change-one');
        const inputValueChartTwo = document.querySelector('.input-chart-two');
        const changeValueBtnTwo = document.querySelector('.change-two');
        const inputValueChartThree = document.querySelector('.input-chart-three');
        const changeValueBtnThree = document.querySelector('.change-three');
        changeValueBtn.disabled = true;
        changeValueBtnTwo.disabled = true;
        changeValueBtnThree.disabled = true;
        
        inputValueChart.addEventListener('keyup', ()=> {
            if(inputValueChart.value == ''){
                changeValueBtn.disabled= true;
            }else {
                changeValueBtn.disabled= false;
            }
        });
        inputValueChartTwo.addEventListener('keyup', ()=> {
            if(inputValueChartTwo.value == ''){
                changeValueBtnTwo.disabled= true;
            }else {
                changeValueBtnTwo.disabled= false;
            }
        });
        inputValueChartThree.addEventListener('keyup', ()=> {
            if(inputValueChartThree.value == ''){
                changeValueBtnThree.disabled= true;
            }else {
                changeValueBtnThree.disabled= false;
            }
        });
       

        const openFenster = document.querySelector('.open-fenster-pf');
        const openFensterMa = document.querySelector('.open-fenster-ma');
        const openFensterEck = document.querySelector('.open-fenster-eck');
        const btnAdd = document.querySelector('.btn-add');
        const fenster = document.querySelector('.change-value-chart-pf');
        const fensterMa = document.querySelector('.change-value-chart-ma');
        const fensterEck = document.querySelector('.change-value-chart-eck');
      
        let isFensterDisplayed = false;

        openFenster.addEventListener('click', () => {
        if (isFensterDisplayed) {
            openFenster.setAttribute('title', 'Klicken Sie hier, um den Mindestbestandswert (Diagramm der Pfosten) zurückzusetzen');
            fenster.style.visibility = 'hidden'; 
            isFensterDisplayed = false;
            openFenster.innerHTML ='<i class="fa fa-user-edit"></i>';
        } else {
            openFenster.setAttribute('title', 'Klicken Sie hier, um das Fenster zu schließen');
            fenster.style.visibility = 'visible';
            isFensterDisplayed = true;
            openFenster.innerHTML ='<i class="fa fa-times"></i>';
        }
        });

        openFensterMa.addEventListener('click', () => {
        if (isFensterDisplayed) {
            openFensterMa.setAttribute('title', 'Klicken Sie hier, um den Mindestbestandswert (Diagramm der Matten) zurückzusetzen');
            fensterMa.style.visibility = 'hidden'; 
            isFensterDisplayed = false;
            openFensterMa.innerHTML ='<i class="fa fa-user-edit"></i>';
        } else {
            openFensterMa.setAttribute('title', 'Klicken Sie hier, um das Fenster zu schließen');
            fensterMa.style.visibility = 'visible';
            isFensterDisplayed = true;
            openFensterMa.innerHTML ='<i class="fa fa-times"></i>';
        }
        });

        openFensterEck.addEventListener('click', () => {
        if (isFensterDisplayed) {
            openFensterEck.setAttribute('title', 'Klicken Sie hier, um den Mindestbestandswert (Diagramm der Eckpfosten) zurückzusetzen');
            fensterEck.style.visibility = 'hidden'; 
            isFensterDisplayed = false;
            openFensterEck.innerHTML ='<i class="fa fa-user-edit"></i>';
        } else {
            openFensterEck.setAttribute('title', 'Klicken Sie hier, um das Fenster zu schließen');
            fensterEck.style.visibility = 'visible';
            isFensterDisplayed = true;
            openFensterEck.innerHTML ='<i class="fa fa-times"></i>';
        }
        });

    </script>
    
</body>
</html>