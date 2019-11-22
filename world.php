<?php
$host = getenv('IP');
$username = 'thisUser';
$password = 'Passcode21%';
$dbname = 'world';
$country= htmlentities($_GET["country"]);
$context= htmlentities($_GET["context"]);
?>

<?php if ($context=="cities"):?><?php
try{
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
$stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON countries.code=cities.country_code WHERE countries.name='$country'  ");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo(var_dump($results));
?>
<table id="tb">
 <tr>
	<th>Name</th>
	<th>District</th>
	<th>Population</th>
</tr>
	
<?php foreach ($results as $row): ?>
  <tr>
	<td><?= $row['name']?></td>
  	<td><?= $row['district']?></td>
  	<td><?= $row['population']?></td>
 </tr>
<?php endforeach; ?>
</table>
<?php else:?><?php
try{
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo var_dump($results);
?>
<table id="tb">
 <tr>
	<th>Name</th>
	<th>Continent</th>
	<th>Independence Year</th>
	<th>Head of State </th>
 </tr>
<?php foreach ($results as $row): ?>
  <tr>
	<td><?= $row['name']?></td>
  	<td><?= $row['continent']?></td>
  	<td><?= $row['independence_year']?></td>
  	<td><?= $row['head_of_state']?></td>
 </tr>
<?php endforeach; ?>
</table>
<?php endif; ?>