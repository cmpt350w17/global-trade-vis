<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        <script type="text/javascript" src="js/main.js"></script>
        <script src="https://d3js.org/d3.v3.min.js"></script>
        <script type="text/javascript" src="js/quicksettings.js"></script>

        <!-- Styles -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <!--<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style> -->
    </head>
    <body>
        <div class="topBar">
            <ul>
                <li><a  onclick="menuSelect(this)">Home</a></li>
                
                <li><a onclick="menuSelect(this)">another one</a></li>
                <li><a onclick="menuSelect(this)">Warp</a></li>
                <li><a onclick="menuSelect(this)">another one</a></li>
            </ul> 
        <div class="content">
          <div class="sidebbar">
            <nav>
                <p>ipsum lorem</p>
            </nav>
          </div>
            <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->

            <article>
            <div class="visBody">


            <script type="text/javascript">
            

            //Section for quicksettings pannel
            var sideNav = document.getElementsByClassName("sidebar");

            var countries = ["one", "two", "three", "four"];
            var selectedCountries = [];
            var count = 0;
            window.onload = function() {

                var panel1 = QuickSettings.create(0, 50, "Settings")
                  .addButton("Search", function(value) { panel1.movePosition(100,100)})
                  .addBoolean("Imports",false)
                  .addBoolean("Exports",false)
                  .addDropDown("Countries", countries, function(value){
                    panel1.addBoolean(buildCountryString(value.value) ,true, function(title, value){
                      remove(title);
                    })
                    selectedCountries.push(value.value);
                  })
                  
                  //.addBoolean("Boolean", true, function(title, value) {output("Remove",title); remove(title)})
                  //.addText("Text", "some text", function(value) { output("Text", value)})
                  //.addTextArea("TextArea", "a whole bunch of text can go here", function(value) { output("TextArea", value)})
                  
                ;

                function buildCountryString(value){
                  var str = value; 
                  if (panel1.getValue("Imports") == true){
                    str = str.concat(", Imports");
                    panel1.movePosition(100,100);
                  }
                  if (panel1.getValue("Exports") == true){
                   str = str.concat(", Exports");
                  }
                  return str;
                }

                function remove(title){
                  panel1.removeControl(title);
                  console.log(selectedCountries);
                  var indexof = selectedCountries.indexOf(title);
                  selectedCountries.splice(indexof, 1);
                  console.log(selectedCountries);
                }

                var canvas = document.createElement("canvas"),
                  context = canvas.getContext("2d");
                canvas.width = 100;
                canvas.height = 100;
                context.beginPath();
                context.fillStyle = "red";
                context.arc(50, 50, 50, 0, Math.PI * 2);
                context.fill();
                /*
                var panel2 = QuickSettings.create(250, 10, "Panel 2")
                  .addDropDown("DropDown", ["one", "two", "three"], function(value) { output("DropDown", value.value)})
                  .addImage("Image", "boyhowdy.jpg")
                  .addProgressBar("ProgressBar", 100, 50)
                  .addElement("Element (canvas)", canvas);

                var panel3 = QuickSettings.create(490, 10, "Panel3")
                  .addHTML("HTML", "<b>bold</b> <u>underline</u> <i>italic</i><ol><li>one</li><li>two</li><li>three</li>")
                  .addPassword("Password", "12345678", function(value) { output("Password", value)})
                  .addDate("Date", "2016-07-11", function(value) { output("Date", value)})
                  .addTime("Time", "06:03:25", function(value) { output("Time", value)});

                var panel4 = QuickSettings.create(730, 10, "Output Panel")
                  .addTextArea("Output");
                */

                
                function output(name, value) {
                  //panel4.setValue("Output", name + " : " + value);
                  console.log(name + value);
                }
            }
           

            
        </script>
                

            </div>
            </article>
            
        <div class="footer">
            <footer>
                this is some more text
            </footer>
        </div>
    </body>
</html>
