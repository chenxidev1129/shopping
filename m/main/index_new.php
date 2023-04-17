<?include_once $_SERVER[DOCUMENT_ROOT] . "/pub/inc/comm.php";?>
<?
	$str_Ini_Group_Table = "@01";
	$str_Board_Icon_Img = "/pub/img/board/";
	$Sql_Query =	" SELECT
					A.BD_SEQ,
					A.CONF_SEQ,
					A.BD_ID_KEY,
					A.BD_IDX,
					A.BD_ORDER,
					A.BD_LEVEL,
					A.MEM_CODE,
					A.MEM_ID,
					A.BD_W_NAME,
					A.BD_W_EMAIL,
					A.BD_TITLE,
					A.BD_CONT,
					A.BD_OPEN_YN,
					A.BD_REG_DATE,
					A.BD_DEL_YN,
					A.BD_VIEW_CNT,
					A.BD_GOOD_CNT,
					A.BD_BAD_CNT,
					IFNULL(A.BD_MEMO_CNT, 0) AS BD_MEMO_CNT,
					IFNULL(C.IMG_SEQ, 0) AS IMG_SEQ,
					IFNULL(C.IMG_ID_KEY, '') AS IMG_ID_KEY,
					IFNULL(C.IMG_TITLE, '') AS IMG_TITLE,
					IFNULL(C.IMG_CONT, '') AS IMG_CONT,
					IFNULL(C.IMG_F_WIDTH, 0) AS IMG_F_WIDTH,
					IFNULL(C.IMG_F_HEIGHT, 0) AS IMG_F_HEIGHT,
					IFNULL(D.FILE_SEQ, 0) AS FILE_SEQ
				FROM `"
					.$Tname."b_bd_data".$str_Ini_Group_Table."` AS A
					LEFT JOIN `"
					.$Tname."b_img_data".$str_Ini_Group_Table."` AS C
					ON
					A.CONF_SEQ=C.CONF_SEQ
					AND
					A.BD_SEQ=C.BD_SEQ
					AND
					C.IMG_ALIGN=1
					LEFT JOIN `"
					.$Tname."b_file_data".$str_Ini_Group_Table."` AS D
					ON
					A.CONF_SEQ=D.CONF_SEQ
					AND
					A.BD_SEQ=D.BD_SEQ
					AND
					D.FILE_ALIGN=1
				WHERE ";
	$Sql_Query .= " A.CONF_SEQ=1 AND ";
	$Sql_Query .= " A.BD_ID_KEY IS NOT NULL ";
	$Sql_Query .= " ORDER BY
								BD_ORDER DESC ";
	$Sql_Query.="limit 3";

	$arr_Get_Data5= mysql_query($Sql_Query);
	if(!$arr_Get_Data5) {
	 	error("QUERY_ERROR");
	 	exit;
	}
	$arr_Get_Data_Cnt5=mysql_num_rows($arr_Get_Data5);
