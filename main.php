<?php

	global $wpdb;

	$base_url = get_home_url()."/";

	$payment_data = $wpdb->get_results("SELECT * FROM wp_pay_link");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Google Fonts -->
  	<link href="https://fonts.gstatic.com" rel="preconnect">
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  	
	<!-- Vendor CSS Files -->
	<link href="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/quill/quill.snow.css" rel="stylesheet">
	<link href="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
	<link href="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/simple-datatables/style.css" rel="stylesheet">

	<!--  Main CSS File -->
	<link href="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/css/style.css" rel="stylesheet">
	<link href="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/css/custom.css" rel="stylesheet">
    
</head>
<body>
	<div class="main-container">
		<main id="main" class="main">
			<div class="pagetitle p-vertical-10">
				<div></div>
				<h1>Virtus Payment</h1>
			</div>
			<section class="section">
				<div class="row">
					<div class="col-lg-12">
						<div class="card" style="padding: 0.7em 0.5em 1em;">
				            <div class="card-body">
				            	<div class="col-xl-2">
				            		<div class="Box-root Box-rooto Padding-vertical--16">
                                        <span id="db-ChromeMainContent-nav-title" class="Text-color--dark Text-fontSize--16 Text-fontWeight--bold Text-lineHeight--24 Text-numericSpacing--proportional Text-typeface--base Text-wrap--wrap Text-display--inline">
                                            <span><h6>Payments</h6></span>
                                        </span>
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">All Payment</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Payment Link list</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#main-setting" type="button" role="tab" aria-controls="contact" aria-selected="false">Setting</button>
                                        </li>
                                    </ul>
				            	</div>
				            	<div class="col-lg-10 col-xl-10 col-sm-10">
				            		<div class="tab-content pt-2" id="borderedTabContent">
						                <div class="tab-pane fade show active" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="cardin-header">
						                		<div class="row">
						                			<div class="col-lg-6 col-sm-6"><h2>All Payment List</h2></div>
						                			<div class="col-lg-6 col-sm-6"></div>
						                		</div>
						                	</div>
						                    <table class="table table-striped border-l-2" style="text-align: center; vertical-align: middle;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="txt-cn" style="width: 13%">金額</th>
                                                        <th scope="col" class="txt-cn" style="width: 12%">スターテス</th>
                                                        <th scope="col" class="txt-cn" style="width: 50%">商品名</th>
                                                        <th scope="col" class="txt-cn" style="width: 25%">メール</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>￥123</td>
                                                        <td><span class="badge bg-success">Succeeded &nbsp;<i class="bi bi-check-lg"></i></span></td>
                                                        <td>ポケットモンスター ALL STAR COLLECTION11 カビゴン M ぬいぐるみ	</td>
                                                        <td>moonrider.crowdworks02@gmail.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td>￥123</td>
                                                        <td><span class="badge bg-danger">Failed &nbsp;<i class="bi bi-x-lg"></i></span></td>
                                                        <td>ポケットモンスター ALL STAR COLLECTION11 カビゴン M ぬいぐるみ	</td>
                                                        <td>123</td>
                                                    </tr>
                                                </tbody>
                                            </table>
						                </div>
						                <div class="tab-pane fade" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
						                	<div class="cardin-header">
						                		<div class="row">
						                			<div class="col-lg-6 col-sm-6"><h2>Payment Links</h2></div>
						                			<div class="col-lg-6 col-sm-6">
						                				<button type="button" id="create_link" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_modal" onclick="create_link()" style="float: right; font-size: .8rem;"><i class="bi bi-plus me-1"></i> リンクを作成する</button>
						                			</div>
						                		</div>
						                	</div>
						                    <table class="table table-striped border-l-2" style="text-align: center; vertical-align: middle;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="txt-cn">Link URL</th>
                                                        <th scope="col" class="txt-cn">金額</th>
                                                        <th scope="col" class="txt-cn">商品名</th>
                                                        <th scope="col" class="txt-cn">住所</th>
                                                        <th scope="col" class="txt-cn">電話番号</th>
                                                        <th scope="col" class="txt-cn">メール</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                        foreach($payment_data as $data){
                                                            if($data->currency == "USD") $currency = "$";
                                                            else $currency = "￥";
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <input class="url-input" id="previewUrl<?php echo $data->id; ?>" aria-invalid="false" readonly="" placeholder="" type="text" value="<?php echo $data->virtuspay_link ?>">
                                                                <button type="button" class="btn btn-outline-secondary btn-sm ml-12" onclick="copyUrl(event, '<?php echo $data->id; ?>')"><i class="bi bi-clipboard-fill"></i></button>
                                                            </td>
                                                            <td class="txt-cn"><?php echo $data->price.$currency ?></td>
                                                            <td class="txt-cn"><?php echo $data->product_name ?></td>
                                                            <td class="txt-cn"><?php echo $data->address ?></td>
                                                            <td class="txt-cn"><?php echo $data->phone_number ?></td>
                                                            <td class="txt-cn"><?php echo $data->email ?></td>
                                                        </tr>
                                                    <?php
                                                        }
                                                    ?>

                                                </tbody>
                                            </table>
						                </div>
						                <div class="tab-pane fade" id="main-setting" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="cardin-header">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6"><h2>Setting</h2></div>
                                                    <div class="col-lg-6 col-sm-6"></div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-lg-1 col-sm-1"></div>
                                                <div class="col-lg-8 col-sm-8">

                                                    <!-- Horizontal Form -->
                                                    <form>
                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                                                            <div class="col-sm-8">
                                                                <input type="email" class="form-control" id="inputEmail" name="set_email">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Password</label>
                                                            <div class="col-sm-8">
                                                                <input type="password" class="form-control" id="inputPassword">
                                                            </div>
                                                        </div>
                                                        <fieldset class="row mb-3">
                                                            <legend class="col-form-label col-sm-4 pt-0">Payment Mode</legend>
                                                            <div class="col-sm-8">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="set_mode" id="gridRadios1" value="option1" checked>
                                                                    <label class="form-check-label" for="gridRadios1">
                                                                        Test Mode
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="set_mode" id="gridRadios2" value="option2">
                                                                    <label class="form-check-label" for="gridRadios2">
                                                                        Live Mode
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                                        </div>
                                                    </form>
                                                    <!-- End Horizontal Form -->

                                                </div>
                                                <div class="col-lg-2 col-sm-2"></div>
                                            </div>
						                </div>
				            		</div>
				            	</div>
			            	</div>
			        	</div>
					</div>
				</div>
			</section>
		</main>
	</div>

    <div class="modal fade" id="form_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modalin">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Payment Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">

                            <!-- Custom Styled Validation with Tooltips -->
                            <form class="row g-3 needs-validation" novalidate id="fff" method="post" action="<?php echo plugin_dir_url( __FILE__) ?>ajax-data.php">
                                <div class="col-md-8 position-relative">
                                    <label for="validationTooltipUsername" class="form-label">金額</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <select class="form-select" id="currency" name="currency" required>
                                                <option selected value="JPY">￥(JPY)</option>
                                                <option value="USD">$(USD)</option>
                                            </select>
                                        </span>
                                        <input type="text" class="form-control" id="price" name="price" aria-describedby="validationTooltipUsernamePrepend" required>
                                        <span class="input-group-text">.00</span>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                        <div class="invalid-tooltip">
                                            Please choose valid Price.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 position-relative">
                                    <label for="validationTooltip02" class="form-label">商品名</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Coat" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please provide a valid city.
                                    </div>
                                </div>

                                <div class="col-md-6 position-relative">
                                    <label for="validationTooltip03" class="form-label">住所</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please provide a valid Product Name.
                                    </div>
                                </div>

                                <div class="col-md-8 position-relative">
                                    <label for="validationTooltipUsername" class="form-label">メール</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        <div class="invalid-tooltip">
                                        Please choose a unique and valid Eamil.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 position-relative">
                                    <label for="validationTooltip05" class="form-label">電話番号</label>
                                    <input type="text" pattern="[0-9]*" class="form-control" id="phone_number" name="phone_number" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please provide a valid Phone Number.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input type="hidden" name="vrtlink" value="save_payment_link">
                                    <input type="hidden" id="vrtlink" name="link_url">
                                    <button type="button" class="btn btn-primary" onclick="save_vrt_link()">Create</button>
                                    <!-- <button class="btn btn-primary" type="submit">Create</button> -->
                                </div>
                            </form>
                            <!-- End Custom Styled Validation with Tooltips -->

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

        <!-- Vendor JS Files -->
    <script src="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/quill/quill.min.js"></script>
    <script src="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
    <script src="<?php echo $base_url; ?>/wp-content/plugins/payment-link-list/assets/js/main.js"></script>


