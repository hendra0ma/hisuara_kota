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
            }
            if (isset($row[2])) {
                unset($filteredExcelData[$j][$i]);
            }
        }
    }
    ?>
    <table>

    kecamatan {{$filteredExcelData[2][1]}}
    kelurahan {{$filteredExcelData[3][1]}}
    DPT {{$filteredExcelData[7][1]}}

        @foreach($filteredExcelData as $j => $row)
        <tr>

        


            <?php
            if (empty($row)) {
                continue;
            }
            ?>
            <td>
                {{$row[0]}}
                {{$row[1]}}
            </td>
        </tr>
        
        @endforeach
    </table>
</body>

</html>