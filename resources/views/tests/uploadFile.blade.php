<!DOCTYPE html>
<html>
<head>
    <title>Azure Blob Upload</title>
</head>
<body>
    <h2>Upload File to Azure Blob Storage</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('azure.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="files[]" multiple>
        <button type="submit">Upload</button>
    </form>
</body>
</html>

