
<script>

    function requireValues(myClass) /* VALIDATE REQUIRED VALUES */
    {
        let result = 'success';

        $('.'+myClass).each( function()
        {
            if(!$(this).val())
            {
                $(this).addClass('is-invalid');
                result = 'fail';
            }
            else
            {
                $(this).removeClass('is-invalid');
            }
        });

        return result;
    }

    function myValidEmail(email) /* VALIDATE EMAIL */
    {
        let emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

        if(emailRegex.test(email))
            return 'valid';
        else
            return 'invalid';
    }

    function clear()
    {
        $('.clear').each( function()
        {
            $(this).val('');
        });
    }

    
</script>
