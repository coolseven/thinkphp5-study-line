<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\wamp64\www\thinkphp5-study-line\public/../application/frontend\view\ali_pay\index.html";i:1499593342;}*/ ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购物车</title>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<style type="text/css">
    *{margin:0px;padding:0px;border:0px; font-size:12px;color:#333; font-family:微软雅黑;}
    ul li{ list-style:none}
    a{ text-decoration:none;}
    a:hover{ color:#e46432;}
    body{margin:auto;;overflow-x:hidden;}


    /*****购物车*********/
    .gwc{ width:950px;overflow:hidden;}
    .gwc_tb1{ width:100%; border-top:5px solid #48b9e5; background:#d0e7fa; height:38px; margin-top:20px; overflow:hidden;}
    .tb1_td1{ width:35px; text-align:center;}
    .tb1_td3{ width:290px; text-align:center;}
    .tb1_td4{ width:260px; text-align:center;}
    .tb1_td5{ width:115px; text-align:center;}
    .tb1_td6{ width:135px; text-align:center;}
    .tb1_td7{ text-align:center;}


    .gwc_tb2{ width:100%; margin-top:20px; background:#eef6ff; border:1px solid #e5e5e5; padding-top:20px; padding-bottom:20px;}
    .tb2_td1{ width:60px; text-align:center;}
    .tb2_td2{ width:100px; text-align:center;}
    .tb2_td2 img{ width:96px; height:96px; border:2px solid #c9c6c7;}
    .tb2_td3{ width:170px; padding-left:12px; padding-right:18px;}
    .tb2_td3 a{ font-size:14px; line-height:22px;}

    .gwc_tb3{ width:100%; border:1px solid #d2d2d2; background:#e7e7e7; height:46px; margin-top:20px; }
    .gwc_tb3 tr td{font-size:14px;}
    .tb3_td2{ width:100px;text-align:center;}
    .tb3_td2 span{ color:#ff5500;font-size:14px; font-weight:bold; padding-left:5px; padding-right:5px; }
    .tb3_td3{ width:220px;text-align:center;}
    .tb3_td3 span{ font-size:18px; font-weight:bold;}
    .tb3_td4{ width:110px;text-align:center;}
    .jz2{ width:100px; height:46px; line-height:46px; text-align:center; font-size:18px; color:#fff; background:#ee0000; display:block; float:right;}
    #jz1{font-size:18px;}
</style>
<div class="gwc" style=" margin:auto;">
    <table cellpadding="0" cellspacing="0" class="gwc_tb1">
        <tr>
            <td class="tb1_td3">商品</td>
            <td class="tb1_td4">商品信息</td>
            <td class="tb1_td5">数量</td>
            <td class="tb1_td6">单价</td>
            <td class="tb1_td7">操作</td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="gwc_tb2">
        <tr>
            <td class="tb2_td2"></td>
            <td class="tb2_td3"><img  height="100" width="80" src="__IMAGES__/phone7.png" alt=""></td>
            <td class="tb1_td4"><?php echo $info["subject"]; ?> </td>
            <td class="tb1_td5">
                <input id="min1" name=""  style=" width:20px; height:18px;border:1px solid #ccc;" type="button" value="-" />
                <input id="text_box1" name="" type="text" value="1" style=" width:30px; text-align:center; border:1px solid #ccc;" />
                <input id="add1" name="" style=" width:20px; height:18px;border:1px solid #ccc;" type="button" value="+" />
            </td>
            <td class="tb1_td6"><label id="total1" class="tot" style="color:#ff5500;font-size:14px; font-weight:bold;"><?php echo $info["total_fee"]; ?></label></td>
            <td class="tb1_td7"><a href="#">删除</a></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" class="gwc_tb3">
        <tr>
            <td id="subject" style="display:none"><?php echo $info["subject"]; ?></td>
            <td id="out_trade_no"  style="display:none"><?php echo $info["out_trade_no"]; ?></td>
            <td class="tb3_td3">合计(不含运费):<span>￥</span><span id="total_fee"><?php echo $info["total_fee"]; ?></span></td>
            <td class="tb3_td4"><a href="#" style=" display:block;" onclick="payto()"  class="jz2" id="jz2">结算</a></td>
        </tr>
    </table>
</div>
<div id="form" style="display:none"></div>
<script type='text/javascript'>
    function payto(){
        $.ajax({
            type: "post",
            url: "<?php echo url('AliPay/payto'); ?>",
            data: {subject:$("#subject").html(), out_trade_no:$("#out_trade_no").html(),total_fee:$("#total_fee").html()},
            dataType: "json",
            success: function(data){
                $('#form').html(data);
            }
        });
    }
</script>
</body>
</html>