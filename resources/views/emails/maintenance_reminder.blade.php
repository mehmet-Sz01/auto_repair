<!DOCTYPE html>
<html>
<head>
    <title>Araç Bakım/Muayene Hatırlatma</title>
</head>
<body>
<h1>Merhaba, {{ $car->customer->name }}!</h1>
<p>Aracınızın bakım ve muayene zamanı yaklaşıyor.</p>
<p>Bakım Tarihi: {{ $car->maintenance_date }}</p>
<p>Muayene Tarihi: {{ $car->inspection_date }}</p>
<p>Lütfen bu tarihleri unutmayın!</p>
</body>
</html>
