<h4>Alunos</h4>
<a class="btn btn-primary" href="?action=add"><i class="glyphicon glyphicon-plus"></i>Cadastar</a>
<a class="btn btn-primary" href="?pagina=home">Listar</a>
<hr>
<?php 
	$action = '';
	if (!empty($_GET['action'])) {
		$action = $_GET['action'];
	}
	if ($action == 'insert') {
		$nome_alu = addslashes($_POST['nome_alu']);
		$email_alu = addslashes($_POST['email_alu']);
		$bd->query("INSERT INTO tb_aluno (nome_alu,email_alu) VALUES ('$nome_alu','$email_alu')");
		$action = '';
	}
	if ($action == 'update') {
		$id_aluno = addslashes($_POST['id_aluno']);
		$nome_alu = addslashes($_POST['nome_alu']);
		$email_alu = addslashes($_POST['email_alu']);
		$bd->query("UPDATE tb_aluno SET nome_alu='$nome_alu',email_alu='$email_alu' WHERE id_aluno=$id_aluno");
		$action = '';
	}
	if ($action == 'add') {
		?>
		<form action="?action=insert" method="POST" name="form1" id="form1">
			<label>Nome</label>
			<input type="text" name="nome_alu" id="nome_alu" class="form-control">
			<label>Nome</label>
			<input type="email" name="email_alu" id="email_alu" class="form-control">
			<br>
			<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>Salvar</button>
			<a href="?" class="btn btn-default">Cancelar</a>
		</form>
		<?php
	}
	if ($action == 'edit') {
		$id_aluno = $_GET['id_aluno'];
		$bd->query("SELECT * FROM tb_aluno WHERE id_aluno=$id_aluno");
		foreach ($bd->result() as $dados) {
			?>
			<form action="?action=update" method="POST" name="form1" id="form1">
				<input type="hidden" name="id_aluno" id="id_aluno" class="form-control" value="<?php echo $dados['id_aluno']; ?>">
				<label>Nome</label>
				<input type="text" name="nome_alu" id="nome_alu" class="form-control" value="<?php echo $dados['nome_alu']; ?>">
				<label>Nome</label>
				<input type="email" name="email_alu" id="email_alu" class="form-control" value="<?php echo $dados['email_alu']; ?>">
				<br>
				<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>Salvar</button>
				<a href="?" class="btn btn-default">Cancelar</a>
			</form>
		<?php
		}
	}
	if ($action == 'delete') {
		$id_aluno = $_GET['id_aluno'];
		$bd->query("DELETE FROM tb_aluno WHERE id_aluno=$id_aluno");
		$action = '';
	}
	if ($action == '') {
		$bd->query("SELECT * FROM tb_aluno");
		$total = $bd->linhas();
		if ($total == '') {
			echo 'Nenhum resultado encontrado!';
		} else {
			?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Email</th>
						<th align="center">Opções</th>
					</tr>
				</thead>
				<tbody>
					<?php
						echo 'Total de registros encontrados: '.$total;
						foreach ($bd->result() as $dados) {
							?>
							<tr>
								<td><?php echo $dados['id_aluno'] ?></td>
								<td><?php echo $dados['nome_alu'] ?></td>
								<td><?php echo $dados['email_alu'] ?></td>
								<td>
									<a class="btn btn-primary btn-sm" href="?action=edit&id_aluno=<?php echo $dados['id_aluno'];?>"><i class="glyphicon glyphicon-pencil"></i></a>
									<a class="btn btn-danger btn-sm" href="?action=delete&id_aluno=<?php echo $dados['id_aluno'];?>"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
			<?php
		}
	}
?>