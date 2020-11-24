<?php
    $this->title = 'Пользователи';
?>

<table style="width: 100%">
    <tr>
        <th style="border: solid black 1px;">Пользователь</th>
        <th style="border: solid black 1px;">Пароль</th>
        <th style="border: solid black 1px;">Роль</th>
    </tr>
    <?php foreach ($users as $user):?>
    <tr>
        <td style="border: solid black 1px;"><a href="<?=Yii::$app->urlManager->createUrl(['site/user', 'id' => $user->id])?>"><?=$user->username?></a></td>
        <td style="border: solid black 1px;"><?=$user->password?></td>
        <td style="border: solid black 1px;"><?=$user->role == 1 ? 'Администратор' : 'Пользователь'?></td>
    </tr>
    <?php endforeach;?>
</table>
