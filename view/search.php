<?php 
	$companies = $_REQUEST['result'];
	include('header.php');
?>

<div class="container-fluid content">
	<div class="container content-msg">
		<div class="row pt-5">
			<div class="col page-header text-left">
				<div style="display: flex;height: 39px;">
					<div class='btn-return'>
						<a href='javascript:history.back()'>
							<span class="material-icons" style='font-size: 39px'>
								arrow_left
							</span>
						</a>
					</div>
					<div style="margin-left: 7px;">
						Resultado da busca
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container content-body" style="display: grid;">
	<?php
		if ($companies['rows'] > 0){
			foreach($companies['data'] as $comp){
				$expired = (strtotime($comp['expire_date']) > strtotime(date("Y/m/d")) ? 0 : 1);
				echo	"<div class='row pt-2 category-company' style='order: ".$expired."'>
							<a href='/". $_SERVER["INDEX"] .  $comp["company_id"]. "/company/" .str_replace(" ", "-", $comp["name"])."'>
								<div class='row'>
									<div class='col category-company-name' >".$comp["name"]." ".($expired ? "": "<span class='material-icons me-2 category-star'>star_rate</span>")."
									</div>
								</div>
								<div class='row'>
									<div class='col category-company-descr'>".$comp['description']."</div>
								</div>
							</a>
						</div>";
			}
		}
	?>
	</div>
<div>
