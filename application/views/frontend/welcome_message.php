<div class="container">
	<div class="section-services">
		<div class="row mt-4">
			<div class="col-lg-8 mb-2">
				<div class="card border-danger">
					<div class="card-body">
						<h5 class="card-title">Cek Iuran <?= $company['company_name'] ?></h5>
						<div class="row">
							<div class="col">
								<input class="form-control mb-2 mr-sm-2" id="no_services" name="no_services" type="text" placeholder="No Layanan" required>
							</div>
							<div class="col">

								<select name="month" id="month" class="form-control mb-2 mr-sm-2" required>
									<option value="">-Bulan-</option>
									<option value="01">Januari</option>
									<option value="02">Februari</option>
									<option value="03">Maret</option>
									<option value="04">April</option>
									<option value="05">Mei</option>
									<option value="06">Juni</option>
									<option value="07">Juli</option>
									<option value="08">Agustus</option>
									<option value="09">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
							<div class="col">
								<select class="form-control select2" style="width: 100%;" id="year" name="year" required>
									<option value="">-Tahun-</option>
									<?php
									for ($i = date('Y'); $i >= date('Y') - 1; $i -= 1) {
									?>
										<option value="<?= $i ?>"><?= $i ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<button class="btn btn-success mb-2 my-2 my-sm-0" type="submit" onclick="cek_bill()">Cek</button>
					</div>
					<div class="loading"></div>
					<div class="view_data"></div>
				</div>
			</div>

			<div class="col-lg-4 mb-2">
				<div class="card border-danger">
					<div class="card-body">
						<h4 class="card-title text-center">Info Lainnya</h4>
						<div class="row text-center">
							<div class="col-lg-3 col-sm-3 col-3 ">
								<a href="https://www.instagram.com/<?= $company['instagram']; ?>" target="blank">
									<img src="<?= base_url('assets/images/medsos/instagram.png') ?>" alt="" style="width: 50px">
								</a>
							</div>
							<div class="col-lg-3 col-3 ">
								<a href="https://www.facebook.com/<?= $company['facebook']; ?>" target="blank">
									<img src="<?= base_url('assets/images/medsos/facebook.png') ?>" alt="" style="width: 50px">
								</a>
							</div>
							<div class="col-lg-3 col-sm-3 col-3 ">
								<a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($company['whatsapp']); ?>" target="blank">
									<img src="<?= base_url('assets/images/medsos/whatsapp.jpg') ?>" alt="" style="width: 50px">
								</a>
							</div>
							<div class="col-lg-3 col-3 ">
								<a href="mailto:<?= $company['email']; ?>?" target="blank">
									<img src="<?= base_url('assets/images/medsos/email.png') ?>" alt="" style="width: 50px">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container mt-2">
	<div class="card" style="min-height:280px">
		<div class="card-header">
			Tentang <?= $company['company_name'] ?>
		</div>
		<div class="card-body">
			<p class="card-text"><?= $company['description'] ?></p>
		</div>
	</div>
</div>



<script>
	function cek_bill() {
		var no = $('#no_services').val()
		var m = $('#month').val()
		var y = $('#year').val()
		no_services = $('[name="no_services"]');
		month = $('[name="month"]');
		year = $('[name="year"]');
		if (no == '') {
			$('#no_services').focus()
		} else {
			if (m == '') {
				$('#month').focus()
			} else {
				if (y == '') {
					$('#year').focus()
				} else {
					$.ajax({
						type: 'POST',
						data: "cek_bill=" + 1 + "&no_services=" + no_services.val() + "&month=" + month.val() + "&year=" + year.val(),
						url: '<?= site_url('front/view_bill') ?>',
						cache: false,

						beforeSend: function() {
							no_services.attr('disabled', true);
							$('.loading').html(` <div class="container">
        <div class="text-center">
            <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>`);
						},
						success: function(data) {
							no_services.attr('disabled', false);
							$('.loading').html('');
							$('.view_data').html(data);
						}
					});
				}
			}
		}
		return false;
	}
</script>