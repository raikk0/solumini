<?php
	$data = $_REQUEST['data'];
	include('header.php');
?>

<div class="container-fluid content-admin">
	<div class="container content-body manage-content">
		<div class="row manage-menu mt-3">
			<div class="col-2 btn-menu-admin"><a href="/<?php echo $_SERVER["INDEX"] ?>admin/1">Empresas</a></div>
			<div class="col-2 btn-menu-admin"><a href="/<?php echo $_SERVER["INDEX"] ?>admin/2">Contratos</a></div>
		</div>
		<div class="row manage-context">
			<!-- Lista -->
			<div class="col-2 manage-list">
				<?php
					echo "<div class='col manage-list-col manage-list-add'  onClick='showFormToAdd(".$_REQUEST['type'].");'>Adicionar +</div>";
					if ($data['rows'] > 0){
						foreach($data['data'] as $info){
							echo "<a href='/".$_SERVER['INDEX']."admin/".$_REQUEST['type']."/".$info['id']."'><div class='col manage-list-col' id='".$_REQUEST['type']."_".$info['id']."'>".$info["name"]."</div></a>";
						}
					}
				?>
			</div>
			<div class="col-10 manage-data">
				<?php 
					switch ($_REQUEST['type']) {
						case 1: # Companies
							echo "<form style='display:none;' action='/".$_SERVER['INDEX']."index.php?page=admin&action=insertUpdate&type=1' method='post' onsubmit='return validateForm(this);'>";
							echo	 "<div class='row mt-3'>";
							echo		 "<div class='form-group col-md-2'>";
							echo			"<label for='inputId'>Id</label>";
							echo			"<input class='form-control' readonly='readonly' type='text' value='' id='inputId' name='inputId'>";
							echo		 "</div>";
							echo		 "<div class='form-group col-md-5'>";
							echo			"<label for='inputName'>Nome</label>";
							echo			"<input class='form-control' condition='true' type='text' value='' id='inputName' name='inputName'>";
							echo			"<div class='invalid-feedback'>É necessário um nome para a empresa.</div>";
							echo		 "</div>";
							echo		 "<div class='form-group col-md-5'>";
							echo			"<label for='inputCategory'>Categoria</label>";
							echo			"<select class='form-select' condition='true' name='inputCategory' id='inputCategory'>";
							foreach($data['categories']['data'] as $category){
								echo			"<option value='".$category['id']."'>".$category['name']."</option>";
							}
							echo			"</select>";
							echo			"<div class='invalid-feedback'>É necessário uma categoria.</div>";
							echo		"</div>";
							echo	"</div>";

							echo	 "<div class='row mt-3'>";
							echo		 "<div class='form-group col-md-2'>";
							echo			"<label for='inputState'>Estado</label>";
							echo			"<input class='form-control' type='text' value='' id='inputState' name='inputState'>";
							echo		 "</div>";
							echo		 "<div class='form-group col-md-4'>";
							echo			"<label for='inputCity'>Cidade</label>";
							echo			"<input class='form-control' type='text' value='' id='inputCity' name='inputCity'>";
							echo		 "</div>";
							echo		 "<div class='form-group col-md-6'>";
							echo			"<label for='inputAddress'>Endereço</label>";
							echo			"<input class='form-control' type='text' value='' id='inputAddress' name='inputAddress'>";
							echo		"</div>";
							echo	"</div>";

							echo	 "<div class='row mt-3'>";
							echo		 "<div class='form-group col-md-12'>";
							echo			"<label for='inputDescription'>Descrição</label>";
							echo			"<input class='form-control' type='text' value='' id='inputDescription' name='inputDescription'>";
							echo		 "</div>";
							echo	"</div>";

							echo "<div class='row row-cols-6 flex-row-reverse mt-3'>";
							echo 	"<div class='col-sm-2 text-end'><button type='submit' class='btn btn-primary'>Salvar</button></div>";
							echo 	"<div class='col-sm-9 text-end'><div onClick='deleteRegistry()' class='btn btn-danger'>Excluir Empresa</div></div>";
							echo 	"<div class='col-sm-1 text-end'><div onClick='showPhones()' class='btn btn-primary' style='display: inline-flex;'>Telefones
										<span class='material-icons'>arrow_drop_down</span>
									</div></div>";
							echo "</div>";

							echo "</form>";
							echo "<div class='col phones-content'><div class='phone-item phone-item-add' onClick='toggleInputAddNumber()'>Adicionar +</div></div>";
						break;

						case 2: # Contracts
							echo "<form style='display:none;' action='/".$_SERVER['INDEX']."index.php?page=admin&action=insertUpdate&type=2' method='post' onsubmit='return validateForm(this);'>";
							echo	 "<div class='row mt-3'>";
							echo		 "<div class='form-group col-md-2'>";
							echo			"<label for='inputId'>Id</label>";
							echo			"<input class='form-control' readonly='readonly' type='text' value='' id='inputId' name='inputId'>";
							echo		 "</div>";
							echo		 "<div class='form-group col-md-5'>";
							echo			"<label for='inputName'>Dono da empresa</label>";
							echo			"<input class='form-control' condition='true' type='text' value='' id='inputCompanyOwner' name='inputCompanyOwner'>";
							echo			"<div class='invalid-feedback'>É necessário o nome do dono da empresa.</div>";
							echo		 "</div>";
							echo		 "<div class='form-group col-md-5'>";
							echo			"<label for='inputCategory'>Empresa</label>";
							echo			"<select class='form-select' condition='true' name='inputCompanyId' id='inputCompanyId'>";
							foreach($data['companies']['data'] as $company){
								echo			"<option value='".$company['id']."'>".$company['name']."</option>";
							}
							echo			"</select>";
							echo			"<div class='invalid-feedback'>É necessário vincular a empresa.</div>";
							echo		"</div>";
							echo	"</div>";

							echo	 "<div class='row mt-3'>";
							echo		 "<div class='form-group col-md-9'>";
							echo			"<label for='inputState'>Vendedor</label>";
							echo			"<input class='form-control'condition='true' type='text' value='' id='inputSellerName' name='inputSellerName'>";
							echo			"<div class='invalid-feedback'>É necessário informar o vendedor.</div>";
							echo		 "</div>";
							echo		 "<div class='form-group col-md-3'>";
							echo			"<label for='inputState'>Data de Expiração</label>";
							echo			"<input class='form-control'condition='true' type='date' value='' id='inputExpireDate' name='inputExpireDate'>";
							echo			"<div class='invalid-feedback'>É necessário informar a data de expiração.</div>";
							echo		 "</div>";
							echo	"</div>";

							echo "<div class='row row-cols-6 flex-row-reverse mt-3'>";
							echo 	"<div class='col-sm-2 text-end'><button type='submit' class='btn btn-primary'>Salvar</button></div>";
							echo 	"<div class='col-sm-3 text-end'><div onClick='deleteRegistry()' class='btn btn-danger'>Excluir Contrato</button></div>";
							echo "</div>";

							echo "</form>";
					}
				?>
			</div>
			
		</div>
	<div>
