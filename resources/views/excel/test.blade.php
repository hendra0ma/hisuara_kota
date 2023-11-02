// resources/views/upload-excel.blade.php

<form action="{{ route('import-excel') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file">
    <button type="submit">Import Excel</button>
</form>