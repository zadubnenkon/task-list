<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="/public/scripts/jquery.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="container">
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item <?php if ($path == 'task_list') echo 'active'?>">
                        <a class="nav-link" href="/task/list/">Главная</a>
                      </li>
                      <?php if($isAdmin) :?>
                          <li class="nav-item">
                            <a class="nav-link" href="/auth/logout/">Выйти</a>
                          </li>
                      <?php else:?>
                          <li class="nav-item <?php if ($path == 'login') echo 'active'?>">
                            <a class="nav-link" href="/auth/login/">Авторизоваться</a>
                          </li>
                      <?php endif;?>
                  </ul>
                </div>
            </nav>
        </header>
        <main>
            <?php echo $body?>
        </main>
        <script src="/public/scripts/form.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>