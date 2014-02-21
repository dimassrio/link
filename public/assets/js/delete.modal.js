$(function(){
    $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
    })
    .removeAttr('href')
    .attr('onclick','$(this).find("form").submit()');

    $('[data-method-modal]').click(function(){
    	var id = $(this).attr('data-method-modal');
    	$($(this).attr('data-target')+' .modal-footer').html(function(){
    		return "<button type='button' class='btn btn-default' data-exit='test' data-dismiss='modal'>Close</button>"+
            "<a href="+id+" class='btn btn-danger' data-method='DELETE'>Delete Item</a>";
    	});

        $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
    })
    .removeAttr('href')
    .attr('onclick','$(this).find("form").submit()');

    });

    $('[data-dismiss]').click(function(){
        $('.modal-footer').empty();
    });
});