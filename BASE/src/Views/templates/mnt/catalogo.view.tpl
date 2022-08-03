<section class="container-fluid" id="productos">
    <h4 class="my-4 text-center p-3 mb-2 bg-light text-dark">{{PageTitle}}</h4>
    
    <!--Formulario para la busqueda por descripcion-->
    <form class="form-inline align-items-center d-flex justify-content-center mb-4" action="index.php" method="GET">
        <input type="hidden" name="page" value="mnt_catalogo"/>
        <input type="hidden" name="PageIndex" value="1" />

        <input type="search" class="form-control col-8" id="UsuarioBusqueda" name="UsuarioBusqueda" value="{{UsuarioBusqueda}}" placeholder="Ingrese su búsqueda">
        <button type="submit" class="btn btn-primary mx-2">Buscar</button>
    </form>
    <div class="container-fluid">
        <div class="row align-items-start">
          <div class="col-md-auto">
            <div class="card">
              <h5 class = "card-title text-center">Precios</h5>
              <div class="card-body">
                <form class="align-items-center" action="index.php" method="GET">
                  <input type="hidden" name="page" value="mnt_catalogo"/>
                  <input type="hidden" name="PageIndex" value="1" />
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="UsuarioBusquedaByPrice" value="0-500" id="UsuarioBusquedaByPrice">
                  <label class="form-check-label" for="UsuarioBusquedaByPrice">
                    0 - 500
                  </label>
                </div>
                <br>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="UsuarioBusquedaByPrice" id="UsuarioBusquedaByPrice" value="501-2000">
                  <label class="form-check-label" for="UsuarioBusquedaByPrice">
                    500 - 2,000
                  </label>
                </div>
                <br>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="UsuarioBusquedaByPrice" id="UsuarioBusquedaByPrice" value="2001-10000000">
                  <label class="form-check-label" for="UsuarioBusquedaByPrice">
                    2,000 +
                  </label>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary mx-2">Buscar</button>
              </div>
            </form>
            </div>
          </div>
          <div class="col">
            <div class="row">
                {{foreach Productos}}
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card h-100 pb-2">
                            <div class="card-bodys align-items-center d-flex flex-column justify-content-center">
                                <a href="index.php?page=Mnt_DetalleProducto&ProdId={{ProdId}}"><img class="card-img-top mb-4" src="{{MediaPath}}" alt="{{MediaDoc}}" style="width: 200px; max-height: 400px;"></a>
                                <h4 class="card-title text-center mb-4">
                                <a href="index.php?page=Mnt_DetalleProducto&ProdId={{ProdId}}">{{ProdNombre}}</a>
                                </h4>
                                <h5 class="mb-4">Lps. {{ProdPrecioVenta}}</h5>
                                <p class="card-text">{{ProdDescripcion}}</p>
                            </div>
                              <a href="index.php?page=Mnt_DetalleProducto&ProdId={{ProdId}}" class="btn btn-primary mx-2">Ver más</a>
                        </div>
                    </div>
                {{endfor Productos}}
            </div>     
          </div>
        
        </div>
        <div class="row mt-3" >
            <div class="col-md-12 d-flex">
                <ul class="pagination mx-auto"> 
                    <li class="page-item {{PreviousState}}">
                        <a class="page-link" href="index.php?page=mnt_catalogo&PageIndex={{Previous}}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                          <span class="sr-only">Previous</span>
                        </a>
                    </li>
                         <!--La paginas para los productos -->
                      {{foreach PageIndexes}}
                        <li class="page-item {{Estado}}"><a class="page-link" href="index.php?page=mnt_catalogo&PageIndex={{Index}}{{if Busqueda}}&UsuarioBusqueda={{Busqueda}}{{endif Busqueda}}">{{Index}}</a></li>
                      {{endfor PageIndexes}}
    
                    <li class="page-item {{NextState}}">
                        <a class="page-link" href="index.php?page=mnt_catalogo&PageIndex={{Next}}" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                          <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div> 
</section>