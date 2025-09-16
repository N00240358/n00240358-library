<!DOCTYPE html>
<html>
<head><title>Plants</title></head>
<body>
    <h1>All Plants</h1>
    <ul>
    @foreach($plants as $plant)
        <li>{{ $plant->name }} - {{ $plant->description }}</li>
    @endforeach
    </ul>
</body>
</html>