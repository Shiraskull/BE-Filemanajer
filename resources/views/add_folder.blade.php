<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($fata as $item)
      {{ $item->folder_nama }}
    @if ($item->anak)
        @foreach ($item->anak as $value)
            {{ $value->folder_nama }}
        @endforeach
    @endif
    @endforeach
    <form action="{{ route('folder.store') }}" method="post">
        @csrf
        <input type="text" name="nama">
        <input type="text" name="parent">
        <button type="submit">Submit</button>
    </form>
</body>
</html>