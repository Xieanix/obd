<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<link rel="stylesheet" href="css/BD.css">
<body>
<h3>Додавання відгуку</h3>
<form action="add_passenger_reviews.php" method="post">
    <p>Кількість позитивних:
    <input type="number" name="Number_of_positive" /></p>
    <p>Кількість негативних:
    <input type="number" name="Number_of_negative" /></p>
    <p>Текст відгуку:
    <input type="text" name="Reviews_text" /></p>
    <p>Номер білету:
    <input type="number" name="Ticket_number" /></p>
    <input type="submit" value="Добавить">
</form>
</body>
</html>