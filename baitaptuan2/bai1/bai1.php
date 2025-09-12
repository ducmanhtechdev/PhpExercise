<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="handle.php" method="POST" novalidate>
        Tên<input type="text" name="name" id=""> <br>
        Năm Sinh <input type="radio" name="ye1" id="" value="2005"> 2005
        <input type="radio" name="ye1" id="ye1" value="2006"> 2006 <br>
        <input type="checkbox" name="namecheck" id="" value="No"> 
        <label for="cars">Choose a car:</label>
<select id="cars" name="cars">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select>
<input type="submit">
    </form>


</body>

</html>