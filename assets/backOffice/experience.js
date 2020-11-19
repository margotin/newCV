jQuery(function() { 
    handleDeleteButtons();

    let counter = $('#experience_works div.form-group').length || 0;
    $('#add-work').on("click",function(){            
        const template = $('#experience_works').data('prototype').replace(/__name__/g, counter);
        $('#experience_works').append(template);
        handleDeleteButtons();
        counter++;            
    })

    function handleDeleteButtons(){
        $('button[data-action="delete"]').on("click",function(){
            const target = this.dataset.target;
            $(target).remove();
        })
    }
})