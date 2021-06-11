$("#subcategorie").change(function(event){
    $.get("especialidades/"+event.target.value+"",function(response,subcategorie){
        console.log(response);

        $("#brand").empty();
        for(i=0; i<response.length; i++)
        {
            $("#brand").append("<option value='"+response[i].id+"'> "+response[i].name+"</option>");
        }
    });
});
