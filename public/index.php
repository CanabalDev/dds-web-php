<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);



// declare(strict_types=1);

session_start();

// 🔹 Autoload simple (temporal)
require_once __DIR__ . '/../Domain/Models/UserModel.php';
require_once __DIR__ . '/../Domain/Models/EquipoFutbol.php';

// ValueObjects
require_once __DIR__ . '/../Domain/ValueObjects/UserId.php';
require_once __DIR__ . '/../Domain/ValueObjects/UserName.php';
require_once __DIR__ . '/../Domain/ValueObjects/UserEmail.php';
require_once __DIR__ . '/../Domain/ValueObjects/UserPassword.php';

require_once __DIR__ . '/../Domain/ValueObjects/TeamName.php';
require_once __DIR__ . '/../Domain/ValueObjects/TeamCountry.php';
require_once __DIR__ . '/../Domain/ValueObjects/TeamCity.php';
require_once __DIR__ . '/../Domain/ValueObjects/TeamCategory.php';

// Commands
require_once __DIR__ . '/../Application/Commands/CreateUserCommand.php';
require_once __DIR__ . '/../Application/Commands/UpdateUserCommand.php';
require_once __DIR__ . '/../Application/Commands/LoginCommand.php';
require_once __DIR__ . '/../Application/Commands/CreateEquipoCommand.php';
require_once __DIR__ . '/../Application/Commands/UpdateEquipoCommand.php';

// Ports In
require_once __DIR__ . '/../Application/Ports/In/User/CreateUserUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/User/GetUserByIdUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/User/GetUsersUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/User/LoginUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/User/UpdateUserUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/User/DeleteUserUseCase.php';

require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/RegisterDrawUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/RegisterExpulsionUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/RegisterChampionshipUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/UpdateEquipoUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/CreateEquipoUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/DeleteEquipoUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/GetEquipoByIdUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/GetEquiposUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/RegisterGoalUseCase.php';
require_once __DIR__ . '/../Application/Ports/In/EquipoFutbol/RegisterVictoryUseCase.php';



// Ports Out

require_once __DIR__ . '/../Application/Ports/Out/User/SaveUserPort.php';
require_once __DIR__ . '/../Application/Ports/Out/User/GetUserByIdPort.php';
require_once __DIR__ . '/../Application/Ports/Out/User/GetUserByEmailPort.php';
require_once __DIR__ . '/../Application/Ports/Out/User/GetUsersPort.php';
require_once __DIR__ . '/../Application/Ports/Out/User/UpdateUserPort.php';
require_once __DIR__ . '/../Application/Ports/Out/User/DeleteUserPort.php';

require_once __DIR__ . '/../Application/Ports/Out/EquipoFutbol/SaveEquipoPort.php';
require_once __DIR__ . '/../Application/Ports/Out/EquipoFutbol/GetEquipoByIdPort.php';
require_once __DIR__ . '/../Application/Ports/Out/EquipoFutbol/GetEquiposPort.php';
require_once __DIR__ . '/../Application/Ports/Out/EquipoFutbol/UpdateEquipoPort.php';
require_once __DIR__ . '/../Application/Ports/Out/EquipoFutbol/DeleteEquipoPort.php';

// Services
require_once __DIR__ . '/../Application/Services/User/CreateUserService.php';
require_once __DIR__ . '/../Application/Services/User/GetUserByIdService.php';
require_once __DIR__ . '/../Application/Services/User/GetUsersService.php';
require_once __DIR__ . '/../Application/Services/User/LoginService.php';
require_once __DIR__ . '/../Application/Services/User/UpdateUserService.php';
require_once __DIR__ . '/../Application/Services/User/DeleteUserService.php';


require_once __DIR__ . '/../Application/Services/Equipo/CreateEquipoService.php';
require_once __DIR__ . '/../Application/Services/Equipo/GetEquipoByIdService.php';
require_once __DIR__ . '/../Application/Services/Equipo/GetEquiposService.php';
require_once __DIR__ . '/../Application/Services/Equipo/DeleteEquipoService.php';
require_once __DIR__ . '/../Application/Services/Equipo/RegisterVictoryService.php';
require_once __DIR__ . '/../Application/Services/Equipo/RegisterGoalService.php';
require_once __DIR__ . '/../Application/Services/Equipo/RegisterDrawService.php';
require_once __DIR__ . '/../Application/Services/Equipo/RegisterExpulsionService.php';
require_once __DIR__ . '/../Application/Services/Equipo/RegisterChampionshipService.php';
require_once __DIR__ . '/../Application/Services/Equipo/UpdateEquipoService.php';

