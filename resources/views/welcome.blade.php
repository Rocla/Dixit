<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

/*            .title {
                font-size: 96px;
            }*/
        </style>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript">            
            $(document).ready(function(){        
                $("#next").click(function(){                   
                    $("#image").attr('src', 'images/cards/official/{!!$cards[1]->name!!}');
                });
            });
        
        </script>
    </head>
    <body>
        <div class="container">

            <div class="content">
                <div class="title">
                    <image src="images/cards/official/{!!$cards[0]->name!!}" id="image"/>
                    <button type="button" id="next">NEXT</button>
                </div>

            </div>
        </div>
    </body>
</html>
