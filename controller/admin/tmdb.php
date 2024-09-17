<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
if(!isset($_POST['acao'])){
	die_error("Não foi possível conectar");
}

if(!isset($_POST['item_id']) OR !intval($_POST['item_id'])){
	die_error("Informe o id. Somente números.");
}

if($_POST['acao'] != 'filme' && $_POST['acao'] != 'serie'){
	die_error("A opção enviada é inválida.");
}


if($_POST['acao'] == 'filme'){


	$tmdb_id = $_POST['item_id'];
	$api_key  = 'e49043dae6330a6a2a2a441334ebb060';

	$url_one  = "https://api.themoviedb.org/3/movie/".$tmdb_id."?&api_key=".$api_key."&images&videos&language=pt-BR";
	$ch_one   = curl_init($url_one);
	curl_setopt($ch_one, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_one, CURLOPT_SSL_VERIFYPEER, false);
	$info_one = json_decode(curl_exec($ch_one)); 


	if(!isset($info_one->title) OR !isset($info_one->overview) OR !isset($info_one->poster_path)){
		die_error("Sem resultados.");
	}


	$url_two  = "https://api.themoviedb.org/3/movie/".$tmdb_id."/videos?api_key=".$api_key."&language=pt-BR";
	$ch_two   = curl_init($url_two);
	curl_setopt($ch_two, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_two, CURLOPT_SSL_VERIFYPEER, false);
	$info_two = json_decode(curl_exec($ch_two)); 


	$url_three  = "https://api.themoviedb.org/3/movie/".$tmdb_id."/credits?api_key=".$api_key."&language=pt-BR";
	$ch_three   = curl_init($url_three);
	curl_setopt($ch_three, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_three, CURLOPT_SSL_VERIFYPEER, false);
	$info_three = json_decode(curl_exec($ch_three)); 


	$year = "";
	$duration = "";
	$note = "";
	$trailer = "";
	$actors = "";


	$title       = $info_one->title;
	$description = $info_one->overview;
	$image       = 'https://www.themoviedb.org/t/p/w220_and_h330_face'.$info_one->poster_path;
	$background  = 'https://www.themoviedb.org/t/p/original'.$info_one->backdrop_path;
	$year        = substr($info_one->release_date, 0,4);
	$duration    = $info_one->runtime. " Minutos";
	$note        = round(str_replace('.','',$info_one->vote_average)); 
	$note        = substr($note,0,2).'%';; 




	if(!empty($info_two->results['0']->key)){
		$trailer = "https://youtube.com/embed/".$info_two->results['0']->key;
	}
	
	$array_itens = array("title" => $title, "description" => $description, "image" => $image, "background" => $background,
						 "year" => $year, "duration" => $duration, "note" => $note, 
						 "trailer" => $trailer, "tmdb_id" => $tmdb_id, "status" => "ok");

	echo json_encode($array_itens);


}



if($_POST['acao'] == 'serie'){


	$tmdb_id = $_POST['item_id'];
	$api_key  = 'e49043dae6330a6a2a2a441334ebb060';

	$url_one  = "https://api.themoviedb.org/3/tv/".$tmdb_id."?api_key=".$api_key."&language=pt-BR";
	$ch_one   = curl_init($url_one);
	curl_setopt($ch_one, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_one, CURLOPT_SSL_VERIFYPEER, false);
	$info_one = json_decode(curl_exec($ch_one)); 

	if(!isset($info_one->overview) OR !isset($info_one->overview) OR !isset($info_one->poster_path)){
		die_error("Sem resultados.");
	}



	$url_two  = "https://api.themoviedb.org/3/tv/".$tmdb_id."/videos?api_key=".$api_key."&language=pt-BR";
	$ch_two   = curl_init($url_two);
	curl_setopt($ch_two, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_two, CURLOPT_SSL_VERIFYPEER, false);
	$info_two = json_decode(curl_exec($ch_two)); 


	$url_three  = "https://api.themoviedb.org/3/tv/".$tmdb_id."/credits?api_key=".$api_key."&language=pt-BR";
	$ch_three   = curl_init($url_three);
	curl_setopt($ch_three, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_three, CURLOPT_SSL_VERIFYPEER, false);
	$info_three = json_decode(curl_exec($ch_three)); 


	$year = "";
	$duration = "";
	$note = "";
	$trailer = "";
	$actors = "";


	$title       = $info_one->name;
	$description = $info_one->overview;
	$image       = 'https://www.themoviedb.org/t/p/w220_and_h330_face'.$info_one->poster_path;
	$background  = 'https://www.themoviedb.org/t/p/original'.$info_one->backdrop_path;
	$year        = substr($info_one->first_air_date, 0,4);
	$note        = round(str_replace('.','',$info_one->vote_average)); 
	$note        = substr($note,0,2).'%'; 


	if(!empty($info_two->results['0']->key)){
		$trailer = "https://youtube.com/embed/".$info_two->results['0']->key;
	}

	$array_itens = array("title" => $title, "description" => $description, "image" => $image, "background" => $background,
						 "year" => $year, "duration" => $duration, "note" => $note, 
						 "trailer" => $trailer, "tmdb_id" => $tmdb_id, "status" => "ok");

	echo json_encode($array_itens);

}
