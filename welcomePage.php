<?php
include_once ('container.php');
include_once 'registrationForm.php';
include_once 'table.php';
include_once 'GLOBALS.php';

$rankField="position";

//LAST SEASON
$columns = array(
        array("us.id_usuario",  "username",     -1, ""),
        array("c.$rankField",   "El",            20, ""),
        array("c.id_ranking",   "Top",             0,  "","img images/ranking gif"),
        array("us.username",    "5",   120,"","linked 0 user"),
        array("c.puntos",       "",          30, "class='pts'"),
);

$condition = "WHERE c.id_usuario = us.id_usuario ".
        " AND c.id_temporada = $GLOBAL_CURRENT_SEASON ".
        " AND c.$rankField >=1 ".
        "ORDER BY 2 ASC,1 ASC LIMIT 5";
$tables = "competidor c, usuario us";
$table = new RCTable(conecDb(),$tables,10,$columns,$condition);
$table->setTitle("Top 5 Rumbo a Coneis");
$table->setFooter("<a href=\"./ranking.php\"> Ver todo el ranking </a>");
//showPage("Ranking de $title", false, $table->getTable(), "");
$tableTopFiveSeason2 = $table->getTable();
//END LAST SEASON

$columns = array(
        array("us.id_usuario",  "username",     -1, ""),
        array("c.$rankField",   "El",            20, ""),
        array("c.id_ranking",   "Top",             0,  "","img images/ranking gif"),
        array("us.username",    "5",   120,"","linked 0 user"),
        array("c.puntos",       "",          30, "class='pts'"),
);

$condition = "WHERE c.id_usuario = us.id_usuario ".
        " AND c.id_temporada = 1".
        " AND c.$rankField >=1 ".
        "ORDER BY 2 ASC,1 ASC LIMIT 5";
$tables = "competidor c, usuario us";
$table = new RCTable(conecDb(),$tables,10,$columns,$condition);
$table->setTitle("Top 5 de la 1ra Temporada");
$table->setFooter("<a href=\"./ranking.php?seasonid=1\"> Ver todo el ranking </a>");
//showPage("Ranking de $title", false, $table->getTable(), "");
$tableTopFive = $table->getTable();

//TABLE NEXT EVENT
$tablesNextEvent="concurso co";
$columnsNE = array(
        array("co.id_concurso",  "contest",     -1, ""),
        array("nombre_corto",  "Siguente",     70, "","linked 0 concurso"),
        array("date(fecha)",   "Evento",            90, "","date"),
        array("time(fecha)",   "",            30, "","time")
);
$conditionNE = "WHERE co.estado in('REGISTRATION_OPEN','REGISTRATION_CLOSED')".
        "ORDER BY 1 ASC LIMIT 5";
$tableNEvent = new RCTable(conecDb(),$tablesNextEvent,10,$columnsNE,$conditionNE);
$tableNEvent->setTitle("Siguiente Concurso");
$tableNEvent->setTableAtr("width='218'");
$tableNextEvent = $tableNEvent->getTable();

//TABLE PAST CONTESTS
$tablesPC="concurso co";
$columnsPC = array(
        array("co.id_concurso",  "",     -1, ""),
        array("co.nombre_corto",  "",     60, "","linked 0 con_res"),
        array("'practicar'",  "",     60,"", "linked 0 con_pra"),
        array("date(fecha)",   "Evento",            80, "class='penalty'","date"),
);
$conditionPC = "WHERE co.estado = 'FINALIZED'".
        "ORDER BY 4 DESC";
$tablePC = new RCTable(conecDb(),$tablesPC,10,$columnsPC,$conditionPC);
$tablePC->setTitle("Concursos Pasados");
$tablePC->setFooter("<a href='./concurso_list.php'>Ver Mas</a>");
$tablePastContest = $tablePC->getTable();
//TABLE RECENT Threads
/*
$tablesThread= "thread t, forum f";
$colThread = array(    
        array("t.threadid",  "",     -1, ""),
        array("concat(f.title,' / ',t.title)",  "",     200, 'style="padding-top: 5px;padding-bottom: 5px;"',"linked 0 thread"),
        array("'>|'",  "",     10,"", "linked 0 lastpost")
);
$conditionThread = " WHERE f.forumid=t.forumid ".
        "ORDER BY t.lastpost DESC LIMIT 7";
$threadsTable = new RCTable(forumConexion(),$tablesThread,10,$colThread,$conditionThread);
$threadsTable->setTitle("Temas Comentados Ultimamente");
$threadsTable->setFooter("<a href=\"./forum\"> Ver todos los temas </a>")
//$tableThread->setTableAtr('style="margin-top: 5px;"');
*/

        ?>

