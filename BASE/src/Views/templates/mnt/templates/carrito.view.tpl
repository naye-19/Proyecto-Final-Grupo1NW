<section class="container min-vh-100">
    <h3 class="my-4">Detalle de la Orden</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">Descripción</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Precio sin Impuesto</th>
                <th class="text-center">Impuesto calculado</th>
                <th class="text-center">Precio con Impuesto</th>
                <th class="text-center">Total</th>
                <th width="15%" class="text-center">Imagen</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{foreach Items}}
            <tr>
                <td class="align-middle">{{ProdNombre}}</td>
                <td class="text-center align-middle">{{ProdCantidad}}</td>
                <td class="text-center align-middle">{{ProdPrecioSinImpuesto}}</td>
                <td class="text-center align-middle">{{ProdImpuesto}}</td>
                <td class="text-center align-middle">{{ProdPrecioVenta}}</td>
                <td class="text-center align-middle">{{TotalProducto}}</td>
                <td width="15%" class="text-center align-middle">
                    <div class="border">
                        <img class="rounded mx-auto d-block" src="{{MediaPath}}" alt="{{MediaDoc}}" width="60%">
                    </div>
                </td>

                <td>
                    <form method="POST" action="index.php?page=carrito">
                        <input type="hidden" id="ProdId" name="ProdId" value="{{ProdId}}">
                        <input type="hidden" id="ProdCantidad" name="ProdCantidad" value="{{ProdCantidad}}">
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            {{endfor Items}}
        </tbody>
    </table>

    <form class="d-flex flex-column align-items-end">
        <div class="form-group col-md-2">
            <label for="CarritoSubtotal" class="font-weight-bold">Subtotal</label>
            <input type="text" readonly class="form-control" id="CarritoSubtotal" value="{{Subtotal}}">
        </div>
        
        <div class="form-group col-md-2">
            <label for="CarritoTotal" class="font-weight-bold">Total</label>
            <input type="text" readonly class="form-control" id="CarritoTotal" value="{{Total}}">
        </div>
    </form>

    <!--
    <form action="index.php" method="get">
        <input type="hidden" name="page" value="admin_categoria"/>
        <input type="hidden" name="mode" value="UPD" />
        <input type="hidden" name="CategoriaId" value={{CategoriaId}} />
        <button type="submit" class="btn btn-primary my-1">Editar</button>
    </form>
    -->

    {{if Items}}
    <form method="GET" action="index.php">
        <div class="form-group">
            <input type="hidden" name="page" value="direccionentrega">
            <button type="submit" class="btn btn-primary my-4">Realizar transacción</button>
        </div>
    </form>
    {{endif Items}}

</section>