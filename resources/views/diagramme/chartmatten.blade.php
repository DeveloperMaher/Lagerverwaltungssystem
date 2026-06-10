

<div class="form-control position-relative border border-secondary mb-5">
    <canvas id="myChart2" style='cursor: pointer;'></canvas>
     <!-- start button for Second chart -->
     <div class="btn-add">
        <button type= "button" class= 'open-fenster-ma' 
        data-toggle="tooltip" data-placement="top"
        title="Mindestbestandswert (Diagramm der Matten) zurückzusetzen">
        <i class="fa fa-user-edit"></i></button>
    </div>
    <!-- End button for Second chart -->
</div>
   <!-- start form Mattendiagramm -->
<div class="change-value-chart-ma" id ="change-value-chart">
    <h3><i class="fa fa-chart-bar"></i>&nbsp;&nbsp;Matten Diagramm</h3>
    <form action="{{url('diagramme/chartmatten')}}" method="post">
        @csrf
        @method('post')
        <input class="input-chart-two" min= "1" type="number" id="wert-two" name="chart_two"
        data-toggle="tooltip" data-placement="top" title="Nur Nummer erlaubt" placeholder="den Wert eingeben" required>
        <div class="btns">
            <button class = "btn btn-success p-1 change-two" type="submit" name="submit_two">ändern</button>
            <button class = "btn btn-outline-success p-1 default" type="submit" name="reset_two" onclick= "resetThresholdTwo();">standard</button>
        </div>
    </form>
    <div class="paragraphs">
        <p class=""><strong>*</strong> Pflichtfeld</p>
        <p class=""><strong>*</strong> Der Wert, bei dem die Farbe der Spalte rot erscheinen soll, was auf Materialmangel im Lager hinweist</p>
        <p class=""><strong>*</strong> Der aktuelle Mindestbestandswert ist : <strong>{{$threshold_two}}</strong></p>
    </div>
</div>

<script>
      const ctx_2 = document.getElementById("myChart2");
        ctx_2.style.height = '500px';
        let massPopChart2 = new Chart(ctx_2, {
            
        type: 'bar',
        data: {
            labels:['Mat.830', 'Mat.1030','Mat.1230', 'Mat.1430', 'Mat.1630','Mat.1830','Mat.2030'],
            datasets:[{
                label:'Matten Anthrazit RAL 7016',
                data:[
                        {{ mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "0830") }},
                        {{ mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1030") }},
                        {{ mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1230") }},
                        {{ mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1430") }},
                        {{ mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1630") }},
                        {{ mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1830") }},
                        {{ mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "2030") }},
                    ],
           
                backgroundColor:[
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "0830"), 7016, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1030"), 7016, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1230"), 7016, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1430"), 7016, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1630"), 7016, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "1830"), 7016, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Anthrazit RAL 7016", "2030"), 7016, $threshold_two) }}',
                 ],
                borderWidth:1,
                borderColor:'#333',
                hoverBorderWidth:2,
                hoverBorderColor:'#000'
            },{
                label:'Matten Grün RAL 6005',
                data:[
                    {{ mattenDbNr("matten 8/6/8", "Grün RAL 6005", "0830") }},
                    {{ mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1030") }},
                    {{ mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1230") }},
                    {{ mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1430") }},
                    {{ mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1630") }},
                    {{ mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1830") }},
                    {{ mattenDbNr("matten 8/6/8", "Grün RAL 6005", "2030") }},
                  ],
                  
                
                backgroundColor: [
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1030"), 6005, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Grün RAL 6005", "0830"), 6005, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1230"), 6005, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1430"), 6005, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1630"), 6005, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Grün RAL 6005", "1830"), 6005, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Grün RAL 6005", "2030"), 6005, $threshold_two) }}',
                    ],
                borderWidth:1,
                borderColor:'#333',
                hoverBorderWidth:2,
                hoverBorderColor:'#000'
            },{
                label:'Matten Feuerverzinkt',
                data:[
                    {{ mattenDbNr("matten 8/6/8", "Feuerverzinkt", "0830") }},
                    {{ mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1030") }},
                    {{ mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1230") }},
                    {{ mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1430") }},
                    {{ mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1630") }},
                    {{ mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1830") }},
                    {{ mattenDbNr("matten 8/6/8", "Feuerverzinkt", "2030") }},
                ],
                backgroundColor:[
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Feuerverzinkt", "0830"), 0, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1030"), 0, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1230"), 0, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1430"), 0, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1630"), 0, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Feuerverzinkt", "1830"), 0, $threshold_two) }}',
                    '{{ bgColorTwo(mattenDbNr("matten 8/6/8", "Feuerverzinkt", "2030"), 0, $threshold_two) }}',
                  ],
                borderWidth:1,
                borderColor:'#333',
                hoverBorderWidth:2,
                hoverBorderColor:'#000',
                hoverBackground:'transparent',
                cursor:'pointer',
            }]
        },
           
        options: {
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
                    text: 'Höhe der Matten',
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
                    text: 'Anzahl der Matten',
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
                        yMin: <?php echo $threshold_two;?>,
                        yMax: <?php echo $threshold_two;?>,
                        borderColor: '#f00',
                        borderWidth: 1,
                        label: {
                            display: true,
                            color: '#fff',
                            backgroundColor: '#d8170a',
                            content: 'Mindestbestandswert',
                            enabled: true,
                            position: 'center',
                            font:{
                                size: 11,
                            },  
                        }
                    },
                  },
                },
                title:{
                    display:true,
                    text: 'Die Anzahl der Matten im Lager <?php echo date("Y");?>',
                    color:'#666',
                    padding:30,
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
                            size: 14,
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
        }
        });
</script>