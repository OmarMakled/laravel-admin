window.addEventListener('DOMContentLoaded', function() {
    (function(window,$){
        let options = %2$s;
        options["fnDrawCallback"] = function( oSettings ) {
            $('.confirm-delete').on('click', function(e){
                e.preventDefault();
                App.confirm($(this).data('url'));
            })
        } 
        window.LaravelDataTables=window.LaravelDataTables||{};
        window.LaravelDataTables["%1$s"]=$("#%1$s").DataTable(options); 
    })(window,jQuery);
});
