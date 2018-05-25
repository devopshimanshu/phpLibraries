<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tags</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="token-input.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="token-input-facebook.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script-->
    <script src="jquery.tokeninput.js"></script>
</head>
<body>
    <div class="container-fluid">
        <h1>TAG AUTOCOMPLETE</h1>
        <form action="form.php" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <!--input type="text" class="form-control" name="typing" id="inputText" placeholder="Type here"/>
                <br/>
                <textarea>
                </textarea-->
                    <div class="bs-example">
                        <input type="text" id="inputtext" name="email"/>
                    </div>
                </div>
            </div>
            <button type="submit">submit</button>
        </form>
    </div>

<script>
    //$('#inputtext').tagsinput();
    /*
    $('#inputtext').tagsinput({
        typeahead: {
            source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo']
        }
    });
    
    $('#inputtext').tagsinput({
        typeahead: {
            source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo']
        },
        freeInput: false
    });
    */
    /*
    $('input').tagsinput({
        typeahead: {
            source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo']
        }
    });
    */
    $(document).ready(function(){
        //$.fn.stark();
        $("#inputtext").tokenInput("backend.php",{theme: "facebook", hintText:"", preventDuplicates: true});
    });
    $.fn.stark = function(){
                var result = $.ajax({
                    url: 'backend.php',
                    data: {hi:'hi'},
                }).success(function(data){
                    console.log(data);
                });
            }
</script>
</body>
</html>