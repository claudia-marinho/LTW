<?php
  function getImageInfo($id) {
    global $db;
    
    $stmt = $db->prepare('SELECT * FROM Image WHERE id=:id');
	$stmt->bindParam(':id', $id);
	$stmt->execute();

    return $stmt->fetch();
  }

  function addImageRestaurant($url, $description, $rest_id) {
	global $db;

	include_once(dirname(__FILE__) . '/../utilities/utils.php');

	$id = getNextId($db);
	$stmt = $db->prepare('INSERT INTO Image (id, url, description, restaurant) VALUES (?,?,?,?)');
	$stmt->execute(array($id, $url, $description, $rest_id));

	return $id;
 }

   function updateImage($id, $url, $description) {
	global $db;

    $stmt = $db->prepare('UPDATE Image
	SET url=:url
	WHERE id=:id');

	$stmt->bindParam(':url', $url);
	$stmt->bindParam(':id', $id);
	$stmt->execute();

    $stmt = $db->prepare('UPDATE Image
	SET description=:description
	WHERE id=:id');

	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':id', $id);
	$stmt->execute();

 }
?>