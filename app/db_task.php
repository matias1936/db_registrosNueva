<?php

function getConnection() {
   return new PDO('mysql:host=localhost;dbname=db_tareas;charset=utf8', 'root', '');
}

function getTasks() {
   // 1. Abro la conexión
   $db = getConnection();

   // 2. Ejecuto la consulta
   $query = $db->prepare('SELECT * FROM tareas');
   $query->execute();

   // 3. Obtengo los datos en un arreglo de objetos
   $tasks = $query->fetchAll(PDO::FETCH_OBJ); 

   return $tasks;
 }

 function getTask($id) {
   $db = getConnection();

   $query = $db->prepare('SELECT * FROM tareas WHERE id = ?');
   $query->execute([$id]);   

   $task = $query->fetch(PDO::FETCH_OBJ);

   return $task;
 }

 function insertTask($title, $description, $priority, $finished = false) {
   $db = getConnection();

   $query = $db->prepare('INSERT INTO tareas(titulo, descripcion, prioridad, finalizada) VALUES (?, ?, ?, ?)');
   $query->execute([$title, $description, $priority, $finished]);

   $id = $db->lastInsertId();

   return $id;
}

function eraseTask($id) {
   $db = getConnection();

   $query = $db->prepare('DELETE FROM tareas WHERE id = ?');
   $query->execute([$id]);
}


function updateTask($id) {
   $db = getConnection();
   
   $query = $db->prepare('UPDATE tareas SET finalizada = 1 WHERE id = ?');
   $query->execute([$id]);
}