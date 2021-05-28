/**
 * @author Evandro Silva
 */

function shopCartRemoveProduct(ojecto)
{
    product = ojecto;

    $('#form-remove-product input[name="request_id"]').val(product.requestID);
    $('#form-remove-product input[name="product_id"]').val(product.productID);
    $('#form-remove-product input[name="item"]').val(product.item);
    $('#form-remove-product input[name="color"]').val(product.color);
    $('#form-remove-product input[name="status"]').val(product.status);
    $('#form-remove-product').submit();
}

function shopCartAddProduct( productID )
{
    $('#form-add-product input[name="id"]').val(productID);
    $('#form-add-product').submit();
}

function shopCartQtdProduct( objecto )
{
    product = objecto;

    var qtd = document.getElementById("price-min-"+product.RequestProductID);

    console.log(qtd.value.length);

    if (qtd.value.length >= 1)
    {
        setTimeout(DezSegundos, 1000*3);
    }

    function DezSegundos()
    {
        $('#form-add-product input[name="id"]').val(product.productID);
        $('#form-add-product input[name="color"]').val(product.color);
        $('#form-add-product input[name="status"]').val(product.status);
        $('#form-add-product input[name="qtd"]').val(qtd.value);
        $('#form-add-product').submit();
    }

}

function shopCartQtdProduct2( objecto )
{
    product = objecto;

    var qtd = document.getElementById("price-min2-"+product.productID);

    console.log(qtd.value.length);

    if (qtd.value.length >= 1)
    {
        setTimeout(DezSegundos, 1000*3);
    }

    function DezSegundos()
    {
        $('#form-add-product input[name="id"]').val(product.productID);
        $('#form-add-product input[name="color"]').val(product.color);
        $('#form-add-product input[name="status"]').val(product.status);
        $('#form-add-product input[name="qtd"]').val(qtd.value);
        $('#form-add-product').submit();
    }

}



