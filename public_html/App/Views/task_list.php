<?php if (is_array($tasks) && !empty($tasks)) :?>

<section>
    <div class="container py-3">
        <div class="col-lg-4 col-sm-6 mb-2">
            <select id="sortSelect" class="form-control" data-current="<?php echo $_SESSION['sort'];?>">
              <option value="id_desc">Сначала новые</option>
              <option value="done">Сначала выполненные</option>
              <option value="edited">Сначала отредактированные</option>
              <option value="name_asc">По имени (А -> Я)</option>
              <option value="name_desc">По имени (Я -> А)</option>
              <option value="email_asc">По email (A -> Z)</option>
              <option value="email_desc">По email (Z -> A)</option>
            </select>
        </div>
        <?php foreach ($tasks as $v):?>
            <div class="card mb-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h5>
                                <?php if($v['done']) :?>
                                    <span>Выполнено</span>
                                <?php else:?>
                                    <span>В процессе</span>
                                <?php endif;?>

                                <?php if($v['edited']) :?>
                                    <small> (отредактированно администратором)</small>
                                <?php endif;?>
                            </h5>
                        </div>
                        <div class="col-4">
                            <?php if ($isAdmin) :?>
                                <div class="float-right" data-id="<?php echo $v['id']?>">
                                    <?php if(!$v['done']) :?>
                                        <button class="btn btn-primary doneBtn">Done</button>
                                    <?php endif;?>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTaskEdit">Edit</button>
                                    <button class="btn btn-danger delBtn">&times;</button>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-3">
                        <h5 class="card-title"><?php echo$v['name']?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $v['email']?></h6>
                    </div>
                    <div class="col-9">
                        <p class="card-text"><?php echo $v['text']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if($totalPages > 1) :?>
        <nav>
          <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($curPage == 1) echo 'disabled'?>">
              <a class="page-link" href="/<?php echo $curPage - 1?>" tabindex="-1">Пред.</a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++):?>
            <li class="page-item <?php if ($curPage == $i) echo 'active'?>">
                <a class="page-link" href="/<?php echo $i?>">
                    <?php echo $i ?>
                </a>
            </li>
            <?php endfor;?>
            <li class="page-item <?php if ($curPage == $totalPages) echo 'disabled'?>">
              <a class="page-link" href="/<?php echo $curPage + 1?>">След.</a>
            </li>
          </ul>
        </nav>
        <?php endif; ?>
    </div>
</section>

<?php endif; ?>
<section>
    <div class="container py-3 mt-5">
        <h2 class="text-center">Добавить задачу</h2>
        <form method='POST' action='/task/add' class="form-row col-lg-8 mx-auto">
          <div class="form-group col-6">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group col-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group col-12">
            <label for="taskText">Текст задачи</label>
            <textarea class="form-control" id="taskText" name = "text" rows="3" placeholder="Не более 300 символов" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Создать</button>
        </form>
    </div>
</section>
<?php if($isAdmin) :?>

<div class="modal fade" id="modalTaskEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="text-center">Редактировать текст задачи #<span id="taskId"></span></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method='POST' action='/task/edit'>
      <div class="modal-body form-row">
        <input type="hidden" name="id" required>
        <div class="form-group col-12">
          <textarea class="form-control" name="text" rows="3" placeholder="Не более 300 символов" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="submit" class="btn btn-primary" name="submit">Сохранить</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php endif;?>
<script src="/public/scripts/task.js"></script>