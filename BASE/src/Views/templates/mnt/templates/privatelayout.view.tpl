<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{SITE_TITLE}}</title>

  <!--FONTS & ICONS-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
  
  <!--BOOTSTRAP STYLESHEETS-->
  <link href="public/css/estilos.css" rel="stylesheet">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <!--BOOTSTRAP SCRIPTS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>

  {{foreach SiteLinks}}
    <link rel="stylesheet" href="{{this}}" />
  {{endfor SiteLinks}}
  {{foreach BeginScripts}}
    <script src="{{this}}"></script>
  {{endfor BeginScripts}}
</head>
<body>
  <header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img class="mr-3" src="public\img\logo.jpg" style="height:40px; border-radius: 20%;">
          {{SITE_TITLE}}
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            {{foreach CLIENTNAVIGATION}}
              <li class="nav-item">
                <a class="nav-link" href="{{nav_url}}">{{if nav_icon}}<i class="{{nav_icon}}"></i>{{endif nav_icon}}{{nav_label}}</a>
              </li>
            {{endfor CLIENTNAVIGATION}}

            {{if ADMINNAVIGATION}}
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" id="navDropDownLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Gestión de la Plataforma
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navDropDownLink">
                    {{foreach ADMINNAVIGATION}}
                      <a class="dropdown-item" href="{{nav_url}}">{{if nav_icon}}<i class="{{nav_icon}}"></i>{{endif nav_icon}}{{nav_label}}</a>
                    {{endfor ADMINNAVIGATION}}
                  </div>
              </li>
            </ul>
            {{endif ADMINNAVIGATION}}
            
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" id="navDropDownLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user mx-2"></i>
                    {{with login}}
                      {{userName}}
                    {{endwith login}}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navDropDownLink">
                      <a class="dropdown-item" href="index.php?page=sec_logout"> <i class="fas fa-sign-out-alt mx-2"></i>Salir</a>
                  </div>
              </li>
            </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
  {{{page_content}}}
  </main>
  <footer class="py-4 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Todo los Derechos Reservados 2021</p>
    </div>
  </footer>
  {{foreach EndScripts}}
    <script src="{{this}}"></script>
  {{endfor EndScripts}}
</body>
</html>
