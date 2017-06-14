<!-- Drip -->
<script type="text/javascript">
  var _dcq = _dcq || [];
  var _dcs = _dcs || {}; 
  _dcs.account = '6921316';
  
  (function() {
    var dc = document.createElement('script');
    dc.type = 'text/javascript'; dc.async = true; 
    dc.src = '//tag.getdrip.com/6921316.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(dc, s);
  })();
</script>


<script>
    
    var $ = jQuery;
    $( document ).ready(function() {

        $('#contact-form').on('submit',function(e){
            e.preventDefault();

            var email = $('#email').val();
            var firstName = $('#first-name').val();
            var lastName = $('#last-name').val();
            var purpose = $('#purpose').val();


            _dcq.push(["identify", {
                email: email,
                first_name: firstName,
                last_name: lastName,
                purpose: purpose
            }]);
            $('#contact-form').find('[name="submit"]').attr('disabled','true');

            setTimeout(
            function() 
            {
                $('#email').val("");
                $('#first-name').val("");
                $('#last-name').val("");
                $('#purpose').val("");
              //do something special
              $('#signup-modal').fadeOut();
              $('#contact-form').find('[name="submit"]').removeAttr("disabled");
            }, 1000);
            

        });

    });
</script>
