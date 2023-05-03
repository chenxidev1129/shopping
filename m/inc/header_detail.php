<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <title>Detail</title>
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/common/favicon.png" />


    <link href="/m/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/m/css/swiper.min.css">
    <script src="/m/js/swiper.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <link rel="styleSheet" href="/pub/css/dhtml_calendar.css">
    <script src="/admincenter/js/common.js"></script>
    <script src="/pub/js/CommScript.js"></script>
    <script src="/pub/js/dhtml_calendar.js"></script>
</head>

<body>
    <div class="header-mobile">
        <div class="header-alert">
            <script type="text/javascript" src="/js/jquery.bxslider.js"></script>
            <link type="text/css" rel="stylesheet" href="/css/jquery.bxslider.css" />
            <ul class="bxslider">
                <?
                for ($int_I = 0; $int_I < $arr_Get_Data_Cnt5; $int_I++) {
                ?>
                    <li>
                        <a href="/boad/bd_news/m1/egoread.php?bd=<?= mysql_result($arr_Get_Data5, $int_I, conf_seq) ?>&seq=<?= mysql_result($arr_Get_Data5, $int_I, bd_seq) ?>">

                            <?
                            // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                            //	= 비공개글 표시 아이콘 변수에 저장 시작
                            $str_Tmp = "";
                            if (mysql_result($arr_Get_Data5, $int_I, bd_open_yn) > 0) {
                                $str_Tmp = "<img src='" . $str_Board_Icon_Img . "ic_key.gif' border='0' align='absMiddle' style='width:12px;height:14px;'> ";
                            }
                            //	= 비공개글 표시 아이콘 변수에 저장 종료
                            // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                            ?>
                            <?= $str_Tmp ?>
                            <?
                            // ========================
                            //	= 메모글 갯수 출력 시작
                            if (mysql_result($arr_Get_Data5, $int_I, bd_memo_cnt) > 0) {
                                echo " (<img src='" . $str_Board_Icon_Img . "ic_memo.gif' align='absMiddle' border='0'> " . mysql_result($arr_Get_Data5, $int_I, bd_memo_cnt) . ") ";
                            }
                            //	= 메모글 갯수 출력 종료
                            // ========================

                            $str_Tmp = mb_strimwidth(stripslashes(mysql_result($arr_Get_Data5, $int_I, bd_title)), 0, 80, "...", "utf-8");
                            ?>
                            <?= $str_Tmp ?>
                        </a>
                    </li>
                <?
                }
                ?>
            </ul>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.bxslider').bxSlider({
                        auto: true,
                        controls: false,
                        pager: false,
                        mode: 'vertical',
                    });
                });
            </script>
        </div>
        <div class="detail-header-content">
            <a href="#" class="back-btn">
                <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.41475 14.2576L0.202765 7.81002C0.129032 7.73327 0.0769276 7.65012 0.0464514 7.56057C0.0154837 7.47102 0 7.37507 0 7.27273C0 7.17038 0.0154837 7.07444 0.0464514 6.98489C0.0769276 6.89534 0.129032 6.81218 0.202765 6.73543L6.41475 0.268649C6.58679 0.0895498 6.80184 0 7.05991 0C7.31797 0 7.53917 0.0959463 7.7235 0.287839C7.90783 0.479731 8 0.703606 8 0.959463C8 1.21532 7.90783 1.43919 7.7235 1.63109L2.30415 7.27273L7.7235 12.9144C7.89555 13.0935 7.98157 13.314 7.98157 13.576C7.98157 13.8385 7.8894 14.0657 7.70507 14.2576C7.52074 14.4495 7.30568 14.5455 7.05991 14.5455C6.81413 14.5455 6.59908 14.4495 6.41475 14.2576Z" fill="black" />
                </svg>
            </a>
            <p class="title">ABLANC</p>
            <div class="right-menu">
                <a href="#">
                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.5 15.1818C14.1941 15.1818 18 11.7363 18 7.81967C18 3.90308 14.1941 1 9.5 1C4.80587 1 1 4.17482 1 8.09141C1 9.62007 1.58012 11.0365 2.56719 12.1937L1.53125 17L5.692 14.4327C6.89767 14.9318 8.19266 15.1866 9.5 15.1818Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <a href="#">
                    <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5385 0H1.46154C1.07391 0 0.702166 0.153246 0.428075 0.426026C0.153983 0.698807 0 1.06878 0 1.45455V14.5455C0 14.9312 0.153983 15.3012 0.428075 15.574C0.702166 15.8468 1.07391 16 1.46154 16H17.5385C17.9261 16 18.2978 15.8468 18.5719 15.574C18.846 15.3012 19 14.9312 19 14.5455V1.45455C19 1.06878 18.846 0.698807 18.5719 0.426026C18.2978 0.153246 17.9261 0 17.5385 0ZM17.5385 14.5455H1.46154V1.45455H17.5385V14.5455ZM13.8846 4.36364C13.8846 5.52095 13.4227 6.63085 12.6004 7.44919C11.7781 8.26753 10.6629 8.72727 9.5 8.72727C8.33713 8.72727 7.22188 8.26753 6.39961 7.44919C5.57733 6.63085 5.11538 5.52095 5.11538 4.36364C5.11538 4.17075 5.19238 3.98577 5.32942 3.84938C5.46647 3.71299 5.65234 3.63636 5.84615 3.63636C6.03997 3.63636 6.22584 3.71299 6.36289 3.84938C6.49993 3.98577 6.57692 4.17075 6.57692 4.36364C6.57692 5.13518 6.88489 5.87511 7.43307 6.42067C7.98126 6.96624 8.72475 7.27273 9.5 7.27273C10.2752 7.27273 11.0187 6.96624 11.5669 6.42067C12.1151 5.87511 12.4231 5.13518 12.4231 4.36364C12.4231 4.17075 12.5001 3.98577 12.6371 3.84938C12.7742 3.71299 12.96 3.63636 13.1538 3.63636C13.3477 3.63636 13.5335 3.71299 13.6706 3.84938C13.8076 3.98577 13.8846 4.17075 13.8846 4.36364Z" fill="black" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="detail-wrapper">