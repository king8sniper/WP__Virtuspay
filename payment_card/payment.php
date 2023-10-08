<?php

    include_once('../../../../wp-load.php');
    require_once('../../../../wp-config.php');
    require_once('../vendor/autoload.php');

    global $wpdb;

	$base_url = get_home_url()."/";
    $current_user = wp_get_current_user();
    $loginName = "Kagayaki01";
    $pass = "j4W5P2Z3r76VXYmE";
    $charge_type = 6;
    $site_id = 1763;

    if(isset($_REQUEST['virtuspay'])) {
        $pay_link = $_REQUEST['virtuspay'];
        $table = $wpdb->prefix.'pay_link';
        $results = $wpdb->get_results("SELECT * FROM ".$table." where link_url = '".$pay_link."'");
        foreach($results as $result) {
            $product_id         =   $result->id;
            $product_name       =   $result->product_name;
            $price              =   $result->price;
            $currency           =   $result->currency;
            $address            =   $result->address;
            $phone_number       =   $result->phone_number;
            $email              =   $result->email;
            $virtuspay_link     =   $result->virtuspay_link;
        }

        // echo $product_name."-----------".$price."-----------".$currency."-----------".$address."-----------".$phone_number."-----------".$email."-----------".$virtuspay_link;
    }
	// echo $product_name."-----------".$price."-----------".$currency."-----------".$address."-----------".$phone_number."-----------".$email."-----------".$virtuspay_link;
    $currency_unit = ($currency == "USD") ? "$" : "￥";
   // $amount = [];
    $amount =  $price;
    // $amount[1] = 3000;
    $token = md5(sprintf('%s-.-%s-.-%s', $loginName, md5($pass),  $amount)); 
    // echo "------------".$token;

    if(isset($_POST['card_info']) && $_POST['card_info'] == "save") {

        $name       = $_POST["name"];
        $names      = [];
        $names      = explode(" ", $name);
        $first_name = $name[0];
        $last_name  = $name[1];

        $cardnumber         =   $_POST["cardnumber"];
        $expirationdate     =   $_POST["expirationdate"];
        $expirationdates    =   [];
        $expirationdates    =   explode("/", $expirationdate);
        $cardmonth          =   $expirationdates[0];
        $cardyear           =   "20".$expirationdates[1];
        $cvv                =   $_POST["cvv"];

        
        $target_url = 'https://api2.paymentapi.co:8081/payment2.php';
        $post  = array(
            "loginname"             =>          $loginName,
            "charge_type"           =>          $charge_type,
            "site_id"               =>          $site_id,
            "token"                 =>          $token,
            "firstname"             =>          $first_name,
            "lastname"              =>          $last_name,
            "cardnumber"            =>          str_replace(" ", "", $cardnumber),
            "cardmonth"             =>          $cardmonth,
            "cardyear"              =>          $cardyear,
            "cvv"                   =>          $cvv,
            "currency"              =>          $currency,
            "customer_id"           =>          $product_id,
            "contents_id"           =>          $product_id,
            "contents_name"         =>          $product_name,
            "amount"                =>          $price,
        );

        // var_dump($post);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$target_url);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_VERBOSE,true);
        $result=curl_exec ($ch);
        curl_close ($ch);

        // var_dump(json_decode($result));
	    // var_dump(json_decode($result)->result->status);
        // var_dump($result->result->status);
	    //$status = json_decode($result)->result->status;

        echo $result;
	exit;
    }


?>

