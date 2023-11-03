<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel</title>
</head>

<body>
    <?php
   $filteredExcelData = $excelData;

   foreach ($filteredExcelData as $j => $row) {
       foreach ($row as $i => $cell) {
           if (trim($cell) == "") {
               unset($filteredExcelData[$j][$i]);
               unset($filteredExcelData[$j]);
           }
           if (!isset($row[2])) {
               unset($filteredExcelData[$j][$i]);
           }
           if ($j == 9) {
               unset($filteredExcelData[$j][$i]);
            }
        }
        if (empty($row)) {
            unset($filteredExcelData[$j]);
        }

   }

    ?>
    <table>
        @foreach($filteredExcelData as  $j => $row)
        <tr>
            @if (empty($row)) 
              @continue
            @endif
            <td>
                {{$row[0]}} <br>
                {{$row[1]}}<br>
                {{$row[2]}}<br>
                {{$row[3]}}<br>
                {{$row[4]}}<br>
                {{$row[5]}}<br>
                {{$row[6]}}<br>
                {{$row[7]}}<br>
                {{$row[8]}}<br>
                {{$row[9]}}<br>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>