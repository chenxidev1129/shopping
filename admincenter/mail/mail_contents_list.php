<?include_once $_SERVER[DOCUMENT_ROOT] . "/pub/inc/comm.php";?>
<?
	Fnc_Acc_Admin();
	Fnc_Preloading()		// @@@@@@ 페이지 호출 시 프리로딩 이미지 출력
?>
<?
	$page = Fnc_Om_Conv_Default($_REQUEST[page],1);
	$displayrow = Fnc_Om_Conv_Default($_REQUEST[displayrow],10);
	$displaypage = Fnc_Om_Conv_Default($_REQUEST[displaypage],10);

	$Txt_title = Fnc_Om_Conv_Default($_REQUEST[Txt_title],"");
	$Txt_service = Fnc_Om_Conv_Default($_REQUEST[Txt_service],"");

	$Txt_sindate = Fnc_Om_Conv_Default($_REQUEST[Txt_sindate],"");
	$Txt_eindate = Fnc_Om_Conv_Default($_REQUEST[Txt_eindate],"");

	If ($Txt_title!="") { $Str_Query .= " and a.str_title like '%$Txt_title%' ";}
	If ($Txt_service!="") { $Str_Query .= " and a.str_service = '$Txt_service' ";}

	if ($Txt_sindate!="") { $Str_Query .= " and date_format(a.dtm_indate, '%Y-%m-%d') >= '$Txt_sindate' ";}
	if ($Txt_eindate!="") { $Str_Query .= " and date_format(a.dtm_indate, '%Y-%m-%d') <= '$Txt_eindate' ";}

	$SQL_QUERY="select count(a.int_number) from ";
	$SQL_QUERY.=$Tname;
	$SQL_QUERY.="comm_mail_master a where a.int_number is not null ";
	$SQL_QUERY.=$Str_Query;
	$result = mysql_query($SQL_QUERY);

	if(!result){
	   error("QUERY_ERROR");
	   exit;
	}
	$total_record = mysql_result($result,0,0);

	if(!$total_record){
		$first = 1;
		$last = 0;
	}else{
	  	$first = $displayrow *($page-1) ;
	  	$last = $displayrow *$page;

	  	$IsNext = $total_record - $last ;
	  	if($IsNext > 0){
			$last -= 1;
	  	}else{
	   		$last = $total_record -1 ;
	  	}
	}
	$total_page = ceil($total_record/$displayrow);

	$f_limit=$first;
	$l_limit=$last + 1 ;

	$SQL_QUERY = "select a.* from ";
	$SQL_QUERY.=$Tname;
	$SQL_QUERY.="comm_mail_master a ";
	$SQL_QUERY.="where a.int_number is not null ";
	$SQL_QUERY.=$Str_Query;
	$SQL_QUERY.="order by a.dtm_indate desc ";
	$SQL_QUERY.="limit $f_limit,$l_limit";

	$result = mysql_query($SQL_QUERY);
	if(!$result) {
	 	error("QUERY_ERROR");
	 	exit;
	}
	$total_record_limit=mysql_num_rows($result);
