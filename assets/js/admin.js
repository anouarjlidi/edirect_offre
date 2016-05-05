/**
 * Created by edirect on 16/11/2015.
 */

function getliste2(page, sort_what, sort_order)
{
    sort_what = sort_what || window.subs_sort_what || 'created';
    sort_order = sort_order || window.subs_sort_order || 'DESC';
    window.subs_sort_what = sort_what;
    window.subs_sort_order = sort_order;
    jQuery('.subs_list_offre .loader').show();
    jQuery('.subs_list_offre').removeClass('no-subs');
    jQuery.ajax( {
        url: ED_A.ajaxurl,
        type: "POST",
        data: 'action=edoffre_liste_demandeurs&page='+page+'&sort_what='+sort_what+'&sort_order='+sort_order,
        dataType: "json"
    } ).done(function(response) {
            jQuery('.subs_list_offre .sortable').removeClass('ASC DESC');
            jQuery('.subs_list_offre [data-sort="'+sort_what+'"]').removeClass('ASC DESC').addClass(sort_order);
            jQuery('.subs_list_offre .tbody').html('');
            jQuery('.subs_list_offre .loader').hide();
            if (response.total)
            {
               spinTo('#total-results',response.total);
            }
            for (line in response.submissions_offres)
            {

                var new_line = '';
                var new_line = new_line + "<div class='tr'>";
                var new_line = new_line + "<span style='width:5%'><a class='load-submission' data-id='"+response.submissions_offres[line].id+"'>"+response.submissions_offres[line].id+"</a></span>";
                var new_line = new_line + "<span style='width:20%'><a class='load-submission' data-id='"+response.submissions_offres[line].nom+"'>"+response.submissions_offres[line].nom+"</a></span>";
                var new_line = new_line + "<span style='width:10%'><a class='load-submission' data-id='"+response.submissions_offres[line].nom_entreprise+"'>"+response.submissions_offres[line].nom_entreprise+"</a></span>";
                var new_line = new_line + "<span style='width:10%'><a class='load-submission' data-id='"+response.submissions_offres[line].tel+"'>"+response.submissions_offres[line].tel+"</a></span>";
                var new_line = new_line + "<span style='width:10%'><a class='load-submission' data-id='"+response.submissions_offres[line].mobile+"'>"+response.submissions_offres[line].mobile+"</a></span>";
                var new_line = new_line + "<span style='width:15%'><a class='load-submission' data-id='"+response.submissions_offres[line].email+"'>"+response.submissions_offres[line].email+"</a></span>";
                var new_line = new_line + "<span style='width:10%'><a class='load-submission' data-id='"+response.submissions_offres[line].offre+"'>"+response.submissions_offres[line].offre+"</a></span>";
                var new_line = new_line + "<span style='width:10%'><a class='load-submission' data-id='"+response.submissions_offres[line].message+"'>"+response.submissions_offres[line].message+"</a></span>";
                var new_line = new_line + "<span style='width:10%'><a class='load-submission' data-id='"+response.submissions_offres[line].created+"'>"+response.submissions_offres[line].created+"</a></span>";
                var new_line = new_line + "</div>";
                jQuery('.subs_list_offre .tbody').append(new_line);
            }
            var i = 1;
            jQuery('.subs_list_offre .pagination > div').html('');
            while (i <= response.pages) {
                var add_class = i==page ? 'active' : '';
                jQuery('.subs_list_offre .pagination > div').append('<span class="'+add_class+'">'+i+'</span>');
                i++;
            }
            if(response.pages==0)
            {
                jQuery('.subs_list_offre').addClass('no-subs');
            }
        })
        .fail(function(response) {
            jQuery(this).find('.response').text('Connection error');
        })
        .always(function(response) {
        });
}

function spinTo(selector, to)
{
    var from = jQuery(selector).text()=='' ? 0 : parseFloat(jQuery(selector).text());
    var to = isNaN(parseFloat(to)) ? 0 : parseFloat(to);
    duration = (to-from) < 100 ? 200 : 700;
    jQuery({someValue: from}).animate({someValue: parseFloat(to)}, {
        duration: duration,
        easing:'swing',
        context: to,
        step: function() {
            if (parseInt(to)!=parseFloat(to))
            {
                val = (Math.ceil(this.someValue*10))/10;
            }
            else
            {
                val = Math.ceil(this.someValue);
            }
            jQuery(selector).text(val);
        }
    });
    setTimeout(function(){
        jQuery(selector).text(parseFloat(to));
    }, duration+100);
}
getliste2(1,'email','ASC');