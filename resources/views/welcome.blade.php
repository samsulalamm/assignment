<!DOCTYPE html>
<html lang="en">

<head>
    <title>Top Secret CIA Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Top Secret CIA Database</h2>

        <form>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="inputYear">Birth Year</label>
                    <input type="number" class="form-control" value="" id="inputYear" placeholder="BIrth Year">
                </div>
                <div class="form-group col-md-5">
                    <label for="inputMonh">Birth Month</label>
                    <input type="number" class="form-control" value="" id="inputMonth" placeholder="Birth Month">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputButton"></label>
                    <button type="button" class="form-control btn btn-primary text-center"
                        onclick="run()">Filter</button>
                </div>
            </div>
        </form>
        <div id="render_Data">
            @include('renderdata')
        </div>
    </div>

</body>

</html>

<script>
    function run() {
        let inputYear = document.getElementById('inputYear').value;
        let inputMonth = document.getElementById('inputMonth').value;
        var url = '{{ url('api/getResult') }}?birthYear=' + inputYear + '&birthMonth=' + inputMonth;
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                $('#render_Data').html('');
                $('#render_Data').html(data);
            }
        });
    }

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let inputYear = document.getElementById('inputYear').value;
        let inputMonth = document.getElementById('inputMonth').value;
        let page = $(this).attr('href').split('page=')[1];

        let data = {
            inputYear,
            inputMonth
        }
        $.ajax({
            url: $(this).attr('href'),
            type: "get",
            dataType: 'json',
            data: data,
            success: function(data) {
                $('#render_Data').html('');
                $('#render_Data').html(data);
            }
        });
    });
</script>
