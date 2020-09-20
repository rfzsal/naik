<!-- footer -->
<!-- footer section -->
<footer class="grey darken-4" style="padding-bottom: 1px; padding-top: 0px; margin-top: 20px">
    <div class="container grey-text text-darken-2">
        <div class="row">
            <div class="col s12 m6">
                <h5>About</h5>
                <p>Naik Store provide a large collection of sport shoes with high quality material.</p>
            </div>
            <div class="col s12 m6 right-align hide-on-small-only" style="margin-top: 20px">
                <a href="https://www.twitter.com" class="btn-floating grey darken-3 z-depth-0 hover-fade" style="margin-left: 10px"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com" class="btn-floating grey darken-3 z-depth-0 hover-fade" style="margin-left: 10px"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" class="btn-floating grey darken-3 z-depth-0 hover-fade" style="margin-left: 10px"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="col s12 m6 show-on-small hide-on-med-and-up" style="margin-left: -10px">
                <a href="https://www.twitter.com" class="btn-floating grey darken-3 z-depth-0 hover-fade" style="margin-left: 10px"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com" class="btn-floating grey darken-3 z-depth-0 hover-fade" style="margin-left: 10px"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" class="btn-floating grey darken-3 z-depth-0 hover-fade" style="margin-left: 10px"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="col s12">
                <h5>Contact</h5>
                <p><i class="fas fa-map-marker-alt fa-sm"></i> Tangerang - Banten</p>
                <p><i class="fas fa-phone-alt fa-sm"></i> +62 812-3456-7890</p>
                <p><i class="fas fa-envelope fa-sm"></i> info@naik.com</p>
            </div>
        </div>
        <div class="divider grey darken-3"></div>
        <div class="hide-on-small-only">
            <p class="grey-text text-darken-1 center">© 2019 Naik Store</p>
        </div>
        <div class="show-on-small hide-on-med-and-up">
            <p class="grey-text text-darken-1">© 2019 Naik Store</p>
        </div>
    </div>
</footer>
<!-- import jquery js -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- import materialize js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<!-- script -->
<script>
$(document).ready(function(){
$('.sidenav').sidenav();
$('.collapsible').collapsible();
$(".dropdown-trigger").dropdown({coverTrigger: false});
<?php
if(isset($js)){
    echo $js;
}
?>
});
</script>
</body>
</html>