<br/>

<!-- Twitter widget -->
<!-- <script src="http://widgets.twimg.com/j/2/widget.js"></script> -->

<table border="1" cellpadding="0" cellspacing="0" width="100%" height="300" border="0" style="width: 100%;">
    <tr>
        <td width="230" max valign="top">
            <?php echo $tablePastContest ?>
            <br/>
            

            

            <!-- FB Badge START -->
            <br/>
            <a href="http://www.facebook.com/profile.php?id=100001127811497&v=wall" title="HuaH Facebook" target="_blank" style="font-family: tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;">We are on FB!</a><br/><a href="http://www.facebook.com/profile.php?id=100001127811497&v=wall" title="Huah Facebook" target="_blank"><img src="http://badge.facebook.com/badge/100001127811497.393.2141042559.png" width="120" height="77" style="border: 0px;" /></a><br/>
            <!-- FB Badge END -->
        </td>
        <td align="center">
            <table width="100%">
                <tr>
                    <td align="left">
                        <?php include "home/welcome.htm" ?>

                    </td>
                </tr>
                <tr>
                    <td align="center">
                         <script>
                        //     new TWTR.Widget({
                        //         version: 2,
                        //         type: 'profile',
                        //         rpp: 30,
                        //         interval: 6000,
                        //         width: 400,
                        //         height: 300,
                        //         theme: {
                        //             shell: {
                        //                 background: '#363636',
                        //                 color: '#faa019'
                        //             },
                        //             tweets: {
                        //                 background: '#000000',
                        //                 color: '#ffffff',
                        //                 links: '#347fdb'
                        //             }
                        //         },
                        //         features: {
                        //             scrollbar: false,
                        //             loop: false,
                        //             live: false,
                        //             hashtags: true,
                        //             timestamp: true,
                        //             avatars: false,
                        //             behavior: 'all'
                        //         }
                        //     }).render().setUser('HuaHCoding').start();
                        </script>
                    </td>

                </tr>
            </table>
        </td>
        <td width="230" valign="top">
            <?php echo $tableNextEvent."<br/>".
                    $tableTopFiveSeason2."</br>".
                    $tableTopFive."</br>";
            ?>
            <form action="user.php">
            	<input type="search"
                placeholder="HuaHCoder" name="uname">
            </form>
        </td>
    </tr>
</table>
<br/>
<!-- FB Like Button START-->
<fb:like href="http://huahcoding.com" layout="standard" width="100px" show_faces="true" font="verdana"></fb:like>
<!-- FB Like Button END-->
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<!-- add - Jonathan - 2012-07-03 -->
<div id="aviso" style="display:none">
	<table width="400" border="2" align="center" class="concursoDetail">
		<tbody>
			<tr>
			</tr>
			<tr>
				<td colspan="2">
					<img src="images/contest_banner.png">
				</td>
			</tr>
			<tr>
				<td align="center" class="concursoTitle" colspan="2">
					Concurso Rumbo Coneis Fase 1
				</td>
			</tr>
			<tr>
				<td class="torneolabel">
					Fecha:
				</td>
				<td>
					S&aacute;bado 14 de Julio del 2012 a las 03:00 pm
				</td>
			</tr>
			<tr>
				<td class="torneolabel">
					Locaci&oacute;n:
				</td>
				<td>
					Universidad Jos&eacute; Faustino S&aacute;nchez Carri&oacute;n - Laboratorio 2
				</td>
			</tr>
			<tr>
				<td class="torneolabel">
					Inscripci&oacute;n:
				</td>
				<td>
					Totalmente gratis
				</td>
			</tr>
			<tr>
				<td class="torneolabel">
					Estado:
				</td>
				<td>
					REGISTRATION_OPEN
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
					<!-- space -->
				</td>
			</tr>
			<tr>
				<td colspan="2">
					HuahCoding Premiara con inscripci&oacute;n y pasajes al coneis 2012
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
					<!-- space -->
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<a href="./concurso_enrollUser.php?cId=16">[registrarse]</a> <a href="./concurso_registeredUsers.php?id=16">
						[ver registrados]</a> <a href="">[discute este evento]</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script>
	function abrir(){
		$("#aviso").css('display','block');
		$("#aviso").data("kendoWindow").center();
		$("#aviso").data("kendoWindow").open();
	}
	$(document).ready(function() {
		//comentado - jonathan - 2012-07-16
		/*$("#aviso tr td").css('color','white');
		$("#aviso").kendoWindow({
				actions: ["Close"],
				height: "350px",
				modal: true,
				resizable: false,
				title: "Concurso vigente",
				width: "500px",
				visible: false
		});
		var t=setTimeout("abrir();",1500)*/
	});
</script>