/**
 * Created by natacha on 05/08/2017.
 */


    $(document).ready(function() {
        $('.delete').hide();
        $countBillet = function() {
            $nbbillet = $('.delete').length;
            if ($nbbillet == 1) {
                $('.delete').last().hide();
            } else {
                $('.delete').last().show();
            }
        }

        $countBillet();

        $('.delete').click(function(e){
            var $deleteLink = $(this).attr('id');
            $('#bill-'+$deleteLink).remove();
            $countBillet();
            e.preventDefault();
            return false;

        });
    });