?>
<? require_once $_SERVER[DOCUMENT_ROOT]."/m/inc/header.php"; ?>

		<div class="m_visual">
			<div class="swiper-container1">
				 <div class="swiper-wrapper">
					<?
					$SQL_QUERY = "select a.* from ".$Tname."comm_banner a where a.str_service='Y' and a.int_gubun='6' order by a.int_number asc ";
		
					$arr_Bann_Data=mysql_query($SQL_QUERY);
					$arr_Bann_Data_Cnt=mysql_num_rows($arr_Bann_Data);
					?>
					<?
						for($int_J = 0 ;$int_J < $arr_Bann_Data_Cnt; $int_J++) {
					?>
					<?if (mysql_result($arr_Bann_Data,$int_J,str_image1)!="") {?>
					<div class="swiper-slide">
					<?if (mysql_result($arr_Bann_Data,$int_J,str_url1)!=""){?>
						<a href="<?=mysql_result($arr_Bann_Data,$int_J,str_url1)?>" <?if (mysql_result($arr_Bann_Data,$int_J,str_target1)=="2"){?> target="_blank"<?}?>>
					<?}?>
					<img src="/admincenter/files/bann/<?=mysql_result($arr_Bann_Data,$int_J,str_image1)?>" alt="" />
					<?if (mysql_result($arr_Bann_Data,$int_J,str_url1)!=""){?>
						</a>
					<?}?>
					</div>
					<?}?>
					<?
						}
					?>
				</div>
				<!-- Add Pagination -->
				<div class="swiper-pagination"></div>
				<!-- Add Arrows -->
				
			</div>
			<script>
				var swiper = new Swiper('.swiper-container1', {
					effect: 'fade',
					pagination: '.swiper-pagination',
					paginationClickable: true,
					spaceBetween: 0,
					centeredSlides: true,
					autoplay: 2500,
					autoplayDisableOnInteraction: false,
					loop: true
				});
			</script>
		</div>
		<div class="m_event"><span class="tit">NOTICE</span>
			<script type="text/javascript" src="/js/jquery.bxslider.js"></script>
			<link type="text/css" rel="stylesheet" href="/css/jquery.bxslider.css" />
			<ul class="bxslider">
				<?
					for($int_I = 0 ;$int_I < $arr_Get_Data_Cnt5; $int_I++) {
				?>
				<li>
					<a href="/boad/bd_news/m1/egoread.php?bd=<?=mysql_result($arr_Get_Data5,$int_I,conf_seq)?>&seq=<?=mysql_result($arr_Get_Data5,$int_I,bd_seq)?>">
					
					<?
						// &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
						//	= 비공개글 표시 아이콘 변수에 저장 시작
						$str_Tmp = "";
						If (mysql_result($arr_Get_Data5,$int_I,bd_open_yn)>0) {
							$str_Tmp = "<img src='".$str_Board_Icon_Img."ic_key.gif' border='0' align='absMiddle' style='width:12px;height:14px;'> ";
						}
						//	= 비공개글 표시 아이콘 변수에 저장 종료
						// &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
					?>
					<?=$str_Tmp?>
					<?
						// ========================
						//	= 메모글 갯수 출력 시작
						If (mysql_result($arr_Get_Data5,$int_I,bd_memo_cnt)>0) {
							echo " (<img src='".$str_Board_Icon_Img."ic_memo.gif' align='absMiddle' border='0'> " . mysql_result($arr_Get_Data5,$int_I,bd_memo_cnt) . ") ";
						}
						//	= 메모글 갯수 출력 종료
						// ========================
						
						$str_Tmp = mb_strimwidth(stripslashes(mysql_result($arr_Get_Data5,$int_I,bd_title)),0,80,"...","utf-8");
					?>
					<?=$str_Tmp?>
					</a>
				</li>
				<?
					}
				?>
			</ul>
			<script type="text/javascript">
				$(document).ready(function(){
					$('.bxslider').bxSlider({
						auto: true,
						controls:false,
						pager:false,
						mode: 'vertical',
					});
				});
			</script>
		</div>
		
		<div class="con_width">
			<div class="main_tit"><span>NEW</span></div>
			<ul class="new_list">
				<?
				$SQL_QUERY = "SELECT 
											A.*,
											(SELECT B.STR_BCODE FROM ".$Tname."comm_goods_master_category B WHERE A.STR_GOODCODE=B.STR_GOODCODE LIMIT 1) AS STR_BCODE,
											(SELECT IFNULL(COUNT(Z.STR_USERID),0) AS CNT FROM ".$Tname."comm_member_like Z WHERE Z.STR_GOODCODE=A.STR_GOODCODE) AS LIKECNT, 
											(SELECT IFNULL(COUNT(D.STR_USERID),0) AS CNT FROM ".$Tname."comm_goods_cart D WHERE D.STR_GOODCODE=A.STR_GOODCODE AND D.STR_USERID='".$arr_Auth[0]."' AND D.INT_STATE IN ('4')) AS CARTCNT,
											E.STR_CODE
										FROM 
											".$Tname."comm_goods_master A
											LEFT JOIN
											".$Tname."comm_com_code E
											ON
											A.INT_BRAND=E.INT_NUMBER
										WHERE 
											A.STR_GOODCODE IS NOT NULL 
											AND 
											(A.STR_SERVICE='Y' OR A.STR_SERVICE='R') 
											AND 
											A.STR_MMYN='Y' 
										ORDER BY 
											A.STR_GOODCODE DESC";
	
				$arr_Data=mysql_query($SQL_QUERY);
				$arr_Data_Cnt=mysql_num_rows($arr_Data);
				?>
				<?$sBuy = fnc_buy_info();?>
				<?
					for($int_J = 0 ;$int_J < $arr_Data_Cnt; $int_J++) {
				?>
				<?$sRent=fnc_cart_info(mysql_result($arr_Data,$int_J,str_goodcode));?>
				<li>
					<?if ($sRent==0) {?>
					<span class="rented">RENTED</span>
					<?}?>
					<p class="zzim_icn"><img src="../images/icn_zzim_on.png" alt="" /> <?=mysql_result($arr_Data,$int_J,likecnt)?></p>
					<a href="/m/category/detail.php?Txt_bcode=<?=mysql_result($arr_Data,$int_J,str_bcode)?>&str_no=<?=mysql_result($arr_Data,$int_J,str_goodcode)?>">
						<p><?if (mysql_result($arr_Data,$int_J,str_image1)!="") {?><img src="/admincenter/files/good/<?=mysql_result($arr_Data,$int_J,str_image1)?>" border="0"><?}?></p>
						<dl>
							<dt><?=mysql_result($arr_Data,$int_J,str_code)?></dt>
							<dd><?=mysql_result($arr_Data,$int_J,str_egoodname)?></dd>
						</dl>
					</a>
				</li>
				<?
					}
				?>

			</ul>
			<p><a href="/m/category/list.php" class="btn btn_readmore">MORE BAGS <i class="icn"></i></a></p>
			<div class="main_tit"><span>BRAND</span></div>
			<div class="m_brand">
				<ul>
					<?
					$SQL_QUERY = "select a.* from ".$Tname."comm_com_code a where a.str_service='Y' and a.int_gubun='2' order by a.int_number asc ";
		
					$arr_Bann_Data=mysql_query($SQL_QUERY);
					$arr_Bann_Data_Cnt=mysql_num_rows($arr_Bann_Data);
					?>
					<?
						for($int_J = 0 ;$int_J < $arr_Bann_Data_Cnt; $int_J++) {
					?>
					<li><a href="/m/search/search.php?Txt_brand[]=<?=mysql_result($arr_Bann_Data,$int_J,int_number)?>"><span><?if (mysql_result($arr_Bann_Data,$int_J,str_image1)!="") {?><img src="/admincenter/files/com/<?=mysql_result($arr_Bann_Data,$int_J,str_image1)?>" alt="" /><?}?></span></a></li>
					<?
						}
					?>
				</ul>
			</div>
			
		</div>
		<div class="mt25" style="display:none;">
			<?
			$SQL_QUERY = "select a.* from ".$Tname."comm_banner a where a.str_service='Y' and a.int_gubun='4' order by a.int_number asc ";

			$arr_Bann_Data=mysql_query($SQL_QUERY);
			$arr_Bann_Data_Cnt=mysql_num_rows($arr_Bann_Data);
			?>
			<?
				for($int_J = 0 ;$int_J < $arr_Bann_Data_Cnt; $int_J++) {
			?>
			<?if (mysql_result($arr_Bann_Data,$int_J,str_image1)!="") {?>
			<p>
				<?if (mysql_result($arr_Bann_Data,$int_J,str_url1)!=""){?>
					<a href="<?=mysql_result($arr_Bann_Data,$int_J,str_url1)?>" <?if (mysql_result($arr_Bann_Data,$int_J,str_target1)=="2"){?> target="_blank"<?}?>>
				<?}?>
				<img src="/admincenter/files/bann/<?=mysql_result($arr_Bann_Data,$int_J,str_image1)?>" alt="" />
				<?if (mysql_result($arr_Bann_Data,$int_J,str_url1)!=""){?>
					</a>
				<?}?>
			</p>
			<?}?>
			<?
				}
			?>
		</div>
		<div class="banner_line2 mt25"> 
			<p><a href="#;"><img src="/admincenter/files/bann/Untitled-1.jpg" alt="" /></a></p>
			<p><a href="#;"><img src="/admincenter/files/bann/Untitled-2.jpg" alt="" /></a></p>
			<p><a href="#;"><img src="/admincenter/files/bann/Untitled-2.jpg" alt="" /></a></p>
			<p><a href="#;"><img src="/admincenter/files/bann/Untitled-1.jpg" alt="" /></a></p>
			<p><a href="#;"><img src="/admincenter/files/bann/Untitled-1.jpg" alt="" /></a></p>
			<p><a href="#;"><img src="/admincenter/files/bann/Untitled-2.jpg" alt="" /></a></p>
		</div>
		<div class="con_width">
			<?
			$SQL_QUERY = "select a.* from ".$Tname."comm_banner a where a.str_service='Y' and a.int_gubun='5' order by a.int_number asc ";

			$arr_Bann_Data=mysql_query($SQL_QUERY);
			$arr_Bann_Data_Cnt=mysql_num_rows($arr_Bann_Data);
			?>
			<?
				for($int_J = 0 ;$int_J < $arr_Bann_Data_Cnt; $int_J++) {
			?>
			<?if (mysql_result($arr_Bann_Data,$int_J,str_image1)!="") {?>
			<p class="m_service">
				<?if (mysql_result($arr_Bann_Data,$int_J,str_url1)!=""){?>
					<a href="<?=mysql_result($arr_Bann_Data,$int_J,str_url1)?>" <?if (mysql_result($arr_Bann_Data,$int_J,str_target1)=="2"){?> target="_blank"<?}?>>
				<?}?>
				<img src="/admincenter/files/bann/<?=mysql_result($arr_Bann_Data,$int_J,str_image1)?>" alt="" />
				<?if (mysql_result($arr_Bann_Data,$int_J,str_url1)!=""){?>
					</a>
				<?}?>
			</p>
			<?}?>
			<?
				}
			?>
			
			<div class="main_membership">
			 	<div class="js-open-modal" data-what="js-example-modal-1"><img src="../images/membership_banner.png" alt="멤버십 이용 가이드" /></div>
			</div>
			<div class="modal__wrapper is-hidden js-example-modal-1">
				<div class="modal__double js-modal__double">
					<div class="modal__content">
						<a href="#" class="modal__close js-modal__close"></a>
						<div class="contents_bx">
							<p style="height:315px;overflow-y:scroll;border:1px solid #ccc;"><img src="../images/membership_guide_mobile02.gif" alt="멤버십 이용 가이드" /></p>
							<p class="center mt10"><a href="/m/mypage/membership.php" class="btn btn_bk btn_s">멤버십 등록하러 가기</a></p>
						</div>
					</div>
				</div>
			</div>
			
			<link rel="stylesheet" href="/m/css/simplePop.css">
	
			<script src="/m/js/simplePopup.js"></script>
			<script type="text/javascript">
				$(function(){

					$('.js-open-modal').each(function(){

						var modalClass = $(this).data('what');
						var $modal = $('.' + modalClass);
						var $this = $(this);


						var code = $modal.html();
						var textarea = $this.parents('.example__item').append('<div class="example__code"><textarea></textarea></div>').find('textarea');
						textarea.val(code);

						$this.on('click', function(){
							$modal.simplePop();
						});

					});

				});
			</script>
			
			<!-- <link rel="stylesheet" href="/m/css/dialog.css">
				
			
			<script src="/m/js/dialog.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#btn-01').click(function(){
						$.dialog({
							contentHtml : '<p><img src="../images/membership_guide_mobile.jpg" /></p><p class="center mt10"><a href="/m/mypage/membership.php" class="btn btn_bk btn_s">멤버십 등록하러 가기</a></p>'
						});
					});
				});
			</script> -->
			
			

			
			<div class="m_benefit">
				<p class="tit">에이블랑만의 혜택</p>
				<ul>
					<li><span class="img"><i class="icn icn_bnf01"></i></span><span class="txt">월 89,000원에 다양한 명품 가방을 제한없이 이용하세요.</span></li>
					<li><span class="img"><i class="icn icn_bnf02"></i></span><span class="txt">백화점.매장에서 직접 구매한  100% 정품입니다.</span></li>
					<li><span class="img"><i class="icn icn_bnf03"></i></span><span class="txt">언제든 원하는 가방으로 교환 신청하세요.</span></li>
					<li><span class="img"><i class="icn icn_bnf04"></i></span><span class="txt">오전 11시 이전 GET한 가방은  당일 출고됩니다.</span></li>
					<li><span class="img"><i class="icn icn_bnf05"></i></span><span class="txt">생활스크래치 안심보험을  제공하고 있습니다.</span></li>
				</ul>
			</div>
		</div>


<? require_once $_SERVER[DOCUMENT_ROOT]."/m/inc/footer.php"; ?>