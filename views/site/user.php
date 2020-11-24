<?php
    $this->title = 'Пользователь '.$user->username;
?>

<table style="width: 100%">
    <tr>
        <th style="border: solid black 1px;">Пользователь</th>
        <th style="border: solid black 1px;">Пароль</th>
        <th style="border: solid black 1px;">Роль</th>
        <?php
        if(Yii::$app->user->identity->isAdmin()) {
            echo '<th style="border: solid black 1px;">Редактирование</th>';
        }
        ?>
    </tr>
    <tr>
        <td style="border: solid black 1px;" id="tableUsername"><?=$user->username?></td>
        <td style="border: solid black 1px;" id="tablePassword"><?=$user->password?></td>
        <td style="border: solid black 1px;" id="tableRole"><?=$user->role == 1 ? 'Администратор' : 'Пользователь'?></td>
        <?php
        if(Yii::$app->user->identity->isAdmin()) {
            echo '<td style="border: solid black 1px;"><a style="cursor: pointer" data-toggle="modal" data-target="#editModal">Редактировать</a></td>';
        }
        ?>
    </tr>
</table>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="<?=$user->id?>">
                <div class="form-group">
                    <label for="username">Пользователь</label>
                    <input type="text" class="form-control" id="username" value="<?=$user->username?>">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="text" class="form-control" id="password" value="<?=$user->password?>">
                </div>
                <div class="form-group">
                    <label for="role">Роль</label>
                    <select class="form-control" id="role">
                        <option value="0" <?=$user->role == 0 ? 'selected' : ''?>>Пользователь</option>
                        <option value="1" <?=$user->role == 1 ? 'selected' : ''?>>Администратор</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                <button type="button" class="btn btn-primary" id="btnSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("btnSave").addEventListener('click', function ()
    {
        $.ajax({
            url: '<?=Yii::$app->urlManager->createUrl(['site/saveuser', 'id' => $user->id])?>',
            method: 'POST',
            data: {
                username: document.getElementById("username").value,
                password: document.getElementById("password").value,
                role: document.getElementById("role").value,
            }
        }).done(function (){
            document.getElementById('tableUsername').innerText = document.getElementById("username").value;
            document.getElementById('tablePassword').innerText = document.getElementById("password").value;
            document.getElementById('tableRole').innerText = document.getElementById("role").value === '1' ? 'Администратор' : 'Пользователь';
            $('#editModal').modal('hide');
        });
    });
</script>