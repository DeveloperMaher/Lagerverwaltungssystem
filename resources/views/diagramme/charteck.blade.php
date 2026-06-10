

<div class="form-control position-relative border border-secondary mb-5">
    <canvas id="myChart3" style='cursor: pointer;'></canvas>
    <!-- start button for third chart -->
    <div class="btn-add">
        <button type= "button" class= 'open-fenster-eck' 
        data-toggle="tooltip" data-placement="top"
        title="Mindestbestandswert (Diagramm der Eckpfosten) zurückzusetzen">
        <i class="fa fa-user-edit"></i></button>
    </div>
    <!-- End button for third chart -->
</div>
     <!-- start form Eckpfostendiagramm -->
<div class="change-value-chart-eck" id ="change-value-chart">
    <h3><i class="fa fa-chart-bar"></i>&nbsp;&nbsp;Eckpfosten Diagramm</h3>
    <form action="{{url('diagramme/charteck')}}" method="post">
        @csrf
        @method('post')
        <input class="input-chart-three" min= "1" type="number" id="wert-three" name="chart_three"
        data-toggle="tooltip" data-placement="top" title="Nur Nummer erlaubt" placeholder="den Wert eingeben" required>
        <div class="btns">
            <button class = "btn btn-success p-1 change-three" type="submit" name="submit_three">ändern</button>
            <button class = "btn btn-outline-success p-1 default" type="submit" name="reset_three" onclick= "resetThresholdThree();">standard</button>
        </div>
    </form>
    <div class="paragraphs">
        <p class=""><strong>*</strong> Pflichtfeld</p>
        <p class=""><strong>*</strong> Der Wert, bei dem die Farbe der Spalte rot erscheinen soll, was auf Materialmangel im Lager hinweist</p>
        <p class=""><strong>*</strong> Der aktuelle Mindestbestandswert ist : <strong>{{$threshold_three}}</strong></p>
    </div>
</div>
<!-- end form Eckpfostendiagramm -->

<script>
    const ctx_3 = document.getElementById('myChart3');
       ctx_3.style.height = '500px';  
       let massPopChart3 = new Chart(ctx_3, {
            
           type: 'bar',
           data: {
               labels:['Eck.830', 'Eck.1030','Eck.1230', 'Eck.1430', 'Eck.1630','Eck.1830','Eck.2030'],
               datasets:[{
                   label:'Eckpfosten Anthrazit RAL 7016',

                   // fetch all numbers of materials from database 
                   data:[
                        {{ mattenDbNr("Eckpfosten","Anthrazit RAL 7016","0830") }},
                        {{ mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1030") }},
                        {{ mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1230") }},
                        {{ mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1430") }},
                        {{ mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1630") }},
                        {{ mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1830") }},
                        {{ mattenDbNr("Eckpfosten","Anthrazit RAL 7016","2030") }}
                    ],
                
                   // Change the background of the columns to red if the number is less than 10
                   backgroundColor:[
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Anthrazit RAL 7016","0830"), 7016, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1030"), 7016, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1230"), 7016, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1430"), 7016, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1630"), 7016, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Anthrazit RAL 7016","1830"), 7016, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Anthrazit RAL 7016","2030"), 7016, $threshold_three) }}'
                   ],
                   borderWidth:1,
                   borderColor:'#333',
                   hoverBorderWidth:2,
                   hoverBorderColor:'#000',
                   hoverBackground:'#eee',
               },{
                   label:'Eckpfosten Grün RAL 6005',
                   data:[
                        {{ mattenDbNr("Eckpfosten","Grün RAL 6005","0830") }},
                        {{ mattenDbNr("Eckpfosten","Grün RAL 6005","1030") }},
                        {{ mattenDbNr("Eckpfosten","Grün RAL 6005","1230") }},
                        {{ mattenDbNr("Eckpfosten","Grün RAL 6005","1430") }},
                        {{ mattenDbNr("Eckpfosten","Grün RAL 6005","1630") }},
                        {{ mattenDbNr("Eckpfosten","Grün RAL 6005","1830") }},
                        {{ mattenDbNr("Eckpfosten","Grün RAL 6005","2030") }}
                    ],
                  
                   backgroundColor:[
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Grün RAL 6005","0830"), 6005, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Grün RAL 6005","1030"), 6005, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Grün RAL 6005","1230"), 6005, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Grün RAL 6005","1430"), 6005, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Grün RAL 6005","1630"), 6005, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Grün RAL 6005","1830"), 6005, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Grün RAL 6005","2030"), 6005, $threshold_three) }}'
                   ],
                   borderWidth:1,
                   borderColor:'#333',
                   hoverBorderWidth:2,
                   hoverBorderColor:'#000',
                   hoverBackground:'transparent',
                   cursor:'pointer',
               },{
                   label:'Eckpfosten Feuerverzinkt',
                   data:[
                        {{ mattenDbNr("Eckpfosten","Feuerverzinkt","0830") }},
                        {{ mattenDbNr("Eckpfosten","Feuerverzinkt","1030") }},
                        {{ mattenDbNr("Eckpfosten","Feuerverzinkt","1230") }},
                        {{ mattenDbNr("Eckpfosten","Feuerverzinkt","1430") }},
                        {{ mattenDbNr("Eckpfosten","Feuerverzinkt","1630") }},
                        {{ mattenDbNr("Eckpfosten","Feuerverzinkt","1830") }},
                        {{ mattenDbNr("Eckpfosten","Feuerverzinkt","2030") }}
                    ],
            
                   backgroundColor:[
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Feuerverzinkt","0830"), 0, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Feuerverzinkt","1030"), 0, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Feuerverzinkt","1230"), 0, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Feuerverzinkt","1430"), 0, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Feuerverzinkt","1630"), 0, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Feuerverzinkt","1830"), 0, $threshold_three) }}',
                        '{{ bgColorThree(mattenDbNr("Eckpfosten","Feuerverzinkt","2030"), 0, $threshold_three) }}'
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
                        text: 'Höhe der Eckpfosten',
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
                        text: 'Anzahl der Eckpfosten',
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
                                yMin: <?php echo $threshold_three;?>,
                                yMax: <?php echo $threshold_three;?>,
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
                       text: 'Die Anzahl der Eckpfosten im Lager <?php echo date("Y");?>',
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
             
           }
       });
</script>