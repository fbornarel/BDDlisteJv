<?php include('common.php');
$title='Ajouts & modifications';
$titre='';
$notice='';
$apparence='';
$console='';
$remarque='';
$prix='';

if($_POST){

	$titre = trim($_POST['titre']);
	$notice = $_POST['notice'];
	$apparence = $_POST['apparence'];
	$console = $_POST['console'];
	$remarque = trim($_POST['remarque']);
  $prix = trim($_POST['prix']);
  $errors='';

    /*Enregistrement*/
    $query = $pdo->prepare('SELECT COUNT(*) FROM listejv WHERE titre = ?');
  
  	$query->execute([$titre]); 
  	$nbTitre = $query->fetchColumn();
  
  	if($nbTitre != 0)
  	{
      $errors[] = "Jeu déjà enregistré";
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


    if(empty($titre)){
      $errors[] = "Veuillez indiquer un titre !";
    }

    if(!isset($notice))
    {
      $errors[] = "Cochez la notice !";
    }

    if(!isset($apparence))
    {
      $errors[] = "Cochez l'état !";
    }
    if(empty($console))
    {
      $errors[] = "Veuillez indiquer une console!";
    }
    if(empty($prix))
    {
      $errors[] = 'Veuillez indiquer un prix!';
    }


  	if(empty($errors))
  	{
     	$query = $pdo->prepare( 'INSERT INTO listejv (image, titre, notice, état, console, remarque, prix ) 
          						VALUES(:register_image, :register_titre, :register_noticecheckbox, :register_apparence, :register_console, :register_remarque, :register_prix)');

    	$query->execute(['register_titre' => $titre,
                       'register_image' => $image,
              				 'register_noticecheckbox' => $notice,
              			   'register_apparence' => $apparence,
              				 'register_console' => $console,
              				 'register_remarque' => $remarque,
                       'register_prix' => $prix]);

      header('Location: liste.php');
    }
}

/*Modifications*/



$template='accueil';
 include('layout.phtml');