?>
<html>
<head>
<?include $_SERVER[DOCUMENT_ROOT] . "/admincenter/inc/inc_header_info.php";?>
<script language="javascript" src="js/mail_contents_list.js"></script>
</head>
<body class=scroll>
<table width=100% height=100% cellpadding=0 cellspacing=0 border=0>
	<tr>
		<?include $_SERVER[DOCUMENT_ROOT] . "/admincenter/inc/inc_logo_info.php";?>
		<td width=100%>
			<?include $_SERVER[DOCUMENT_ROOT] . "/admincenter/inc/inc_tmenu_info.php";?>
		</td>
	</tr>
	<tr>
		<td colspan="3"><?include $_SERVER[DOCUMENT_ROOT] . "/admincenter/inc/inc_tmenu.php";?></td>
	</tr>
	<tr>
		<td valign=top id=leftMenu>
			<?include $_SERVER[DOCUMENT_ROOT] . "/admincenter/inc/inc_lmenu_info.php";?>
		</td>
		<td colspan=2 valign=top height=100%> 
			<?include $_SERVER[DOCUMENT_ROOT] . "/admincenter/inc/inc_stitle_info.php";?>
			<table width=100%>
				<tr>
					<td style="padding:10px">
						<div class="title title_top"><?=Fnc_Om_Loc_Name("01".$arr_Auth[7]);?></div>

						<form id="frm" name="frm" target="_self" method="POST" action="edu_edu1_list.php">
						<input type="hidden" name="RetrieveFlag" value="<?=$RetrieveFlag?>">
						<input type="hidden" name="page" value="<?=$page?>">
						<input type="hidden" name="str_no">

						
						<table class=tb>
							<col class=cellC style="width:12%"><col class=cellL style="width:38%">
							<col class=cellC style="width:12%"><col class=cellL style="width:38%">
							<tr>
								<td>제목</td>
								<td>
									<input type="text" NAME="Txt_title" value="<?=$Txt_title?>" style="width:300px;">
								</td>
								<td>승인여부</td>
								<td>
									<select name="Txt_service">
										<option value="" selected> 전체 </option>
										<option value="Y" <?If ($Txt_service=="Y") {?>selected<?}?>> 승인 </option>
										<option value="N" <?If ($Txt_service=="N") {?>selected<?}?>> 미승인 </option>
									</select>
								</td>
							</tr>
							<tr>
								<td>등록일자</td>
								<td colspan="3">
									<input type=text name=Txt_sindate value="<?=$Txt_sindate?>" id="Txt_sindate" onclick="displayCalendar(document.frm.Txt_sindate ,'yyyy-mm-dd',this)">
									<img src="/pub/img/icons/calendar_add.gif" align="absmiddle" style="cursor:hand" onclick="displayCalendar(document.frm.Txt_sindate ,'yyyy-mm-dd',document.frm.Txt_sindate)">
									<img src="/pub/img/icons/calendar_delete.gif" align="absmiddle" style="cursor:hand" onclick="document.frm.Txt_sindate.value=''";>
									 -
									<input type=text name=Txt_eindate value="<?=$Txt_eindate?>" id="Txt_eindate" onclick="displayCalendar(document.frm.Txt_eindate ,'yyyy-mm-dd',this)">
									<img src="/pub/img/icons/calendar_add.gif" align="absmiddle" style="cursor:hand" onclick="displayCalendar(document.frm.Txt_eindate ,'yyyy-mm-dd',document.frm.Txt_eindate)">
									<img src="/pub/img/icons/calendar_delete.gif" align="absmiddle" style="cursor:hand" onclick="document.frm.Txt_eindate.value=''";>
									<a href="javascript:setDate('Txt_sindate','Txt_eindate','<?=date("Y-m-d")?>','<?=date("Y-m-d")?>')"><img src="/admincenter/img/sicon_today.gif" align=absmiddle></a>
									<a href="javascript:setDate('Txt_sindate','Txt_eindate','<?=date("Y-m-d", strtotime($day."-7day"))?>','<?=date("Y-m-d")?>')"><img src="/admincenter/img/sicon_week.gif" align=absmiddle></a>
									<a href="javascript:setDate('Txt_sindate','Txt_eindate','<?=date("Y-m-d", strtotime($day."-15day"))?>','<?=date("Y-m-d")?>')"><img src="/admincenter/img/sicon_twoweek.gif" align=absmiddle></a>
									<a href="javascript:setDate('Txt_sindate','Txt_eindate','<?=date("Y-m-d", strtotime($month."-1month"))?>','<?=date("Y-m-d")?>')"><img src="/admincenter/img/sicon_month.gif" align=absmiddle></a>
									<a href="javascript:setDate('Txt_sindate','Txt_eindate','<?=date("Y-m-d", strtotime($month."-2month"))?>','<?=date("Y-m-d")?>')"><img src="/admincenter/img/sicon_twomonth.gif" align=absmiddle></a>
									<a href="javascript:setDate('Txt_sindate','Txt_eindate','','')"><img src="/admincenter/img/sicon_all.gif" align=absmiddle></a>
								</td>
							</tr>
						</table>
						
						<div class=button_top><img src="/admincenter/img/btn_search2.gif" style="cursor:hand" onClick="fnc_search();"></div>

						<table width=100%>
							<tr>
								<td class=pageInfo>총 <b><?=$total_record?></b>건, <b><?=$page?></b> of <?=$total_page?> Pages</td>
								<td align=right>
								<select name=displayrow onchange="fnc_search()">
									<?for ($i = 10; $i <= 100; ($i++)*5) {?>
									<option value="<?=$i?>" <?If (Trim($i)==trim($displayrow)) {?>selected<?}?>><?=$i?>개 출력
									<?}?>
								</select>
								</td>
							</tr>
						</table>
						
						<table width=100% cellpadding=0 cellspacing=0 border=0>
							<tr><td class=rnd colspan=7></td></tr>
							<tr class=rndbg>
								<th>번호</th>
								<th>제목</th>
								<th>받은회원</th>
								<th>읽은회원</th>
								<th>등록일자</th>
								<th>수정</th>
								<th>삭제</th>
							</tr>
							<tr><td class=rnd colspan=7></td></tr>
							<col width=5% align=center>
							<col width=42% align=left>
							<col width=15% align=center>
							<col width=15% align=center>
							<col width=15% align=center>
							<col width=4% align=center>
							<col width=4% align=center>
							<?$count=0;?>
							<?if($total_record_limit!=0){?>
							<?$article_num = $total_record - $displayrow*($page-1) ;?>
							<?for($i = 0 ;$i <= $displayrow -1; $i++) {?>
							<tr height=30 align="center">
								<td><font class=ver81 color=616161><?= $article_num?></font></td>
								<td style="text-align:left;"><?=mysql_result($result,$i,str_title)?></td>
								<td>
									<?
									$SQL_QUERY="select count(b.str_userid) as cnt from ";
									$SQL_QUERY.=$Tname;
									$SQL_QUERY.="comm_mail_master a, ".$Tname."comm_mail_history b where a.int_number=b.int_number and a.int_number='".mysql_result($result,$i,int_number)."' ";
									$result1 = mysql_query($SQL_QUERY);
								
									if(!result1){
									   error("QUERY_ERROR");
									   exit;
									}
									$cnt1 = mysql_result($result1,0,0);
									?>
									<?=$cnt1?> 명
								</td>
								<td>
									<?
									$SQL_QUERY="select count(b.str_userid) as cnt from ";
									$SQL_QUERY.=$Tname;
									$SQL_QUERY.="comm_mail_master a, ".$Tname."comm_mail_history b where a.int_number=b.int_number and a.int_number='".mysql_result($result,$i,int_number)."' and b.str_read_f='Y' ";
									$result2 = mysql_query($SQL_QUERY);
								
									if(!result2){
									   error("QUERY_ERROR");
									   exit;
									}
									$cnt2 = mysql_result($result2,0,0);
									?>
									<?=$cnt2?> 명
								</td>
								<td><?=mysql_result($result,$i,dtm_indate)?></td>
								<td><a href="javascript:RowClick('<?=mysql_result($result,$i,int_number)?>');"><img src="/admincenter/img/i_edit.gif"></a></td>
								<td class="noline"><input type=checkbox name=chkItem1 value="<?=mysql_result($result,$i,int_number)?>"></td>
							</tr>
							<tr><td colspan=7 class=rndline></td></tr>
							<?
							$article_num--;
							if($article_num==0){
								break;
							}
							?>
							<?$count++;?>
							<?}?>
							<?}?>
							<input type="hidden" name="txtRows" value="<%=count%>">
						</table>
						
						<div align=center class=pageNavi>
						<?
						$total_block = ceil($total_page/$displaypage);
						$block = ceil($page/$displaypage);

						$first_page = ($block-1)*$displaypage;
						$last_page = $block*$displaypage;

						if($total_block <= $block) {
   							$last_page = $total_page;
						}

						$file_link= basename($PHP_SELF);
						$link="$file_link?$param";

						if($page > 1) {?>
							<a href="Javascript:MovePage('1');" class=navi>◀◀</a>
						<?}else{?>
							◀◀
						<?}

						if($block > 1) {
						   $my_page = $first_page;
						?>
							<a href="Javascript:MovePage('<?=$my_page?>');" class=navi>◀</a>
						<?}else{?>
							◀
						<?}

						echo" | ";
						for($direct_page = $first_page+1; $direct_page <= $last_page; $direct_page++) {
						   if($page == $direct_page) {?>
						      	<font color='cccccc'><b><?=$direct_page?></b></font> |
						   <?} else {?>
						    	<a href="Javascript:MovePage('<?=$direct_page?>');" class=navi><?=$direct_page?></a> |
						   <?}
						}

						echo" ";

						if($block < $total_block) {
						   	$my_page = $last_page+1;?>
						    <a href="Javascript:MovePage('<?=$my_page?>');" class=navi>▶</a>
						<?}else{ ?>
							▶
						<?}

						if($page < $total_page) {?>
							<a href="Javascript:MovePage('<?=$total_page?>');" class=navi>▶▶</a>
						<?}else{?>
							▶▶
						<?}
						?>
						</div>

						<div style="float:left;">
						<img src="/admincenter/img/btn_allselect_s.gif" alt="전체선택"  border="0" align='absmiddle' style="cursor:hand" onclick="javascript:selectItem('1');">
						<img src="/admincenter/img/btn_alldeselect_s.gif" alt="선택해제"  border="0" align='absmiddle' style="cursor:hand" onclick="javascript:selectItem('2');">
						<img src="/admincenter/img/btn_alldelet_s.gif" alt="선택삭제" border="0" align='absmiddle' style="cursor:hand" onclick="javaScript:Adelete_Click();">
						</div>

						<div style="float:right;">
						<img src="/admincenter/img/btn_regist_s.gif" alt="등록" border=0 align=absmiddle style="cursor:hand" onClick="AddNew();">
						</div>
						</form>
						
						<?include $_SERVER[DOCUMENT_ROOT] . "/admincenter/inc/inc_btip_info.php";?>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr><td height=3 bgcolor="#E6E6E6" colspan=2></td></tr>
	<?include $_SERVER[DOCUMENT_ROOT] . "/admincenter/inc/inc_copyright_info.php";?>
</table>
<script>table_design_load();</script>
</body>
</html>
