/**
 * @author Evandro Silva
 */

$(function () {

    function setarTotalItens()
    {
        var qtdItens = $("#total-itens")[0];

        if(qtdItens === undefined)
        {
            qtdItens = 0;
        }

       $('#qty').html(qtdItens.value);
    }

    $('#terms').click(function()
    {
        $("#terms").toggle(this.checked);

        var payment1 = document.getElementById("payment-1");
        var payment2 = document.getElementById("payment-2");
        var payment3 = document.getElementById("payment-3");

        if( ( ((payment1.checked) == true)  || ((payment2.checked) == true) || ((payment3.checked) == true) ) && ($("#terms").is(':checked')) )
        {
            $("#concluir-compra").show();
        }
        else
        {
            $("#concluir-compra").hide();
        }
    });

    $("#end-session").click(function()
    {
        $('#modal-client-checkout').modal('show')
    });

    setarTotalItens();
})
