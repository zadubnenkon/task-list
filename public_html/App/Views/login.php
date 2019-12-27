<section>
    <div class="container py-3 mt-5">
        <h2 class="text-center">Форма авторизации</h2>
        <form method='POST' action='/auth/login' class="col-8 col-md-6 col-lg-4 mx-auto">
          <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control" id="login" name="login" required>
          </div>
          <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Вход</button>
        </form>
    </div>
</section>