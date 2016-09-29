jQuery(document).ready(function() {
    /**
     * Script for image selected from radio option
     */
     jQuery('#page-layout .aop-radio-image-wrapper .aop-description img').click(function(){
        jQuery('#page-layout .aop-radio-image-wrapper').each(function(){
           jQuery(this).find('img').removeClass ('aop-radio-image-selected') ;
        });
       jQuery(this).addClass ('aop-radio-image-selected') ;
    });
});

jQuery(document).ready( function() {
   jQuery('#page_template').change(function() {
      jQuery('#page-layout').toggle(jQuery(this).val() != 'page-templates/template-awesome-one-page.php');
      jQuery('#services-icon').toggle(jQuery(this).val() === 'page-templates/template-services.php');
      jQuery('#team-designation').toggle(jQuery(this).val() === 'page-templates/template-team.php');
      jQuery('#team-social').toggle(jQuery(this).val() === 'page-templates/template-team.php');
      jQuery('#testimonial-designation').toggle(jQuery(this).val() === 'page-templates/template-testimonial.php');
   }).change();
});