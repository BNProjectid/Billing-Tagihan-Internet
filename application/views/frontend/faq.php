<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v6.0&appId=263438601165351&autoLogAppEvents=1">
</script>
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6">
            <div class="card" style="min-height:500px">
                <div class="card-body">
                    <h4 class="card-title">Kritik & Saran, tanya tanya juga boleh :)</h4>
                    <div class="row justify-content-center">
                        <?php
                        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        // echo $actual_link;
                        ?>
                        <script src="https://apis.google.com/js/platform.js"></script>
                        <div class="fb-comments" data-href="<?= $actual_link ?>" data-width="100%" data-numposts="5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>