<!DOCTYPE html>
<html lang="en" >
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Virtus">
    <title>Virtuspay - Credit Card Payment Form</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Rock+Salt|Source+Code+Pro:300,400,600" rel="stylesheet"><link rel="stylesheet" href="./style.css">
    <style>

        .d-flex {
            display: flex;
            justify-content: end;
        }
        .btn {
            width: 140px;
            color: white;
            background-color: #40608f;
            border-color: #8893a3;
            border-radius: 4px;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            font-size: 1.25rem;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            margin: 0 10px;
            padding: 7px 0;
        }
        .btn:hover {
            background-color: #0b5ed7;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.5); /* Black w/ opacity */
            box-shadow: 0 4px 10px 0 rgb(0 0 0 / 20%), 0 4px 20px 0 rgb(0 0 0 / 19%);
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 25px;
            width: 45%;
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        h1, h2, h3 {
            margin: 0.75rem;
        }

        .form-container {
            grid-template-rows: 75px 75px 75px;
            padding: 10px;
        }

        input {
            padding: 10px;
        }
        @media only screen and (max-width: 550px) {
            .modal-content {
                width: 80%;
            }

            .d-flex {
                display: flex;
                justify-content: center;
            }
        }

    </style>

</head>
<body>

    <!-- partial:index.partial.html -->
    <div class="payment-title">
        <h1>支払情報</h1>
    </div>
    <div class="payment-title">
        <h4 style="margin-top:0px;"><?php echo $product_name . " : " . $price . $currency_unit; ?></h4>
        <h4 style="margin-top: -10px; margin-bottom: -7px;"><?php echo $email; ?></h4>
    </div>
    <div class="container preload">
        <div class="creditcard">
            <div class="front">
                <div id="ccsingle"></div>
                <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                    <g id="Front">
                        <g id="CardBackground">
                            <g id="Page-1_1_">
                                <g id="amex_1_">
                                    <path id="Rectangle-1_1_" class="lightcolor grey" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40 C0,17.9,17.9,0,40,0z" />
                                </g>
                            </g>
                            <path class="darkcolor greydark" d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z" />
                        </g>
                        <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber" class="st2 st3 st4">0123 4567 8910 1112</text>
                        <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="st2 st5 st6">顧客名</text>
                        <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">クレジットカード名義人氏名</text>
                        <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">有効期限</text>
                        <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">カード番号</text>
                        <g>
                            <text transform="matrix(1 0 0 1 479.3848 433.8095)" id="svgexpire" class="st2 st5 st9">01/23</text>
                            <text transform="matrix(1 0 0 1 614.4219 417.0097)" class="st2 st10 st11">まで</text>
                            <text transform="matrix(1 0 0 1 614.4219 435.6762)" class="st2 st10 st11">有効</text>
                            <!-- <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire" class="st2 st5 st9">01/23</text>
                            <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">有効</text>
                            <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">THRU</text>
                            <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9 		" /> -->
                        </g>
                        <g id="cchip">
                            <g>
                                <path class="st2" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3 c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z" />
                            </g>
                            <g>
                                <g>
                                    <rect x="82" y="70" class="st12" width="1.5" height="60" />
                                </g>
                                <g>
                                    <rect x="167.4" y="70" class="st12" width="1.5" height="60" />
                                </g>
                                <g>
                                    <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3 c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3 C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5 c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5 c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z" />
                                </g>
                                <g>
                                    <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5" />
                                </g>
                                <g>
                                    <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5" />
                                </g>
                                <g>
                                    <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5" />
                                </g>
                                <g>
                                    <rect x="142" y="117.9" class="st12" width="26.2" height="1.5" />
                                </g>
                            </g>
                        </g>
                    </g>
                    <g id="Back"></g>
                </svg>
            </div>
            <div class="back">
                <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                    <g id="Front">
                        <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11" />
                    </g>
                    <g id="Back">
                        <g id="Page-1_2_">
                            <g id="amex_2_">
                                <path id="Rectangle-1_2_" class="darkcolor greydark" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40 C0,17.9,17.9,0,40,0z" />
                            </g>
                        </g>
                        <rect y="61.6" class="st2" width="750" height="78" />
                        <g>
                            <path class="st3" d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5 C707.1,246.4,704.4,249.1,701.1,249.1z" />
                            <rect x="42.9" y="198.6" class="st4" width="664.1" height="10.5" />
                            <rect x="42.9" y="224.5" class="st4" width="664.1" height="10.5" />
                            <path class="st5" d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z" />
                        </g>
                        <text transform="matrix(1 0 0 1 621.999 227.2734)" id="svgsecurity" class="st6 st7">888</text>
                        <g class="st8">
                            <text transform="matrix(1 0 0 1 518.083 280.0879)" class="st9 st6 st10">セキュリティコード</text>
                        </g>
                        <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5" />
                        <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5" />
                        <text transform="matrix(1 0 0 1 59.5073 228.6099)" id="svgnameback" class="st12 st13">顧客名</text>
                    </g>
                </svg>
            </div>
        </div>
    </div>
    <div class="form-container">
        <div class="field-container">
            <label for="name">名前</label>
            <input id="name" maxlength="20" type="text" placeholder="John Doe">
        </div>
        <div class="field-container">
            <label for="cardnumber">カード番号</label><span id="generatecard" style="opacity:0;"></span>
            <input id="cardnumber" type="text" pattern="[0-9]*" inputmode="numeric" placeholder="0123 4567 8910 1112">
            <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"></svg>
        </div>
        <div class="field-container">
            <label for="expirationdate">有効期限 (mm/yy)</label>
            <input id="expirationdate" type="text" pattern="[0-9]*" inputmode="numeric"  placeholder="01/23">
        </div>
        <div class="field-container">
            <label for="securitycode">セキュリティコード</label>
            <input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric">
        </div>
    </div>
    <!-- partial -->
    <div class="payment-title">
        <button id="myBtn" class="btn btn-primary" type="button">決済を進める</button>
    </div>


    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="payment-title">
                <h1 style="border-bottom: 2px solid darkgrey;">支払情報</h1>
            </div>
            <div class="payment-title">
                <h2><?php echo "商品名 : " . $product_name; ?></h2>
                <h2><?php echo "金額 : " . $price . $currency_unit; ?></h2>
                <h2><?php echo "E_mail : " . $email; ?></h2>
            </div>
            <div class="payment-title" style="padding: 20px 0;">
                <div class="d-flex">
                    <button class="btn btn-primary" type="button" onclick="virtus_pay()"> 確定 </button>
                    <button class="btn btn-primary close1" type="button">戻る</button>
                <div>
            </div>
        </div>

    </div>
</body>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script>
    <script  src="./script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    
    function virtus_pay() {

        var card_owner_name         =    $('#name').val();
        var card_cardnumber         =    $('#cardnumber').val();
        var card_expirationdate     =    $('#expirationdate').val();
        var card_cvv                =    $('#securitycode').val();

        // if(card_owner_name != '' && card_cardnumber != '' && card_expirationdate != '' && card_cvv != '') {
            console.log("pay");
            jQuery.ajax({
                url: "<?php echo plugin_dir_url( __FILE__) ?>payment.php",
                type: "post",
                data: {
                    card_info:          "save",
                    name:               $('#name').val(),
                    cardnumber:         $('#cardnumber').val(),     // 3566000020000410,
                    expirationdate:     $('#expirationdate').val(),
                    cvv:                $('#securitycode').val(),   // 123,
                    virtuspay :         "<?=$_REQUEST['virtuspay']?>"

                },
                success: function (res) {
                    console.log("--------" + JSON.parse(res).result.status + "--------");
                    var status = JSON.parse(res).result.status;
                    if (status == "Failure") {
                        var reason = JSON.parse(res).result.reason;
                        alert(reason);
                        // location.href = "<?php // echo $base_url; ?>wp-content/plugins/payment-link-list/payment_card/success.php";
                    } else {
                        location.href = "<?php echo $base_url; ?>wp-content/plugins/payment-link-list/payment_card/success.php";
                    }
                    
                },
                error: function (res, textStatus, errorThrown) {
                    console.log(res);
                }
            });

        // } else {
        //     alert('カード情報を正確に入力してください。');
        // }
        $('#myModal').css('display', 'none');
    }

    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span1 = document.getElementsByClassName("close")[0];
    var span2 = document.getElementsByClassName("close1")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span1.onclick = function() {
        modal.style.display = "none";
    }

    span2.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>


</html>
