<?php  include('common.php');
$title='';

if($_POST)
{

	$titre= trim($_POST['titre']);
	$image= $_POST['image'];
	$notice= $_POST['notice'];
	$apparence = $_POST['apparence'];
	$console = $_POST['console'];
	$remarque = trim($_POST['remarque']);
  	$prix = trim($_POST['prix']);
  	$errors='';

  	$query= $pdo->prepare('SELECT * FROM listejv WHERE titre=?');
  	$query ->execute([$titre]);
  	$nbTitre = $query->fetchColumn();
  
  	if($nbTitre = 0)
  	{
      $errors[] = "Jeu inexistant dans la base de données";
  	}

  	if(!empty($_FILES))
    {
      $image='image/'.$_FILES['image']['name'];
      $extension = pathinfo($image, PATHINFO_EXTENSION);
      $validExtentions = ['jpeg','jpg','gif','png','bmp'];

        if(!in_array($extension,$validExtentions))
        {
           $errors[] = "extension invalide";
        }
    }

    if(empty($errors))
    {
    	$query= $pdo->prepare('UPDATE listejv SET image = :update_image, notice = :update_noticecheckbox, état =:update_apparence, console = :update_console, remarque = :update_remarque, prix = :update_prix WHERE titre= :titre');
    	$query->execute(['titre' => $titre,
    					 'update_image' => $image,
              			 'update_noticecheckbox' => $notice,
              			 'update_apparence' => $apparence,
              			 'update_console' => $console,
              			 'update_remarque' => $remarque,
                         'update_prix' => $prix]);
    }





}































$template='accueil';
include('layout.phtml');