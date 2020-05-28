<?php

class Fiche_modif extends Controller {
	
	function index($id = '',$table = ''){ //On a en param�tres l'id et le nom de la table qui ont �t� pass�s en GET
	
		// Chargement des models utilis�s dans le controller (les models sont dans le dossiers /system/application/models )
		$this->load->model('Model_fiche_modif');
		
		$update = "";
		$donnees = "";
		
		if(isset($_POST['vedette_chandon'])) //Modification m�diath�que
		{
			$vedette_chandon = addslashes($_POST['vedette_chandon']);  //Pour chaque input on ajoute des slashes pour prot�ger les apostrophes et on encode en utf8
			$auteur_cliche = addslashes($_POST['auteur_cliche']);
			$type_cliche = addslashes($_POST['type_cliche']);
			$annee_cliche = addslashes($_POST['annee_cliche']);
			$commune = addslashes($_POST['commune']);
			$edifice_conservation = addslashes($_POST['edifice_conservation']);
			$emplacement_dans_edifice = addslashes($_POST['emplacement_dans_edifice']);
			$photo = addslashes($_POST['photo']);
			$ref_IM = addslashes($_POST['ref_IM']);
			$ref_PA = addslashes($_POST['ref_PA']);
			$ref_IA = addslashes($_POST['ref_IA']);
			$artificial_number_Decrock = addslashes($_POST['artificial_number_Decrock']);
			$famille = addslashes($_POST['famille']);
			$individu = addslashes($_POST['individu']);
			$qualite = addslashes($_POST['qualite']);
			$date = addslashes($_POST['date']);
			$titre = addslashes($_POST['titre']);
			$auteurs = addslashes($_POST['auteurs']);
			$lieu_edition = addslashes($_POST['lieu_edition']);
			$editeur = addslashes($_POST['editeur']);
			$annee_edition = addslashes($_POST['annee_edition']);
			$reliure = addslashes($_POST['reliure']);
			$provenance = addslashes($_POST['provenance']);
			$site = addslashes($_POST['site']);
			$section = addslashes($_POST['section']);
			$cote = addslashes($_POST['cote']);
			$folio_emplacement = addslashes($_POST['folio_emplacement']);
			$denomination = addslashes($_POST['denomination']);
			$categorie = addslashes($_POST['categorie']);
			$materiau = addslashes($_POST['materiau']);
			$ref_reproductions = addslashes($_POST['ref_reproductions']);
			$biblio = addslashes($_POST['biblio']);
			$remarques = addslashes($_POST['remarques']);
			$cl_a_refaire = addslashes($_POST['cl_a_refaire']);
			
			$this->db->query("UPDATE legende_photos SET 
														vedette_chandon='$vedette_chandon', 
														".utf8_encode('auteur_clich�')."='$auteur_cliche', 
														".utf8_encode('type_clich�')."='$type_cliche', 
														".utf8_encode('ann�e_clich�')."='$annee_cliche', 
														commune='$commune',
														edifice_conservation='$edifice_conservation',
														".utf8_encode('emplacement_dans_�difice')."='$emplacement_dans_edifice',
														photo='$photo',
														ref_IM='$ref_IM',
														ref_PA='$ref_PA',
														ref_IA='$ref_IA',
														artificial_number_Decrock='$artificial_number_Decrock',
														famille='$famille',
														individu='$individu',
														".utf8_encode('qualit�')."='$qualite',
														date='$date',
														titre='$titre',
														auteurs='$auteurs',
														".utf8_encode('lieu_�dition')."='$lieu_edition',
														editeur='$editeur',
														".utf8_encode('ann�e_�dition')."='$annee_edition',
														reliure='$reliure',
														provenance='$provenance',
														site='$site',
														section='$section',
														cote='$cote',
														folio_emplacement='$folio_emplacement',
														".utf8_encode('d�nomination')."='$denomination',
														".utf8_encode('cat�gorie')."='$categorie',
														".utf8_encode('mat�riau')."='$materiau',
														ref_reproductions='$ref_reproductions',
														biblio='$biblio',
														remarques='$remarques',
														".utf8_encode('cl_�_refaire')."='$cl_a_refaire' WHERE id='$id'");
														
			header("Location: ".base_url()."administration"); //On redirige vers la page administration
														
		}
		else if(isset($_POST['origine'])) //Modification armorial
		{
			$origine = addslashes($_POST['origine']);
			$date = addslashes($_POST['date']);
			$siecle = addslashes($_POST['siecle']);
			
			$this->db->query("UPDATE armorial SET 
														origine='$origine',
														date='$date',
														".utf8_encode('si�cle')."='$siecle' WHERE id='$id'");
														
			header("Location: ".base_url()."administration"); //On redirige vers la page administration
		}
		else
		{
			$donnees = $this->Model_fiche_modif->recherche_infos($id,$table); //On recherche les informations concernant la table
			
			// Tableau $data des variables � envoyer aux vues			
		$data = array(
			'donnees' => $donnees,
			'table' => $table,
			'update' => $update
		);
		
		// Chargement des views � afficher (attention � l'ordre) (les views sont dans le dossiers /system/application/views )	
		$this->load->view('administration/fiche_modif',$data);
		}
		
		
		
		
	}
	
}

?>