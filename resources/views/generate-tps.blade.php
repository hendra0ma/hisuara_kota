<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
    
        function processBatch() {
        
            $.ajax({
                url: `{{url("action-generate-tps")}}`,
                method: 'get',
               
                dataType: 'json',
                success: function (response) {
                    if (response.message == 'berhasil') {
                        setTimeout(processBatch,200);
                        console.log('berhasil')
                    }
                },
             
            });
        }
        processBatch();
    });
</script>
</body>
</html>