// Repositories
require_once __DIR__ . '/../Infrastructure/Persistence/MySQL/UserRepositoryMySQL.php';
require_once __DIR__ . '/../Infrastructure/Persistence/MySQL/EquipoRepositoryMySQL.php';

use Infrastructure\Persistence\MySQL\UserRepositoryMySQL;
use Infrastructure\Persistence\MySQL\EquipoRepositoryMySQL;

use Application\Services\User\CreateUserService;
use Application\Services\User\GetUsersService;
use Application\Services\User\GetUserByIdService;
use Application\Services\User\LoginService;
use Application\Services\User\UpdateUserService;
use Application\Services\User\DeleteUserService;

use Application\Services\Equipo\CreateEquipoService;
use Application\Services\Equipo\GetEquipoByIdService;
use Application\Services\Equipo\GetEquiposService;
use Application\Services\Equipo\RegisterVictoryService;
use Application\Services\Equipo\RegisterGoalService;
use Application\Services\Equipo\RegisterDrawService;
use Application\Services\Equipo\RegisterExpulsionService;
use Application\Services\Equipo\RegisterChampionshipService;
use Application\Services\Equipo\UpdateEquipoService;
use Application\Services\Equipo\DeleteEquipoService;

use Application\Commands\CreateUserCommand;
use Application\Commands\UpdateUserCommand;
use Application\Commands\LoginCommand;
use Application\Commands\CreateEquipoCommand;