<script type="text/javascript">

    const copyUrl = (e, id) => {
        let url = document.getElementById('previewUrl' + id).value;
        // console.log(url);
        
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url);
            // console.log(e.target.tagName);
            if(e.target.tagName == 'I') {
                e.target.className = 'bi bi-clipboard2-check-fill';
            } else {
                e.target.innerHTML = '<i class="bi bi-clipboard2-check-fill"></i>'
            }
        }
    };

	function create_link() {
		var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			var charactersLength = characters.length;
			var link = "";
			var temp_no = "";
			for (var i = 0; i < 30; i++) {
                temp_no += characters.charAt(
                    Math.floor(
                        Math.random() * charactersLength
                    )
                );
			}
            
		link = temp_no;
		$("#vrtlink").val(link);
	}

	function save_vrt_link(link) {
		jQuery.ajax({
			url: "<?php echo plugin_dir_url( __FILE__) ?>ajax-data.php",
			type: "post",
			data: {
				vrtlink: 				'save_payment_link',
				product_name: 			$('#product_name').val(),
				price: 					$('#price').val(),
				currency: 				$('#currency').val(),
				address: 				$('#address').val(),
				phone_number: 			$('#phone_number').val(),
				email: 					$('#email').val(),
				link_url: 				$('#vrtlink').val(),
				vrt_link:				"<?php echo $base_url; ?>wp-content/plugins/payment-link-list/payment_card/payment.php?virtuspay="+$('#vrtlink').val(),
			},
			success: function (data) {
				console.log(data);
				location.href = "<?php echo $base_url; ?>wp-admin/admin.php?page=payment-link-list";
			},
			error: function (data, textStatus, errorThrown) {
                console.log(data);
			},
		});
	}


</script>

</html>
