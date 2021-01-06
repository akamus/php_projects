<?php
namespace Package;

require_once '../vendor/autoload.php';

use Package\Model;

class Controller {

	public $regex   = '';
	public $paginar = '';

	public function __construct() {

		$this->regex   = new \Package\Model;
		$this->paginar = 10;//paginar de até 10
	}

	public function processar($filtros = []) {
		if (empty($filtros)) {
			$filtros = ['java', ''];
		}

		//var_dump($filtros);

		//$urlPadrao = $this->regex->setUrlParaBuscarComFiltro($filtros[0]);
		$urlPadrao = "https://www.pciconcursos.com.br/provas/fcc-tecnologia/";

		$html = $this->regex->getHtmlDaPagina($urlPadrao);

		$quantidadeDePaginas = $this->regex->getQuantidadeDePaginasEncontradas($html);
		$this->log($quantidadeDePaginas);
		if ($quantidadeDePaginas > 15) {
			$quantidadeDePaginas = $this->paginar;
		}

		//$this->regex->print_log('tste');
		// BUSCA DE URLS PRIMEIRO FILTRO - > cargo exemplo

		$_urlsParaBuscarZip    = [];
		$listaUrlAposFiltroAno = '';

		if ($quantidadeDePaginas == 1) {//caso retorne Uma página

			//$_urlsParaBuscarZip    = $this->regex->buscarLinksEmHtml($html);
			//$listaUrlAposFiltroAno = $this->regex->buscarUrlComFiltroAnoUmaPagina($_urlsParaBuscarZip, $filtros[1]);

		} elseif ($quantidadeDePaginas > 1) {//busca por paginação
		$this->log("+ de 1 pag");
			
		//	$_urlsParaBuscarZip    = $this->regex->buscarLinksEmHtmlVariasPaginas($html, $urlPadrao, $quantidadeDePaginas);
		//	$listaUrlAposFiltroAno = $this->regex->buscarUrlComFiltroAno($_urlsParaBuscarZip, $filtros[1]);

		} else {
		$this->log("not found page");

			exit();
		}

		echo "paginação finalizada<br/>";

		// MOSTRAR URLS ZIP

		$listaZipFinal = $this->regex->buscarLinkZip($listaUrlAposFiltroAno);

		// var_dump($listaZipFinal);
		echo '******* Copie e cole em um Gerenciador de Download!!! ******   Encontrados: '.count($listaZipFinal).' <br/><br/>';

		$this->regex->print_array($listaZipFinal);

	}

	public function log($texto) {
		echo "<script>console.log('$texto')</script>";
	}

}
