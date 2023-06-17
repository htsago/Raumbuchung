<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h3>Buchungsformular</h3>
    
    <form action="raum.php" method="post">

        <label for="raumnr">Raum:</label>

        <select id="raumnr" name="raumnr">
          <option value="">---</option>
          <option value="BR8">BR8 (Besprechungsraum für 8 Pers)</option>
          <option value="BR6">BR6 (Besprechungsraum für 6 Pers)</option>
          <option value="BR4">BR4 (Besprechungsraum für 4 Pers)</option>
          <option value="B4-Nord">B4-Nord (Büro für 4 Pers)</option>
          <option value="B4-Sud">B4-Sud (Büro für 4 Pers)</option>
          <option value="B3">B3 (Büro für 3 Pers)</option>
          <option value="B1-1">B1-1 (Büro für 1 Pers)</option>
          <option value="B1-2">B1-2 (Büro für 1 Pers)</option>
          <option value="B1-3">B1-3 (Büro für 1 Pers)</option>
          <option value="B1-4">B1-4 (Büro für 1 Pers)</option>
          <option value="B1-5">B1-5 (Büro für 1 Pers)</option>
          <option value="B1-6">B1-6 (Büro für 1 Pers)</option>
        </select><br><br>

        <label for="etagenr">Etage:</label>
        <select id="etagenr" name="etagenr">
            <option value="">---</option>
            <option value="Etage 1">Etage 1</option>
            <option value="Etage 2">Etage 2</option>
            <option value="Etage 3">Etage 3</option>
            <option value="Etage 4">Etage 4</option>
          </select><br><br>

        <label for="date">Datum:</label>
        <input type="date" name="datum"><br><br>
        
        <label for="startzeit">Startzeit:</label>
        <input type="time" name="startzeit"><br><br>
        <label for="endzeit">Endzeit:</label>
        <input type="time" name="endzeit"><br><br>
        
        <input type="submit" name="submit">
    </form>

    <?php include('raum.php'); ?>
</body>
</html>

