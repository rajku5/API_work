<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <form action="">

                    <div class="mb-3">
                      <label  class="form-label"> Select Country</label>
                      <select id="country" name="country" class="form-select">
                        <option>select option</option>
                        @foreach ($countries as $country )
                            @php $country = (array)$country @endphp
                            <option value="{{$country['country_name']}}">{{$country['country_name']}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="mb-3">
                      <label  class="form-label"> Select States</label>
                      <select id="state" name="state" class="form-select">
                        <option>select option </option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label  class="form-label"> Select cities</label>
                      <select id="city" name="city" class="form-select">
                        <option>select option</option>
                      </select>
                    </div>

                    <input type="hidden" name="token" id="token" value="{{$token}}">

                </form>
                <script>
                  $(document).ready(function){
                        $("#country").change(function(){
                        var country = $(this).val();
                        if (country=='') {
                            country = 'null';
                        }

                        var data = {
                            token:$('#token').val(),
                            country : country
                        }

                        $.ajax({
                            url:"{{route('states')}}",
                            type:"GET",
                            data:data,
                            success:function(response){
                            //console.log(response);
                            var states = JSON.parse(response);
                            var html = '';
                            if (states.length > 0) {
                                for(let i = 0;i<states.length;i++){
                                    html += '<option value ="'+states[i]['state_name']+'">\
                                                '+states[i]['state_name']+'\
                                            ';
                                }
                            }
                            else{
                                $("#city").html(html);
                            }
                            $("#state").html(html);
                            }
                        });

            //city fatch
            $("#state").change(function(){
                        var state = $(this).val();
                        if (state=='') {
                            state = 'null';
                        }

                        var data = {
                            token:$('#token').val(),
                            state : state
                        }

                        $.ajax({
                            url:"{{route('cities')}}",
                            type:"GET",
                            data:data,
                            success:function(response){
                            //console.log(response);
                            var cities = JSON.parse(response);
                            var html = '';
                            if (cities.length > 0) {
                                for(let i = 0;i<cities.length;i++){
                                    html += '<option value ="'+cities[i]['city_name']+'">\
                                                '+cities[i]['city_name']+'\
                                            ';
                                }
                            }
                            $("#city").html(html);
                            }
                        });

                    });
                }
                </script>
            </div>
        </div>

    </div>

</body>
</html>
