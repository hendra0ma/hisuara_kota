<h1>UPLOAD DPT</h1>

<form action="{{ route('import-dpt-excel-gen') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_files[]"multiple>
    <button type="submit">Import Excel</button>
</form>