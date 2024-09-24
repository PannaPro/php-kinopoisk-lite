<?php /** @var App\Kernel\Auth\AuthInterface $auth */
$user = $auth->user();
?>

<header>
    <?php if ($auth->check()) { ?>
        <h3>User: <?php echo $user->email() ?> </h3>
        <form method="post" action="/logout">
            <button>Logout</button>
        </form>
    <?php } else { ?>
        <form method="get" action="/login">
            <button>Login</button>
        </form>
    <?php } ?>
</header>
