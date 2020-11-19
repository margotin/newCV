jQuery(function() { 
    $('.js-datepicker').datepicker({
        format: 'MM yyyy',
        language: 'fr',
        startView : 'months',
        minViewMode : 'months',
        autoclose: true,
        todayHighlight:true,
        todayBtn:true
    });
})