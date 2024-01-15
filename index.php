<?php
require_once __DIR__ . '/infra/middlewares/middleware-not-authenticated.php';
//require_once __DIR__ . './setupdatabase.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyMaster</title>
    <link rel="stylesheet" href="/crud/styles.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Lato:ital,wght@0,400;0,700;1,400;1,700&family=Raleway:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="secao text-center" id="landing-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="logo-layout">
                        <a class="navbar-brand" href="#landing-container">
                            <img src="/crud/assets/images/uploads/logo.png" alt="logo" class="logo">
                        </a>
                    </div>
                </div>
                <div class="col align-items-start nav-links">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <ul class="d-none d-md-block">
                            <li><a href="#how-it-works">COMO FUNCIONA</a></li>
                            <li><a href="#about-us">SOBRE NÓS</a></li>
                            <li><a href="/crud/pages/public/signin.php">LOGIN</a></li>
                            <li><a href="/crud/pages/public/signup.php">SIGN UP</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 welcome">
                        <h1 class="header">Money Master</h1>
                    <p style="font-size:x-large; color: white;">A tua plataforma para gerir as tuas despesas pessoais!</p>
                    <a href="/crud/pages/public/signup.php"><button class="button">Começar Agora</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="secao" id="how-it-works">
        <div class="how-it-works-container">
            <h3 class="mt-5" style="padding: 5px;">O MoneyMaster ajuda-te a gerir as tuas despesas. Vê como o podes fazer:</h3>
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="login">
                        <a href="#"><img src="/crud/assets/images/uploads/user-profile_5645402.png" alt="login"></a>
                        <p>Regista-te.</p>
                    </div>
                </div>
                <div class="col-md-6">   
                    <div class="categoria">
                        <a href="#"><img src="/crud/assets/images/uploads/share_7489765.png" alt="categoriza"></a>
                        <p>Adiciona e categoriza as tuas despesas.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="agenda">
                        <img src="/crud/assets/images/uploads/shedule.png" alt="agenda">
                        <p>Agenda pagamentos e recebe lembretes para não deixares as tuas despesas acumularem.</p>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="anexo">
                        <img src="/crud/assets/images/uploads/attach-file.png" alt="anexo" >
                        <p class="mb-5">Adiciona notas e anexa as tuas faturas/recibos como comprovativos de pagamento.</p>
                    </div>
                </div>
            </div>       
        </div>
    </div>
    <div class="secao" id="about-us">
        <div class="about-us-container mt-5">
                <div class="row mt-3">
                    <div class="col text-about-us">
                        <h1 class="about-us-h1">Sobre nós</h1>
                        <p>Bem-vindo à nossa plataforma de gestão de despesas!</p>
                        <p>Somos estudantes do curso de Engenharia Informática na ESTG-IPVC.</p>
                        <p>Comprometemo-nos a ajudar-te com a gestão das tuas despesas pessoais.</p>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col text-objetivo">
                        <h2 class="objetivo">O nosso objetivo</h2>
                        <p>Queremos proporcionar-te uma experiência intuitiva e eficaz na gestão das tuas despesas.</p>
                        <p>Acreditamos que a tecnologia pode simplificar a teu dia-a-dia.</p>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col text-contacto">
                        <h2 class="contacto">Contacta-nos</h2>
                        <p>Se tiveres alguma dúvida ou sugestão, não hesites em contactar-nos!</p>
                        <p>Estamos disponíveis para te ajudar!</p>
                    </div>
                </div>
            <footer>
                <hr>
                <div class="row">
                    <div class="col rodape">
                        <ul>
                            <li style="margin-right: 20px;">&copy;MoneyMaster</li>
                            <li style="margin-right: 20px;"><a href="https://github.com/Caselhos" target="_blank"><img src="/crud/assets/images/uploads/GitHubLogo.png" class="GitHubLogo" ></a>Gonçalo Caselhos</li>
                            <li><a href="https://github.com/zenuncro" target="_blank"><img src="/crud/assets/images/uploads/GitHubLogo.png" class="GitHubLogo"></a>João Araújo</li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>