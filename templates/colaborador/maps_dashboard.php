<?php

use Src\Model\Dao\Conexao;
use Src\Model\Dao\UsuarioDao;

error_reporting(0);
set_time_limit(0);

// Se iniciado, realiza o controle do filtro do material
if(isset($_REQUEST['cd_material']) && $_REQUEST['cd_material'] != "todos") {
	$cd_material = $_REQUEST['cd_material'];
}
else {
	$cd_material = 0;
}

//
$rows = array();
//
$sql = "
SELECT 
A.*, 
B.nome_material 
FROM `usuario` A 
LEFT JOIN material B ON B.cd_material = A.cd_material 
WHERE
A.cd_tipo_usu = ? AND 
A.end_latitude IS NOT NULL AND
A.end_longitude <> '' AND
A.cd_material IS NOT NULL";
// Concatena material no select
if($cd_material != 0) {
	$sql .= " AND A.cd_material = ?";
}
$stmt = Conexao::getConn()->prepare($sql);
$stmt->bindValue(1, 2); // Somente COLABORADOR
if($cd_material != 0) {
	$stmt->bindValue(2, $cd_material);
}
$stmt->execute();
if ($stmt->rowCount() > 0) {
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$cd_usu = $row['cd_usu'];
		$nome_usu = $row['nome_usu'];
		$email_usu = $row['email_usu'];
		$tel_fixo_usu = $row['tel_fixo_usu'];
		$tel_cel_usu = $row['tel_cel_usu'];
		$cep_usu = $row['cep_usu'];
		$cidade_usu = $row['cidade_end_usu'];
		$bairro_usu = $row['bairro_end_usu'];
		$rua_end_usu = $row['rua_end_usu'];
		$num_end_usu = $row['num_end_usu'];
		$end_latitude = $row['end_latitude'];
		$end_longitude = $row['end_longitude'];
		$nome_material = $row['nome_material'];
		// MOSTRA
		$rows[] = [
			'MATERIAL' => $nome_material,
			'CODCLIENTE' => $cd_usu,
			'ENDERECO' => $rua_end_usu . ", " . $num_end_usu . ",<br>" . $bairro_usu . ", " . $cidade_usu . " - " . $cep_usu,
			'NOME' => utf8_encode($nome_usu),
			'EMAIL' => $email_usu,
			'TELCEL' => $tel_cel_usu,
			'TELFIXO' => $tel_fixo_usu,
			'LATITUDE' => $end_latitude,
			'LONGITUDE' => $end_longitude
		];
	}
}
//print_r($rows);
?>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?= url("templates/colaborador/css/maps/mapsstyle_default.css"); ?>">
	<link rel="stylesheet" media="screen and (max-width:480px)" href="<?= url("templates/colaborador/css/maps/mapsstyle480.css"); ?>">
	<link rel="stylesheet" media="screen and (min-width:481px) and (max-width:768px)" href="<?= url("templates/colaborador/css/maps/mapsstyle768.css"); ?>">
	<link rel="stylesheet" media="screen and (min-width:769px) and (max-width:1024px)" href="<?= url("templates/colaborador/css/maps/mapsstyle1024.css"); ?>">
	<link rel=stylesheet media="screen and (min-width: 1025px)" href="<?= url("templates/colaborador/css/maps/mapsstyle1025.css"); ?>">
	<link rel="shortcut icon" href="<?=url("templates/images/logo_semnome.png");?>" type="image/x-png" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="<?= url("templates/web/jquery/jquery.js"); ?>"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=<?= UsuarioDao::keyMaps(); ?>&sensor=false&callback=initialize"></script>
	<title>Mapa</title>
</head>
<div class="form_description">
	<nav id="cabecalho">
		<a href="<?= url("colaborador/"); ?>"><img id="logo" src="<?= url("templates/images/logo_semnome.png"); ?>"></a>

		<a href="<?= url("colaborador/"); ?>"><img id="home" src="<?= url("templates/images/home.png"); ?>"></a>

		<a href="<?= url("colaborador/configuracao/".$_SESSION['cd_usu']);?>"><img id="config" src="<?= url("templates/images/configuracoes.png"); ?>"></a>

		<form id="form_filtro" action="<?= url("colaborador/mapa/0"); ?>" method="get" >
			<select id="cd_material" name="cd_material" required onChange="this.form.submit()">
				<option style="background:#fff" value="default" disabled selected>Filtro</option>
				<option value="todos">Todos</option><!-- FILTRO SERA IGNORADO -->
				<option value="8">Todos os reciclaveis</option>
				<option value="1">Papel</option>
				<option value="2">Plástico</option>
				<option value="3">Metal</option>
				<option value="4">Vidro</option>
				<option value="6">Perigosos</option>
				<option value="7">Outros</option>
				<option value="5">Eletrônicos</option>
			</select>
		</form>

		<a href="<?= url("authentication/logoff"); ?>"><img id="sair" src="<?= url("templates/images/sair.gif"); ?>"></a>
	</nav>
