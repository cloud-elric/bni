var loading = "<h3 class='text-center'>Cargando....</h3>";

$(document).ready(function(){
    $(document).on({
        'click' : function(e) {
            $('#modal-lead .modal-body').html(loading);
            $('#modal-lead').modal('show');
            
            e.preventDefault();
            var token = $(this).data("token");
            $.ajax({
                url:"site/ver-leads?token="+token,
                success:function(resp){
                    $('#modal-lead .modal-body').html(resp);
                    
                }
                
            })
        }
    }, '#pjax-leads-enviados .table tbody tr');


    $(document).on({
        'click' : function(e) {
            $('#modal-lead .modal-body').html(loading);
            $('#modal-lead').modal('show');
            
            e.preventDefault();
            var token = $(this).data("token");
            $.ajax({
                url:"site/ver-leads?token="+token,
                success:function(resp){
                    $('#modal-lead .modal-body').html(resp);
                    
                }
                
            })
        }
    }, '#pjax-leads-recibidos .table tbody tr');

    
});