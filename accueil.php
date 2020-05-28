<?php
	
	class Accueil extends Controller {
		
		
		function index(){
			
			// Chargement des mod�les utilis�s dans le contr�leur (les mod�les sont dans le dossier /system/application/models)
			$this->load->model('Model_recherche');			
			$this->load->model('Model_fiche');
			$this->load->model('Model_administration');		
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Bouton de d�connexion qui met la variable $session = FALSE (c�d non connect�)			
				|----------------------------------------------------------------------------------------------------
			*/
			$session = $this->session->userdata('logged_in');	// $session=TRUE (admin est connect�) ou $session=FALSE (admin est pas connect�)
			if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'Deconnexion') {
				$newdata = array(
				'logged_in'	=> FALSE,
				'statut'	=> NULL
				);
				$this->session->set_userdata($newdata); 
				$session = $this->session->userdata('logged_in');	// $session = FALSE
				
				header("Location: ".base_url()); 	// Redirection sur l'identification		
			}
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			/*
				|----------------------------------------------------------------------------------------------------
				| Incr�mentation du compteur
				|----------------------------------------------------------------------------------------------------
			*/
			$fichier = fopen("compteur.txt","r");
			$infos = fgets($fichier,255);
			$infos = explode(" ", $infos);
			$visites = $infos[0];
			$date = $infos[1];
			$visites++;
			fclose($fichier);
			
			$fichier=fopen("compteur.txt","w");
			fwrite($fichier,$visites." ".$date);
			fclose($fichier);
			/*
				|----------------------------------------------------------------------------------------------------
			*/
			
			$photos=$this->Model_recherche->photo_liste(); 
			$presentation_heraldique=$this->Model_administration->get_presentation_text();
			// Tableau $data des variables � envoyer aux vues			
			$data = array(
			'connecte' => $session, // La variable $connecte est utilis�e dans la vue footer.php 
			'photos' => $photos,
			'presentation_heraldique'=> $presentation_heraldique
			);
			
			// Chargement des vues � afficher (attention � l'ordre) (les vues sont dans le dossier /system/application/views)	
			$this->load->view('layout/header',$data);	
			$this->load->view('accueil',$data);
			$this->load->view('layout/footer',$data);	
			
		}
	}
	
	/* End of file welcome.php */
	/* Location: ./system/application/controllers/welcome.php */
?>