<div>


<script>

let errorInfo = '<?php echo @$_REQUEST['errorInfo'];?>';
<?php if(!empty($data['selected']))
{
	echo "fillForm()";
}
?>

function showFormToAdd(type){
	let form = document.forms[0];

	form.style.display = 'block';
	let btnsDanger = document.getElementsByClassName('btn-danger');
	btnsDanger[0].style.display = 'none';

	if(type == 2)
	{
		form['inputCompanyId'].firstElementChild.remove();
	}
	
	clearForm();
}

function clearForm(){
	let form = document.forms[0];

	let els = document.getElementsByClassName('manage-list-col');
	Array.from(els).forEach((col) => {
		col.classList.remove('manage-list-selected');
	});

	Array.from(form.elements).forEach((input) => {
		input.value = '';
	});
}

function deleteRegistry(){
	let type = <?php echo $_REQUEST['type'] ?>;
	let form = document.forms[0];

	window.location.href = `/<?php echo $_SERVER['INDEX'];?>index.php?page=admin&action=deleteRegistry&type=${type}&id=${form['inputId'].value}`;
}



function fillForm(){
	let selected_id = '<?php echo @$_REQUEST['selected'] ?>';
	let type = <?php echo $_REQUEST['type'] ?>;
	let data = <?php echo @json_encode($data['selected']['data']) ?>[0];
	let phones = <?php echo @json_encode($data['selected']['phones']['data']) ?>;

	let el = document.getElementById(`${type}_${selected_id}`);
	el.classList.add('manage-list-selected');


	let form = document.forms[0];
	if(type == 1){
		form['inputId'].value = data['id'];
		form['inputName'].value = data['name'];
		form['inputCategory'].value = data['category_id'];
		form['inputState'].value = data['state'];
		form['inputCity'].value = data['city'];
		form['inputAddress'].value = data['address'];
		form['inputDescription'].value = data['description'];

		let phoneDiv = ``;
		if(phones.length > 0){
			for(var p in phones){
				 $('.phones-content').append(`<div class='phone-item'>
				 <div class='col-9 phone-number'>${phones[p]['number']}</div>
				 <div class='col-3 phone-remove'>
				 <span class='material-icons icon-star' onClick='togglePhoneMain("${phones[p]['id']}","${data['id']}", "${phones[p]['is_main']}")' data-toggle="tooltip" title='Principal' style='${(phones[p]['is_main'] == 1 ? 'background-color: #eac60a;' : '')}'>star</span>
				 <span onClick="deletePhone('${phones[p]['id']}', '${data['id']}')" class="material-icons icon-remove">close</span>
				 </div>`);
			}
		}

		let index = '<?php echo $_SERVER['INDEX'] ?>';

		$('.phones-content').append(`\
			<form action='/${index}index.php?page=admin&action=insertPhone&type=1&company_id=${data['id']}' method='post'><div class='phone-add-input phone-item'>\
				<div class='col-9'>\
					<input type='hidden' class='input-add-number' name='id_number'  size='5' value='0'>\
					<input type='text' class='input-add-number' name='number' placeholder='xxxxxxxxxxx' size='12'>\
				</div>\
				<div class='col-3'><button type='submit' class='material-icons icon-done'>done</button></div>\
			</div></form>`)
	}
	

	if(type == 2){
		form['inputId'].value = data['id'];
		form['inputCompanyOwner'].value = data['company_owner'];
		form['inputCompanyId'].value = data['company_id'];
		form['inputSellerName'].value = data['seller_name'];
		form['inputExpireDate'].value = data['expire_date'];
	}

	form.style.display = 'block';
}

function toggleInputAddNumber(){
	$('.phone-add-input').slideToggle('medium', function () {
		if($(this).is(':visible'))
			$(this).css('display', 'flex');
	});
}

function showPhones(){
	$('.phones-content').slideToggle();
}
function togglePhoneMain(id, company_id, val){
	let new_val = val == 0 ? 1 : 0;
	window.location.href = `/<?php echo $_SERVER['INDEX'];?>index.php?page=admin&action=toggleMain&type=1&id=${id}&company_id=${company_id}&val=${new_val}`;
}

function deletePhone(id, company_id){
	window.location.href = `/<?php echo $_SERVER['INDEX'];?>index.php?page=admin&action=deletePhone&type=1&id=${id}&company_id=${company_id}`;
}

function validateForm(form){
	let invalid = 0;
	Array.from(form.elements).forEach((input) => {
		if(!empty(input.name) && input.hasAttribute('condition')){
			invalid += validateInput(input);
		}
	});
	if(invalid)
		return false;
}

function validateInput(input){
	if(empty(input.value)){
		input.value = '';
		input.focus();
		input.classList.add('is-invalid');
		return 1;
	}else{
		input.classList.remove('is-invalid');
		return 0;
	}
}

</script>