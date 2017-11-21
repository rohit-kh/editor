<?php
$c_key = "LEqQec7STnnZdT1Ea4eBJVmID";
$c_secret = "OCfpuuUNeCW0irDdM4YZgRsDa89bOC6JfmR0pDNlbCZ0UJZ2zq";
$a_t = "744947292-6gbC8iPR1Z2dDNSVyykhd59NjmO1y0cWxNLoGNS2";
$a_t_s = "FSCbEtlg47nXgoQS0RSX9Sr64wnl790S8jApqKrv2Gw74";
require "wordc/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
$connection = new TwitterOAuth($c_key,$c_secret,$a_t,$a_t_s);
$content = $connection->get("account/verify_credentials");
if($_REQUEST['act']=='query'){
    $dss = trim($_REQUEST['q']);
    $max_id = "";
    $arrs = array();
    foreach (range(1, 10) as $i) {
        $query = array(
            "q" => $dss,
            "count" => 50,
            "result_type" => "recent",
            "max_id" => $max_id
        );
        $results = $connection->get('search/tweets', $query);

        foreach ($results->statuses as $result) {
            $arr = array();
            $arr['u_thumbnail'] = $result->user->profile_image_url;
            $arr['u_name'] = $result->user->name;
            $arr['u_sname'] = $result->user->screen_name;
            $arr['u_text'] = $result->text;
            array_push($arrs, $arr);
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        $sd = array('success'=>'true','count_t'=>$time,'counts'=>count($arrs),"data"=>$arrs);

    }
    if(count($arrs)>200){
        $sd = array('success'=>'true','count_t'=>$time,'counts'=>count($arrs),"data"=>$arrs);
    }else{
        $sd = array('success'=>'false');
    }
    echo json_encode($sd);
}
?>