<?php
include_once ("data_objects/DAOConcurso.php");

function headerFunction($statusBar, $path){
    //print_r($_SESSION);

    ob_start();
    $path;

   	$arr=DAOConcurso_getActiveContests();
	$contestMenuItems='';
	$count = 0;
    foreach($arr as $key => $val){
    	$count++;
        $contestName = $val['nombre'];
        $contestId = $val['id_concurso'];
        $contestMenuItems .= '
				{                                    
					text: "'.$contestName.'",
					url: "./concurso.php?idt='.$contestId.'&show=det"
				}';
    }
    if($count==0){
    	$contestMenuItems .= '
				{                                    
					text: "Coming soon..."
				}';
    }

    ?>
<div id="header" >
	<div id="h_left">
		<a href="<?php echo $path;?>/index.php">
            <img  width="400" height="150" align="left" src="<?php echo $path;?>/images/rc_HuaHCoding2.png" border="0"/>
        </a>
	</div>
	<div id="h_right">
		<div id="h_r_top">
			<!-- add - Jonathan - 2012-06-10 -->
		<ul id="menu">
		</ul>
		<script>
		function abrir(){
			$("#aviso").css('display','block');
			$("#aviso").data("kendoWindow").center();
			$("#aviso").data("kendoWindow").open();
		}
		$(document).ready(function() {
			$("#aviso tr td").css('color','white');
			$("#menu").kendoMenu({
				dataSource:
				[	{
						text: "Concursos Activos",
						items: [
						<?php echo $contestMenuItems;?>
						]
					},
					{
						text: "Concursos Pasados",                              
						url: "./concurso_list.php"                                 
					},
					{
						text: "Ranking",
						items: [{                                    
							text: "General",
							url: "./ranking.php"
						},
						{
							text: "Escuelas",
							items: [{                                    
								text: "UNJFSC - Ing. Inform&aacutetica",
								url: "./ranking.php?ids=2",
								encoded: false
							},
							{
								 text: "UNJFSC - Ing. Sistemas",
								 url: "./ranking.php?ids=3"
							},
							{
								 text: "Universidad Nacional de Ingener&iacutea",
								 url: "./ranking.php?ids=4"
							}]
						}]
					},
					{
						text: "Ayuda",
						items: [
							{
								 text: "Tutoriales",
								 url: "./tutorials.php",
							},{                                    
								text: "Competici&oacuten General",
								url: "./reglas.php",
								encoded: false
							},{
								 text: "Sistema de Ranking",
								 url: "./reglas_ranking.php"
							}]
					}
				]
		 })
			//comentado jonathan 2012-07-16
			/*$("#aviso").kendoWindow({
					actions: ["Close"],
					height: "300px",
					modal: true,
					resizable: false,
					title: "Concurso vigente",
					width: "500px",
					visible: false
			});
			var t=setTimeout("abrir();",1000)*/
		});
		</script>
		</div>
		<div id="h_r_bottom">
			<div id="h_r_b_top">

			</div>
			<div id="h_r_b_bottom">
				<?php
		    		include ('header_userBar.php');
		    	?>
			</div>
			
		</div>
	</div>
</div>
<!-- STATUS BAR -->
<div id="bar">
	<?php
    	echo $statusBar;
    ?>
</div>

<?php
$re = ob_get_contents();
ob_end_clean();
return $re;
}
?>
