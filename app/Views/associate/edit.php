<?=$this->extend('./layouts/app')?>

<?=$this->section('title')?>
	Editar Asociado
<?=$this->endSection()?>

<?=$this->section('breadcrumb')?>
	<div class="c-subheader">
		<ol class="breadcrumb border-0 m-0">
			<li class="breadcrumb-item"><?=anchor('/home', 'Inicio')?></li>
			<li class="breadcrumb-item"><?=anchor('associates', 'Asociados')?></li>
			<li class="breadcrumb-item">Editar Asociado</li>
		</ol>
	</div>
<?=$this->endSection()?>

<?=$this->section('content')?>
	<sgp-associate-edit-form :id="<?=$associate['id']?>"></sgp-associate-edit-form>
<?=$this->endSection()?>