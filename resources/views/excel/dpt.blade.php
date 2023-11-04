<h1>UPLOAD DPT</h1>

<form action="{{ route('import-dpt-excel') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_files">
    <button type="submit">Import Excel</button>
</form>