</div>

<script type="text/javascript">
	//
	var directionsDisplay, directionsService, map;
	var markers = [];
	// Inicializa��o do maps
	function initialize() {
		var directionsService = new google.maps.DirectionsService();
		directionsDisplay = new google.maps.DirectionsRenderer();
		var latlng = {
			lat: -23.4969167,
			lng: -46.89554
		};
		map = new google.maps.Map(document.getElementById('mapa'), {
			zoom: 10,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		/*var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			title: '',
			icon: 'maps/img/home48.png',
			animation: google.maps.Animation.BOUNCE
		});*/
		directionsDisplay.setMap(map);
	}
	// Carregar pontos
	function carregarPontos() {
		var latlngbounds = new google.maps.LatLngBounds();
		$.each(<?= json_encode($rows); ?>, function(index, ponto) {
			var icone = "";
			// icone = '/projeto-reuse/templates/doador/maps/img/vermelho48.png';

			if (ponto.MATERIAL == "Papel") {
				icone = '/projeto-reuse/templates/doador/maps/img/papel.png';
			} else if (ponto.MATERIAL == "Plastico") {
				icone = '/projeto-reuse/templates/doador/maps/img/plastico.png';
			} else if (ponto.MATERIAL == "Metal") {
				icone = '/projeto-reuse/templates/doador/maps/img/metal.png';
			} else if (ponto.MATERIAL == "Vidro") {
				icone = '/projeto-reuse/templates/doador/maps/img/vidro.png';
			} else if (ponto.MATERIAL == "Perigosos") {
				icone = '/projeto-reuse/templates/doador/maps/img/perigosos.png';
			} else if (ponto.MATERIAL == "Outros") {
				icone = '/projeto-reuse/templates/doador/maps/img/outros.png';
			} else if (ponto.MATERIAL == "Eletronicos") {
				icone = '/projeto-reuse/templates/doador/maps/img/eletronicos.png';
			} else if (ponto.MATERIAL == "Todos os Recilaveis") {
				icone = '/projeto-reuse/templates/doador/maps/img/reciclavel.png';
			}

			// Informacoes ao PASSAR O MOUSE sobre o icone
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(ponto.LATITUDE, ponto.LONGITUDE),
				title: "MATERIAL: " + ponto.MATERIAL + "\n" +
					"NOME: " + ponto.NOME + "\n" +
					"E-MAIL: " + ponto.EMAIL,
				icon: icone,
				map: map
			});
			// Informacoes para CLIQUE no icone
			var infowindow = new google.maps.InfoWindow(),
				marker;
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					var html = "" +
						"<strong>MATERIAL:</strong> " + ponto.MATERIAL + "<br/>" +
						"<strong>NOME:</strong> " + ponto.NOME + "<br/>" +
						"<strong>EMAIL:</strong> " + ponto.EMAIL + "<br/>" +
						"<strong>TELEFONE:</strong> " + ponto.TELFIXO + "<br/>" +
						"<strong>CELULAR:</strong> " + ponto.TELCEL + "<br/>" +
						"<strong>ENDEREÇO:</strong> " + ponto.ENDERECO;
					infowindow.setContent(html);
					infowindow.open(map, marker, html);
				}
			})(marker));
			//
			google.maps.event.addListener(marker, 'dblclick', function(e) {
				map.setZoom(6);
				map.setCenter(e.latLng);
			});
			markers.push(marker);
			latlngbounds.extend(marker.position);
		});
		//var markerCluster = new MarkerClusterer(map, markers, {imagePath: 'maps/img/m'});
		map.fitBounds(latlngbounds);
	}
	//
	$(document).ready(function() {
		initialize();
		carregarPontos();
	});
</script>

<div id="mapa" style="position: absolute; overflow: hidden; width: 100% !important; height: 92% !important;"></div>

<div id="menuBottom">
	<nav>
		<a href="<?= url("colaborador/"); ?>">
			<img src="<?= url("templates/images/home.png"); ?>">
		</a>

		<a href="<?= url("colaborador/configuracao/".$_SESSION['cd_usu']);?>">
			<img src="<?= url("templates/images/configuracoes.png"); ?>">
		</a>

		<a href="<?= url("authentication/logoff"); ?>">
			<img src="<?= url("templates/images/sair.gif"); ?>">
		</a>

	</nav>
</div>

</div>