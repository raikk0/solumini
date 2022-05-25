<?php 
	$categories = $_REQUEST['categories'];
	include('header.php');
?>

<script>
function insertCategoryOnScroll(category)
{
	const el = document.getElementsByClassName("animate-text");
	const span = document.createElement("span");

	span.innerHTML = category;
	el[0].append(span);
}
</script>

<div class="container-fluid content">
	<div class="container content-msg">
		<div class="row pt-5">
			<div class="col-7 text-end msg-home">
				Aqui você encontra empresas de 
			</div>
			<div class="col-5 pt-1 ps-0">
				<p class="animate-text">
				</p>
			</div>
		</div>
	</div>
	<div class="container content-search mt-5 text-center">
		<input type='text' class="form-control input-search" name='inputText' id='inputText'>
		<span class="btn btn-primary btn-search">Pesquisar</span>
	</div>
	<div class="container content-body mt-5" style="padding-left: 10%;padding-right: 10%;align-items: center;">
	<?php
		if ($categories['rows'] > 0){
			echo '<div class="row justify-content-md-center list-categories">';
			foreach($categories['data'] as $categ){
				echo "<script type='text/javascript'>insertCategoryOnScroll('".$categ['name']."')</script>";

				echo "<div class='col-2 text-center' style='display:inline-table; margin-left: 5px; margin-top: 15px;'><a href='/". $_SERVER['INDEX'] . $categ['id']."/companies'>
				<div ><img class='category_img' src='images/".$categ['image_file']."'></div>
				<div class='category_descr' style='font-size:14px;'><span class='category_descr_qtd'>".$categ['qtdCompanies']."</span> empresa".($categ['qtdCompanies'] > 1 ? 's': '')." em</div>
				<div class='category_descr category_name'>".$categ["name"]."</div>
				
				</a></div>";
			}
			echo "</div>";
		}
	?>
	</div>


</div>

<script>

if (navigator.userAgent.match(/Mobile/)) {
	document.getElementsByClassName('msg-home')[0].innerHTML = 'Empresas de';
}

$('.btn-search').click(()=>{
	let text = $('.input-search').val();
	if(!empty(text))
		window.location.href = `search/${text}`;
})

const {children: titles} = document.querySelector(".animate-text");
const txtsLen = titles.length;
let index = 0;
const textInTimer = 2500;
const textOutTimer = 2200;

function animateText() {
  for (let i = 0; i < txtsLen; i++) {
    titles[i].classList.remove("text-in", "text-out");
  }
  titles[index].classList.add("text-in");

  setTimeout(function () {
    titles[index].classList.add("text-out");
  }, textOutTimer);

  setTimeout(function () {
    if (index == txtsLen - 1) {
      index = 0;
    } else {
      index++;
    }
    animateText();
  }, textInTimer);
}

window.onload = animateText;

</script>