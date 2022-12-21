<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<link rel="stylesheet" href="css/BD.css">
<body>
<h3>Додавання білету</h3>
<form action="add_Ticket.php" method="post">
    <p>Номер білету:
    <input type="number" name="Ticket_number" /></p>
    <p>ID Станції:
    <input type="number" name="Name_ID" /></p>
    <p>Вартість білету:
    <input type="number" name="Ticket_price" /></p>
    <p>Місце відправки:
    <input type="text" name="Place_of_arrival" /></p>
    <p>Місце прибуття:
    <input type="text" name="Place_of_departure" /></p>
    <input type="submit" value="Добавить">
</form>
</body>
</html>