// Conexión a BD
$pdo = new PDO("mysql:host=localhost;dbname=hexagonal", "phpuser", "1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Repositorios
$userRepo = new UserRepositoryMySQL($pdo);
$equipoRepo = new EquipoRepositoryMySQL($pdo, $userRepo);


// Services
$createUserService = new CreateUserService($userRepo);
$loginService = new LoginService($userRepo);
$getUsersService = new GetUsersService($userRepo);
$getUserByIdService = new GetUserByIdService($userRepo);
$updateUserService = new UpdateUserService($userRepo, $userRepo);
$deleteUserService = new DeleteUserService($userRepo);

$createEquipoService = new CreateEquipoService($equipoRepo, $userRepo);
$getEquiposService = new GetEquiposService($equipoRepo);
$getEquipoByIdService = new GetEquipoByIdService($equipoRepo);
$registerVictoryService = new RegisterVictoryService($equipoRepo, $equipoRepo);
$registerGoalService = new RegisterGoalService($equipoRepo, $equipoRepo);
$registerDrawService = new RegisterDrawService($equipoRepo, $equipoRepo);
$registerExpulsionService = new RegisterExpulsionService($equipoRepo, $equipoRepo);
$registerChampionshipService = new RegisterChampionshipService($equipoRepo, $equipoRepo);
$updateEquipoService = new UpdateEquipoService($equipoRepo, $equipoRepo, $userRepo);
$deleteEquipoService = new DeleteEquipoService($equipoRepo);

// 🌐 ROUTE
$route = $_GET['route'] ?? 'home';

// 🔐 Protección
$publicRoutes = ['login', 'auth', 'user.create', 'user.store', 'forgot', 'forgot.send'];

if (!isset($_SESSION['user']) && !in_array($route, $publicRoutes)) {
  header("Location: ?route=login");
  exit;
}

// 🎨 NAVBAR
echo "
<link rel='stylesheet' href='css/styles.css'>
<div class='navbar'>
    <a href='?route=home'>Inicio</a>
    <a href='?route=user.list'>Usuarios</a>
    <a href='?route=equipo.list'>Equipos</a>
    <a href='?route=login'>Login</a>
    <a href='?route=logout'>Logout</a>
</div>
<div class='container'>
";

try {

  switch ($route) {

    case 'home':
      echo "<h1>Bienvenido</h1>";
      break;

    // 👤 USERS CRUD
    case 'user.list':
      $users = $getUsersService->execute();

      echo "<p><a href='?route=user.create' class='button primary'>+ Crear usuario</a></p>";

      foreach ($users as $u) {
        echo "<div class='card'>";
        echo "<h3>" . $u->getName()->value() . "</h3>";
        echo "<p>" . $u->getEmail()->value() . "</p>";
        echo "<p><a class='button soft' href='?route=user.view&id=" . $u->getId()->value() . "'>Ver</a> <a class='button soft' href='?route=user.edit&id=" . $u->getId()->value() . "'>Editar</a> <a class='button soft delete' href='?route=user.delete&id=" . $u->getId()->value() . "'>Eliminar</a></p>";
        echo "</div>";
      }
      break;

    case 'user.create':
      echo "
                <form method='POST' action='?route=user.store' class='form-card'>
                    <label for='user-id'>ID</label>
                    <input id='user-id' name='id' placeholder='Ingresa un ID único' required><br>

                    <label for='user-name'>Nombre</label>
                    <input id='user-name' name='name' placeholder='Nombre completo' required><br>

                    <label for='user-email'>Email</label>
                    <input id='user-email' type='email' name='email' placeholder='correo@dominio.com' required><br>

                    <label for='user-password'>Contraseña</label>
                    <input id='user-password' type='password' name='password' placeholder='Crea una contraseña segura' required><br>

                    <button class='button primary'>Crear usuario</button>
                </form>
            ";
      break;

    case 'user.store':
      $command = new CreateUserCommand(
        $_POST['id'],
        $_POST['name'],
        $_POST['email'],
        $_POST['password']
      );
      $createUserService->execute($command);
      echo "Usuario creado";
      break;

    case 'user.view':
      $user = $getUserByIdService->execute($_GET['id']);
      echo "<div class='card'>";
      echo "Nombre: " . $user->getName()->value() . "<br>";
      echo "Email: " . $user->getEmail()->value();
      echo "</div>";
      break;

    case 'user.edit':
      $user = $getUserByIdService->execute($_GET['id']);

      echo "
            <form method='POST' action='?route=user.update' class='form-card'>
                <input type='hidden' name='id' value='" . $user->getId()->value() . "'>

                <label for='edit-name'>Nombre</label>
                <input id='edit-name' name='name' value='" . $user->getName()->value() . "' required><br>

                <label for='edit-email'>Email</label>
                <input id='edit-email' type='email' name='email' value='" . $user->getEmail()->value() . "' required><br>

                <label for='edit-password'>Nueva contraseña</label>
                <input id='edit-password' type='password' name='password' placeholder='Dejar en blanco para mantener actual'><br>

                <button class='button primary'>Actualizar usuario</button>
            </form>
            ";
      break;

    case 'user.update':
      $command = new UpdateUserCommand(
        $_POST['id'],
        $_POST['name'],
        $_POST['email'],
        $_POST['password'] ?: null
      );
      $updateUserService->execute($command);
      echo "Usuario actualizado";
      break;

    case 'user.delete':
      $deleteUserService->execute($_GET['id']);
      echo "Usuario eliminado";
      break;

    // 🔐 LOGIN
    case 'login':
      echo "
                <form method='POST' action='?route=auth' class='form-card'>
                    <label for='login-email'>Email</label>
                    <input id='login-email' type='email' name='email' placeholder='correo@dominio.com' required><br>

                    <label for='login-password'>Contraseña</label>
                    <input id='login-password' type='password' name='password' placeholder='Contraseña' required><br>

                    <button class='button primary'>Login</button>
                </form>
                <p><a href='?route=forgot' class='button soft'>¿Olvidaste contraseña?</a></p>
            ";
      break;

    case 'auth':
      $command = new LoginCommand($_POST['email'], $_POST['password']);
      $user = $loginService->execute($command);
      $_SESSION['user'] = $user->getId()->value();
      echo "Login exitoso";
      break;

    case 'logout':
      session_destroy();
      header("Location: ?route=login");
      break;

    // 🔁 RECUPERAR PASSWORD
    case 'forgot':
      echo "
                <form method='POST' action='?route=forgot.send' class='form-card'>
                    <label for='forgot-email'>Email</label>
                    <input id='forgot-email' type='email' name='email' placeholder='correo@dominio.com' required><br>

                    <label for='forgot-name'>Nombre</label>
                    <input id='forgot-name' name='name' placeholder='Nombre completo' required><br>

                    <button class='button primary'>Recuperar contraseña</button>
                </form>
            ";
      break;

    case 'forgot.send':
      $email = $_POST['email'];
      $name = $_POST['name'];

      $user = $userRepo->findByEmail($email);

      if ($user && $user->getName()->value() === $name) {
        echo "<div class='card'>";
        echo "<h3>Contraseña recuperada</h3>";
        echo "<p>Tu contraseña es: <strong>" . $user->getPassword()->value() . "</strong></p>";
        echo "<p><a href='?route=login' class='button primary'>Ir al login</a></p>";
        echo "</div>";
      } else {
        echo "<div class='card'>";
        echo "<h3>Error</h3>";
        echo "<p>Datos incorrectos. Verifica tu email y nombre.</p>";
        echo "<p><a href='?route=forgot' class='button soft'>Intentar de nuevo</a></p>";
        echo "</div>";
      }
      break;

    // ⚽ EQUIPOS
    case 'equipo.list':
      $equipos = $getEquiposService->execute();

      echo "<p><a href='?route=equipo.create' class='button primary'>+ Crear equipo</a></p>";

      foreach ($equipos as $e) {
        echo "<div class='card'>";
        echo "<h3>" . $e->getNombre()->value() . "</h3>";
        echo "<p>Goles: " . $e->getNumGoles() . " | Partidos ganados: " . $e->getNumPartidosGanados() . " | Empates: " . $e->getNumEmpates() . " | Expulsiones: " . $e->getNumExpulsiones() . " | Campeonatos: " . $e->getNumCampeonatos() . "</p>";
        echo "<p><a class='button soft' href='?route=equipo.view&id=" . $e->getId() . "'>Ver</a> <a class='button soft' href='?route=equipo.edit&id=" . $e->getId() . "'>Editar</a> <a class='button soft delete' href='?route=equipo.delete&id=" . $e->getId() . "'>Eliminar</a></p>";
        echo "<p><a class='button soft' href='?route=equipo.victoria&id=" . $e->getId() . "'>Victoria</a> <a class='button soft' href='?route=equipo.gol&id=" . $e->getId() . "'>Gol</a> <a class='button soft' href='?route=equipo.empate&id=" . $e->getId() . "'>Empate</a> <a class='button soft' href='?route=equipo.expulsion&id=" . $e->getId() . "'>Expulsión</a> <a class='button soft' href='?route=equipo.campeonato&id=" . $e->getId() . "'>Campeonato</a></p>";
        echo "</div>";
      }
      break;

    case 'equipo.create':
      $users = $getUsersService->execute();

      $options = "";
      foreach ($users as $u) {
        $options .= "<option value='" . $u->getId()->value() . "'>" . $u->getName()->value() . "</option>";
      }

      echo "
            <form method='POST' action='?route=equipo.store' class='form-card'>
                <label for='nombre'>Nombre del equipo</label>
                <input id='nombre' name='nombre' placeholder='Ej: Club Deportivo' required><br>

                <label for='eslogan'>Eslogan</label>
                <input id='eslogan' name='eslogan' placeholder='Ej: Pasión y garra'><br>

                <label for='tecnicoId'>Técnico</label>
                <select id='tecnicoId' name='tecnicoId'>$options</select><br>

                <label for='pais'>País</label>
                <input id='pais' name='pais' placeholder='Ej: España'><br>

                <label for='ciudad'>Ciudad</label>
                <input id='ciudad' name='ciudad' placeholder='Ej: Madrid'><br>

                <label for='categoria'>Categoría</label>
                <input id='categoria' name='categoria' placeholder='Ej: Profesional'><br>

                <button class='button primary'>Crear equipo</button>
            </form>
            ";
      break;

    case 'equipo.store':
      $command = new CreateEquipoCommand(
        $_POST['nombre'],
        $_POST['eslogan'],
        $_POST['tecnicoId'],
        $_POST['pais'],
        $_POST['ciudad'],
        $_POST['categoria']
      );

      $createEquipoService->execute($command);
      echo "Equipo creado";
      break;

    case 'equipo.view':
      $equipo = $getEquipoByIdService->execute($_GET['id']);
      echo "<div class='card'>";
      echo "<h3>" . $equipo->getNombre()->value() . "</h3>";
      echo "<p>Eslogan: " . $equipo->getEslogan() . "</p>";
      echo "<p>Técnico: " . $equipo->getTecnico()->getName()->value() . "</p>";
      echo "<p>País: " . $equipo->getPais()->value() . "</p>";
      echo "<p>Ciudad: " . $equipo->getCiudad()->value() . "</p>";
      echo "<p>Categoría: " . $equipo->getCategoria()->value() . "</p>";
      echo "<p>Goles: " . $equipo->getNumGoles() . "</p>";
      echo "<p>Partidos jugados: " . $equipo->getNumPartidosJugados() . "</p>";
      echo "<p>Partidos ganados: " . $equipo->getNumPartidosGanados() . "</p>";
      echo "<p>Empates: " . $equipo->getNumEmpates() . "</p>";
      echo "<p>Expulsiones: " . $equipo->getNumExpulsiones() . "</p>";
      echo "<p>Campeonatos: " . $equipo->getNumCampeonatos() . "</p>";
      echo "<p><a href='?route=equipo.list' class='button soft'>Volver</a></p>";
      echo "</div>";
      break;

    case 'equipo.edit':
      $equipo = $getEquipoByIdService->execute($_GET['id']);
      $users = $getUsersService->execute();

      $options = "";
      foreach ($users as $u) {
        $selected = ($u->getId()->value() == $equipo->getTecnico()->getId()->value()) ? "selected" : "";
        $options .= "<option value='" . $u->getId()->value() . "' $selected>" . $u->getName()->value() . "</option>";
      }

      echo "
            <form method='POST' action='?route=equipo.update' class='form-card'>
                <input type='hidden' name='id' value='" . $equipo->getId() . "'>

                <label for='edit-nombre'>Nombre del equipo</label>
                <input id='edit-nombre' name='nombre' value='" . $equipo->getNombre()->value() . "' required><br>

                <label for='edit-eslogan'>Eslogan</label>
                <input id='edit-eslogan' name='eslogan' value='" . $equipo->getEslogan() . "'><br>

                <label for='edit-tecnicoId'>Técnico</label>
                <select id='edit-tecnicoId' name='tecnicoId'>$options</select><br>

                <label for='edit-pais'>País</label>
                <input id='edit-pais' name='pais' value='" . $equipo->getPais()->value() . "'><br>

                <label for='edit-ciudad'>Ciudad</label>
                <input id='edit-ciudad' name='ciudad' value='" . $equipo->getCiudad()->value() . "'><br>

                <label for='edit-categoria'>Categoría</label>
                <input id='edit-categoria' name='categoria' value='" . $equipo->getCategoria()->value() . "'><br>

                <button class='button primary'>Actualizar equipo</button>
            </form>
            ";
      break;

    case 'equipo.update':
      $command = new UpdateEquipoCommand(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['eslogan'],
        $_POST['tecnicoId'],
        $_POST['pais'],
        $_POST['ciudad'],
        $_POST['categoria']
      );
      $updateEquipoService->execute($command);
      echo "Equipo actualizado";
      break;

    case 'equipo.delete':
      $deleteEquipoService->execute($_GET['id']);
      echo "Equipo eliminado";
      break;

    case 'equipo.victoria':
      $registerVictoryService->execute($_GET['id']);
      echo "Victoria registrada";
      break;

    case 'equipo.gol':
      $registerGoalService->execute($_GET['id']);
      echo "Gol registrado";
      break;

    case 'equipo.empate':
      $registerDrawService->execute($_GET['id']);
      echo "Empate registrado";
      break;

    case 'equipo.expulsion':
      $registerExpulsionService->execute($_GET['id']);
      echo "Expulsión registrada";
      break;

    case 'equipo.campeonato':
      $registerChampionshipService->execute($_GET['id']);
      echo "Campeonato registrado";
      break;

    default:
      echo "404";
  }

} catch (Exception $e) {
  echo "<h3>Error:</h3>" . $e->getMessage();
}

echo "</div>";