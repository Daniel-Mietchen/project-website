<link rel="stylesheet" href="./css/error-modal.css">
<script type="text/javascript" src="./js/search_string.js"></script>
<script type="text/javascript" src="./js/error_heuristics.js"></script>
<script type="text/javascript" src="./js/error_heuristics.js"></script>

<!-- The Modal -->
<div id="error_modal" class="modal">
   <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-body">
      <p>Sorry! We could not create a map for <span class="error-modal-q"></span>.</p>
    </div>
    <div class="error-message-body">
      <p>Default error text</p>
    </div>
    <div id="service-outlink" class="error-message-body">
    </div>
    <span id="error_modal_close" class="close">Try again</span>
    <div>
    <p>If you think that there is something wrong with our site, please let us know at <br><a href=\"mailto:info@openknowledgemaps.org\">info@openknowledgemaps.org</a></p>
    </div>
  </div>
</div>

<script type="text/javascript">
  var post_data = JSON.parse(sessionStorage.getItem("post_data"));
  var status = sessionStorage.getItem("status");
  var service = sessionStorage.getItem("service");
  // Get the modal
  var modal = document.getElementById("error_modal");

  // Get the button that opens the modal
  var modal_btn = document.getElementById("error_info_button");

  // Get the <span> element that closes the modal
  var span = document.getElementById("error_modal_close");

  var queryString = "";
  if(post_data) {
    queryString = post_data.q;
  }

  let search_string = "";
  try {
      search_string = getServiceSearchString(post_data, service);
  } catch(e) {
      console.log("An error ocurred when creating the search string");
  }

  const error_type = getTooFewPapersHeuristic( post_data );

  $(function() {
    var modal = $('#error_modal');
    modal.find('.error-modal-q').text(queryString);
    modal_btn.style.visibility="hidden";
    if ( error_type === "toospecific") {
      modal.find('.error-message-body p').text('Your search was too specific');
      modal_btn.style.visibility="visible";
    } else if ( error_type === "toomanytokens") {
      modal.find('.error-message-body p').text('Your search might be too long');
      modal_btn.style.visibility="visible";
    } else if ( error_type == "shorttimedelta") {
      modal.find('.error-message-body p').text('The timeframe is too small choose longer than 60 days');
      modal_btn.style.visibility="visible";
    } else {
      modal.find('.error-message-body p').text('Error type 4 detected.');
      modal_btn.style.visibility="visible";
    $("#service-outlink").html("Sorry! We could not create a map for your search term. Most likely there were not enough results."
            + ((search_string !== "")
                ?("<br> You can <a href=\"" + search_string + "\" target=\"_blank\">check out your search on " + ((service === "base") ? ("BASE") : ("PubMed")) + "</a> or <a href=\"index.php\">go back and try again.</a>")
                :("<br> Please <a href=\"index.php\">go back and try again.</a>")));
    }
  });
  // When the user clicks on the button, open the modal
  modal_btn.onclick = function() {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
