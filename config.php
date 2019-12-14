<?php 
if (!class_exists('Banco')) {
	class Banco
	{
		private $linhas; #contar numero de registros encontrados
		private $array_dados;
		public $pdo;
		public $banco;

		public function __construct()
		{
			try {
				if ($_SERVER['SERVER_NAME'] == 'localhost') {
					$host = 'localhost';
					$usuario = 'root';
					$senha = '';
					$bd = 'aluno';
				} else { #pode colocar os dados do servidor online
					$host = 'localhost';
					$usuario = 'root';
					$senha = '';
					$bd = 'aluno';
				}
				

				$this->banco = $bd;
				$this->pdo = new PDO("mysql:dbname=".$bd.";host=".$host,$usuario,$senha);
				$this->pdo->exec("set names utf8");
			} catch(PDOException $e) {
				echo 'Não foi possível conectar ao banco de dados: ' . $e->getMessage();
			}
		}
		public function query($sql)
		{
			$query = $this->pdo->query($sql);
			$this->linhas = $query->rowCount();
			$this->array_dados = $query->fetchAll();
		}
		public function linhas()
		{
			return $this->linhas;
		}
		public function result()
		{
			return $this->array_dados;
		}
	}
}
