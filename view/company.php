<?php 
	$company = $_REQUEST['company'];
	$expired = (strtotime($company['data'][0]['expire_date']) > strtotime(date("Y/m/d")) ? 0 : 1);
	include('header.php');
?>

<div class="container-fluid content">
	<div class="container content-msg">
		<div class="row pt-5 justify-content-md-center">
			<div class="col-lg-6 page-header text-left">
				<div style="display: flex;height: 39px;">
					<div class='btn-return'>
						<a href='javascript:history.back()'>
							<span class="material-icons md-dark" style='font-size: 39px'>
								arrow_left
							</span>
						</a>
					</div>
					<div style="margin-left: 7px;">
						<?php echo $company['data'][0]['name'].($expired ? "": "<span class='material-icons me-2 company-star'>star_rate</span>"); ?>
					</div>
					<div class="col text-end title-category">
						<?php echo $company['data'][0]['category']; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container content-body" style="display: grid;">
	<?php
		if ($company['rows'] > 0){
			echo "<div class='row justify-content-md-center'>";
			foreach($company['data'] as $comp){
				$phones_HTML = "";
				foreach($company['phones']['data'] as $phone){
					$phones_HTML .= "<div class='col call-number' style='display: flex;'> <span class='material-icons icon-call'>call</span> ".
					($phone['is_main'] ? '<strong style="color: #7d4fa4">' :'').$phone['number'].($phone['is_main'] ? '</strong>' :'').
					" </div>";
				}
				
				echo "<div class='col-lg-6 company-infos'>
						<div class='row'>
							<div class='col-6'><strong>Empresa:</strong> ".$comp['name']."</div>	
							<div class='col-6 text-end'><strong>".$comp['city']."/".$comp['state']."</strong></div>	
						</div>
						<div class='col mt-1'><strong>Endereço:</strong> ".$comp['address']."</div>	
						<div class='row mt-2 mb-2 mt-2' style='border-left: 1px solid #f2f2f2; border-bottom: 1px solid #f2f2f2;border-top: 1px solid #f2f2f2;'>".
							$phones_HTML
						."</div>
						<div class='col mt-3'><strong>Descrição:</strong> ".$comp['description']."</div>	
					</div>";
			}
			echo "</div>";
		}
	?>
	</div>
</div>


