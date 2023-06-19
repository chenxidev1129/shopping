<?
    /* ============================================================================== */
    /* =   PAGE : 결제 정보 환경 설정 PAGE                                          = */
    /* =----------------------------------------------------------------------------= */
    /* =   연동시 오류가 발생하는 경우 아래의 주소로 접속하셔서 확인하시기 바랍니다.= */
    /* =   접속 주소 : https://kcp.co.kr/technique.requestcode.do                    = */
    /* =----------------------------------------------------------------------------= */
    /* =   Copyright (c)  2023   NHN KCP Inc.   All Rights Reserverd.                   = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* = ※ 주의 ※                                                                 = */
    /* = * 지불 데이터 설정                                                         = */
    /* =----------------------------------------------------------------------------= */
    /* = ※ 주의 ※                                                                 = */
	/* = * g_conf_home_dir 변수 설정                                                = */
    /* =   BIN 절대 경로 입력 (bin전까지 설정)                                      = */
    /* =                                                                            = */
    /* = * g_conf_key_dir 변수 설정                                                 = */
    /* =   pub.key 파일의 절대 경로 설정(파일명을 포함한 경로로 설정)               = */
    /* =                                                                            = */
    /* = * g_conf_log_dir 변수 설정                                                 = */
    /* =   log 디렉토리 설정                                                        = */
    /* ============================================================================== */

    $g_conf_home_dir  = "C:/APM_Setup/htdocs/smartphone_batch_windows_php";              // 절대경로 입력
    $g_conf_key_dir   = "C:/APM_Setup/htdocs/smartphone_batch_windows_php/pub.key";  // pub.key 파일의 경로 입력(파일명까지 입력)
    $g_conf_log_dir   = "C:/APM_Setup/htdocs/smartphone_batch_windows_php/log";          // log 절대경로 입력

    /* ============================================================================== */
    /* = ※ 주의 ※                                                                 = */
    /* = * g_conf_gw_url 설정                                                       = */
    /* =----------------------------------------------------------------------------= */
    /* = 테스트 시 : testpaygw.kcp.co.kr로 설정해 주십시오.                         = */
    /* = 실결제 시 : paygw.kcp.co.kr로 설정해 주십시오.                             = */
    /* ============================================================================== */
    $g_conf_gw_url    = "testpaygw.kcp.co.kr";

    /* ============================================================================== */
    /* = 스마트폰 SOAP 통신 설정                                                     = */
    /* =----------------------------------------------------------------------------= */
    /* = 테스트 시 : KCPPaymentService.wsdl                                         = */
    /* = 실결제 시 : real_KCPPaymentService.wsdl                                    = */
    /* ============================================================================== */
    $g_wsdl           = "KCPPaymentService.wsdl";

    /* ============================================================================== */
    /* = g_conf_site_cd, g_conf_site_key 설정                                       = */
    /* = 실결제시 NHN KCP에서 발급한 사이트코드(site_cd), 사이트키(site_key)를 반드시   = */
    /* = 변경해 주셔야 결제가 정상적으로 진행됩니다.                                = */
    /* =----------------------------------------------------------------------------= */
    /* = 테스트 시 : 사이트코드(A52Q7)로 설정해주십시오                             = */
    /* = 실결제 시 : 반드시 NHN KCP에서 발급한 사이트코드(site_cd)와 사이트키(site_key) = */
    /* =            로 설정해 주십시오.                                             = */
    /* ============================================================================== */
    $g_conf_site_cd   = "A52Q7";
    $g_conf_site_key  = "0ix4SBdG-hQjF5srJi8RZJx__";

    /* ============================================================================== */
    /* = g_conf_site_name 설정                                                      = */
    /* =----------------------------------------------------------------------------= */
    /* = 사이트명 설정(한글 불가) : 반드시 영문자로 설정하여 주시기 바랍니다.       = */
    /* ============================================================================== */
    $g_conf_site_name = "NHN KCP TEST SHOP";

    /* ============================================================================== */
    /* = 지불 데이터 셋업 (변경 불가)                                               = */
    /* ============================================================================== */
    $g_conf_log_level = "3";
    $g_conf_gw_port   = "8090";        // 포트번호(변경불가)
    $module_type      = "01";          // 변경불가
?>
