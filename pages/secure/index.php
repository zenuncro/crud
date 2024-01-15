<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '/../../infra/repositories/expenseRepository.php';
@require_once __DIR__ . '/../../helpers/session.php';
include_once __DIR__ . '../../../templates/header.php';

$user = user();
$title = '- App';
?>

<style>
    .background-box {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        min-height: 100px; 
        border-radius: 10px; 
        overflow: hidden;
    }

    .perfil-box{
        background-image: url("/crud/assets/images/uploads/bg-profile.png");
    }
    .admin-box{
        background-image: url("/crud/assets/images/uploads/bg-admin.jpg");
    }
    .partilha-box{
        background-color: #e8eddf;
    }
    .calendario-box{
        background-color: #e8eddf;
    }
    .categorizar-box{
        background-color: #e8eddf;
    }
    .listar-box{
        background-color: #e8eddf;
    }
    .img-icon {
        width: 60px; 
        height: 60px; 
    }
    .notification-badge {
        background-color: #dc3545;
        color: #fff; 
        padding: 0.5rem 1rem; 
        border-radius: 50%; 
        margin-right: 0.25rem;
        margin-top: 0.25rem; 
    }
</style>    

<head>
    <link rel="stylesheet" href="/crud/styles.css">
    <title>MoneyMaster</title>
</head>
<body style="background-image: linear-gradient(to right, #FFA200 , #FFC300);">
    <main>
        <header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
            <a href="/crud/pages/secure/" class="text-dark text-decoration-none logo">
                <img src="/crud/assets/images/uploads/logo.png" alt="ESTG" class="mw-100">
            </a>
            <div class="header-text mb-4 text-center">
                <h1 class="display-5 fw-bold">Bem-vindo, <?= $user['name'] ?? null ?>!</h1>
            </div>
            <form action="/crud/controllers/auth/signin.php" method="post">
                <button class="btn btn-lg px-4 border-dark" type="submit" name="user" value="logout" style="">Logout</button>
            </form>
        </header>
        <div class="row align-items-md-stretch">
            <div class="col-md-12 mb-3">
                <div class="h-100 p-5 border background-box perfil-box rounded-3 d-flex align-items-center">
                    <div>
                        <h3 style="color: white;">Perfil</h3>
                        <a href="/crud/pages/secure/user/profile.php">
                            <button class="btn btn-light px-5 text-dark" type="button">Ir para Perfil</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php if (isAuthenticated() && is_array($user) && $user['administrator']) { ?>
                <div class="col-md-6 mb-3 h-100">
                    <div class="h-100 p-5 border background-box admin-box d-flex align-items-center">
                        <div>
                            <h3>Admin</h3>
                            <a href="/crud/pages/secure/admin/">
                                <button class="btn btn-light px-5 text-dark" type="button">Admin</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-6 mb-3">
                <div class="h-100 p-5 background-box categorizar-box border rounded-3 d-flex align-items-center">
                    <img src="/crud/assets/images/uploads/add_index.png" alt="Ícone de Adicionar Despesa" class="me-3 img-icon">
                    <div>
                        <h3>Adicionar Despesa</h3>
                        <a href="/crud/pages/secure/user/addPersonalExpense.php">
                            <button class="btn btn-light px-5 text-dark" type="button">Adicionar</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="h-100 p-5 background-box partilha-box border rounded-3 d-flex align-items-center">
                    <img src="/crud/assets/images/uploads/share_index.png" alt="Ícone de Partilhar Despesas" class="me-3 img-icon">
                    <div>
                        <h3>Partilhar Despesas</h3>
                        <a href="/crud/pages/secure/user/sharePersonalExpense.php">
                            <button class="btn btn-light px-5 text-dark" type="button">Ir para Partilhar Despesas</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="h-100 p-5 background-box calendario-box border rounded-3 d-flex align-items-center">
                    <img src="/crud/assets/images/uploads/calendario_index.png" alt="Ícone de Calendário Despesa" class="me-3 img-icon">
                    <div>
                        <h3>Calendarizar Despesa</h3>
                        <a href="/crud/pages/secure/user/schedulePersonalExpense.php">
                            <button class="btn btn-light px-5 text-dark" type="button">Ir para Calendário</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="h-100 p-5 background-box listar-box border rounded-3 d-flex align-items-center">
                    <img src="/crud/assets/images/uploads/lista_index.png" alt="Ícone de Listar Despesas" class="me-3 img-icon">
                    <div>
                        <h3>Listar Despesas</h3>
                        <a href="/crud/pages/secure/user/listExpense.php">
                            <button class="btn btn-light px-5 text-dark" type="button">Listar Despesas</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="h-100 p-5 background-box listar-box border rounded-3 position-relative d-flex align-items-center">
                    <div>
                        <h2>Despesas Partilhadas</h2>
                        <a href="/crud/pages/secure/user/viewSharedExpenses.php">
                            <button class="btn btn-light px-5 text-dark" type="button">Ir para Despesas Partilhadas</button>
                        </a>
                        <?php
                        $numberOfSharedExpenses = getNumberOfUnviewedExpenses($user['id']);
                        ?>
                        <span class="notification-badge position-absolute top-0 end-0"><?= $numberOfSharedExpenses; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="h-100 p-5 background-box listar-box border rounded-3 position-relative d-flex align-items-center">
                    <div>
                        <h2>Despesas a Pagar</h2>
                        <a href="/crud/pages/secure/user/viewExpensesToPay.php">
                            <button class="btn btn-light px-5 text-dark" type="button">Ir para Despesas a Pagar</button>
                        </a>
                        <?php
                        $numberOfExpenses = getNumberOfTodayExpenses($user['id']);
                        ?>
                        <span class="notification-badge position-absolute top-0 end-0"><?= $numberOfExpenses; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>
