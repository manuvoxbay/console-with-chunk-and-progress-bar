<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                    <img src=""/>
                  
                 
                    <div>
                      <form method="post" enctype="multipart/form-data"" action={{route('save.file')}}>
                        <input id="myinput" name="file1" type="file" onchange="encode();" />
                        {{csrf_field()}}
                          <input type="text" name="val" id="val"/>
                          <input type="submit" name="save" id="save" value="save"/>
                      </form>
                      <img src="" id="imgs"/>
                    </div>
                </div>

             
            </div>
        </div>

        <script>
             function encode() {    
               var selectedfile = document.getElementById("myinput").files;
               if (selectedfile.length > 0) {
                 var imageFile = selectedfile[0];
                 var fileReader = new FileReader();
                 var v = fileReader.readAsDataURL(imageFile);
                 fileReader.onload = function(fileLoadedEvent) {
                   var srcData = fileLoadedEvent.target.result;
                   $("#val").val(srcData);
                   $("#imgs").attr('src',srcData);
                   // var newImage = document.createElement('img');
                   // newImage.src = srcData;
                   // document.getElementById("dummy").innerHTML = newImage.outerHTML;
                   // document.getElementById("txt").value = document.getElementById("dummy").innerHTML;
                 }
                 

               }
             }
           </script>

        <script>

            $(document).ready(function()
            {
                $("#file1").change(function(event)
                {
                   console.log($("#file1").val());
                });
            });
        </script>
    </body>
</html>
