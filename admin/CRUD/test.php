if(isset($_FILES['source']) and $_FILES['source']['error'] == 0)
{

$dossier= 'assets/publications_perso';
$temp_name=$_FILES['source']['tmp_name'];
if(!is_uploaded_file($temp_name))
{
exit ("le source est untrouvable");
}
If ($_FILES['source']['size'] >= 1000000){
exit ("Erreur, le source est volumineux");
}
$infossource = pathinfo($_FILES['source']['name']);
$extension_upload = $infossource['extension'];

$extension_upload = strtolower($extension_upload);
$extensions_autorisees = array('pdf');
if (!in_array($extension_upload, $extensions_autorisees))
{
exit("Erreur, Veuillez inserer une pdf svp (extensions autorisées: png)");
}
$nom_photo=$numapp.".".$extension_upload;
if(!move_uploaded_file($temp_name, $dossier.Snom_photo)){
exit ("Problem dans le telechargement de l'pdf, Ressayez");

$ph_name=$nom_photo;
}
else{
echo ''oups
}
}