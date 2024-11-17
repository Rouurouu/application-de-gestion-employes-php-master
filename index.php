<?php
include('includes/header.php');
include('database/functions.php');

// Check if there's a search query
$search = isset($_GET['search']) ? $_GET['search'] : '';



$result = emp_get($con, $search);

// Check if $result is valid
if (!$result) {
    echo '<div class="alert alert-danger">Error fetching employee data.</div>';
} else {
?>
<div class="container">
<h2></h2>
    <div class="row">
        <div class="col-md-8 mx-auto mt-4">
            <div class="card">
                <div class="card-body">
                    <!-- Success/Error messages -->
                    <?php 
                        if (isset($_GET['message']) && $_GET['message'] == "success"):
                            echo '<div class="alert alert-success">Employé ajouté avec succès</div>';
                        elseif (isset($_GET['message']) && $_GET['message'] == "updated"):
                            echo '<div class="alert alert-warning">Employé modifié avec succès</div>';
                        elseif (isset($_GET['message']) && $_GET['message'] == "deleted"):
                            echo '<div class="alert alert-danger">Employé supprimé avec succès</div>';
                        endif;
                    ?> 

                    <!-- Search Form -->
                    <form method="GET" action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Rechercher par nom, âge, prénom, matricule, etc." value="<?php echo htmlspecialchars($search); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Rechercher</button>
                            </div>
                        </div>
                    </form>

                    <!-- Employee Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Age</th>
                                <th>Service</th>
                                <th>Matricule</th>
                                <th>Salaire</th> <!-- New salary column -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = $result->fetch_assoc()):?>
                                <tr>
                                    <td><?php echo $row['nom'];?></td>
                                    <td><?php echo $row['prenom'];?></td>
                                    <td><?php echo $row['age'];?></td>
                                    <td><?php echo $row['service'];?></td>
                                    <td><?php echo $row['matricule'];?></td>
                                    <td><?php echo $row['Salaire'];?></td>
                                    <td>
                                        <a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-warning btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile;?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} // End of $result check
include('includes/footer.php');
?>
