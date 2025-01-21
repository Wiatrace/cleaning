function addListener() {
    jQuery("#application-dop_usluga_check").click(function(){
      if (this.checked) {
          jQuery("#application-vid_uslugi").prop('disabled', true);
          jQuery("#application-vid_uslugi").val(6);
          jQuery("#custom-service-container").removeClass("d-none");
      } else{
          jQuery("#application-vid_uslugi").prop('disabled', false);
          jQuery("#application-vid_uslugi").val(1);
          jQuery("#custom-service-container").addClass("d-none");
          jQuery("#application-other_usluga_description").val("");
      }
    });    
}
addListener();
