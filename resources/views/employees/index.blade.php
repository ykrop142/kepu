<!DOCTYPE html>
<html>
<head>
    <title>Calc</title>

    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.min.css')}}">

    <!-- Script -->
    <script src="{{asset('jquery/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}" type="text/javascript"></script>
    <style>
        body{
            background-color: #540988;
        }
        text{
           color: #616161;
        }
        .slidecontainer {
            width: 50%; /* Ширина  контейнера */
        }

        .slider {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 25px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider:hover {
            opacity: 1;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            background: #4CAF50;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px; /* Установите определенную ширину обработчика ползунка */
            height: 25px; /* Высота обработчика подзунка */
            background: #4CAF50; /* Зеленый фон */
            cursor: pointer; /* Курсор при наведении */
        }

    </style>

</head>
<body>
<table style="margin:auto;
              margin-top:200px;">
    <tr>
        <td><h3 style="color: #616161;">Количество предлагаемых предметов </h3></td>
        <td><h3 style="color: #616161;"> Название предлагаемого предмета </h3></td>
        <td><h3 style="color: #616161;"> Поинты за 1ед</h3></td>
    </tr>
    <tr>
        <td><h3><input type="text" id='kol1' value="0" onchange=editnumb()></h3></td>
        <td><h3><input type="text" id='employee_search1' placeholder="Алмаз"></h3></td>
        <td><h3><input type="text" id='employeepoints1' readonly></h3></td>
    </tr>
    <tr>
        <td><h3 style="color: #616161;">Количество покупаемых предметов </h3></td>
        <td><h3 style="color: #616161;"> Название покупаемого предмета </h3></td>
        <td><h3 style="color: #616161;"> Поинты за 1ед</h3></td>
    </tr>
    <tr>
        <td><h3><input type="text" id='employeepoints3'  readonly></h3></td>
        <td><h3><input type="text" id='employee_search2' placeholder="Ультиматка"></h3></td>
        <td><h3><input type="text" id='employeepoints2'  readonly></h3></td>
    </tr>
    <tr>
        <td colspan="3"><h3 style="color: #616161;">Наценка в %</h3></td>
    </tr>
    <tr>
        <td colspan="3"><h3><div class="slidecontainer">
                <input type="range" min="0" max="20" value="0" class="slider" id="myRange" onchange=editnumb()>
                <output type="range"  class="slider" id="demo"/>
            </div></h3></td>
    </tr>
</table>
<text style="position: absolute;
right: 0px;
bottom: 0px;">by ykrop142</text>
<script type="text/javascript">

    // CSRF T123oken
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

        $( "#employee_search1" ).autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url:"{{route('employees.getEmployees')}}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#employee_search1').val(ui.item.label); // display the selected text
                $('#employeepoints1').val(ui.item.value); // save selected id to input
                return false;
            }
        });

        $( "#employee_search2" ).autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url:"{{route('employees.getEmployees')}}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#employee_search2').val(ui.item.label); // display the selected text
                $('#employeepoints2').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });

    let slider = document.getElementById("myRange");
    let output = document.getElementById("demo");
    output.innerHTML = slider.value; // Отображение значения ползунка по умолчанию
    window.e =slider.value;
    window.e =Number(window.e);
    // Обновите текущее значение ползунка (п123ри каждом перетаскивании маркера ползунка)
    slider.oninput = function() {
        output.innerHTML = this.value;
        window.e =output.innerHTML;
        window.e =Number(window.e);
    }

    function editnumb(){
        let a=document.getElementById('employeepoints1').value;
        let b=document.getElementById('employeepoints2').value;
        let c=document.getElementById('kol1').value;
        //let e= document.getEleme123321ntById('polz').val123ue;
        if(a == ''||b == ''){

         }
         else
             {
                 let d=Math.floor(((a * c) / b));
                  if (Number.isInteger(((a * c) / b))) {
                      $('#employeepoints3').val(Math.round((d+(d*(e/100))))+'шт');
                  }else
                  {
                      if (d==0){
                          let x=(b/a);
                          x=Math.round(x);
                          $('#kol1').val(x);
                          $('#employeepoints3').val(Math.round((1+(1*(e/100))))+'шт');
                      }else{
                          d=d+1;
                          let x=((b*d)/a);
                          x=Math.round(x);
                          $('#kol1').val(x);
                          $('#employeepoints3').val(Math.round((d+(d*(e/100))))+'шт');
                      }
                  }
             };
    };


</script>
</body>
</html>
