<?php
include_once('database.php');

function emp_insert($con,$values = array()){
    $params = "'".implode("','",$values)."'";
    $query = "INSERT INTO employes VALUES (' ',".$params.")";
    if(mysqli_query($con,$query)){
        return true;
    }else{
        return false;
    }
}
function emp_get($con, $search = '') {
    // Base query to select all employees
    $query = "SELECT * FROM employes";

    // If a search term is provided, modify the query to filter by all columns
    if (!empty($search)) {
        $search = mysqli_real_escape_string($con, $search); // Sanitize the input
        $query .= " WHERE nom LIKE '%$search%' 
                    OR prenom LIKE '%$search%' 
                    OR age LIKE '%$search%' 
                    OR service LIKE '%$search%' 
                    OR matricule LIKE '%$search%' 
                    OR salaire LIKE '%$search%'"; // Add search conditions for all fields
    }

    $result = mysqli_query($con, $query);

    // Return result if successful, otherwise false
    if ($result != null) {
        return $result;
    } else {
        return false;
    }
}

function redirect($page){
    header('location:'.$page);
}
function get_emp_by_id($con,$id)
{
    $query = "SELECT * FROM employes WHERE id = '$id'";
    $result = mysqli_query($con,$query);
    if($result != null){
        return $result;
    }else{
        return false;
    }
}
function emp_update($con,$id,$values = array()){
    $values = implode(", ",$values);
    $values = explode(", ",$values);
    $query = "UPDATE employes SET nom = '$values[0]',prenom = '$values[1]',age = '$values[2]',service = '$values[3]',
                matricule = '$values[4]' , salaire = '$values[5]' WHERE id = '$id'";
    if(mysqli_query($con,$query)){
        return true;
    }else{
        return false;
    }
}
function emp_delete($con,$id){
    $query = "DELETE FROM employes WHERE id = '$id'";
    if(mysqli_query($con,$query)){
        return true;
    }else{
        return false;
    }
}