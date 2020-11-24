<?php
    $this->title = 'Компания "'.$company->name.'"';
?>
<table style="width: 100%">
    <tr>
        <th style="border: solid black 1px;">Название компании</th>
        <th style="border: solid black 1px;">ИНН</th>
        <th style="border: solid black 1px;">Генеральный директор</th>
        <th style="border: solid black 1px;">Адрес</th>
        <?php
        if(Yii::$app->user->identity->isAdmin()) {
            echo '<th style="border: solid black 1px;">Редактирование</th>';
        }
        ?>
    </tr>
    <tr>
        <td style="border: solid black 1px;" id="tableName"><?=$company->name?></td>
        <td style="border: solid black 1px;" id="tableINN"><?=$company->inn?></td>
        <td style="border: solid black 1px;" id="tableDirector"><?=$company->director?></td>
        <td style="border: solid black 1px;" id="tableAddress"><?=$company->address?></td>
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
                <input type="hidden" value="<?=$company->id?>">
                <div class="form-group">
                    <label for="companyName">Название компании</label>
                    <input type="text" class="form-control" id="companyName" value="<?=$company->name?>">
                </div>
                <div class="form-group">
                    <label for="companyINN">ИНН</label>
                    <input type="number" class="form-control" id="companyINN" value="<?=$company->inn?>" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="companyDirector">Генеральный директор</label>
                    <input type="text" class="form-control" id="companyDirector" value="<?=$company->director?>">
                </div>
                <div class="form-group">
                    <label for="companyAddress">Адрес</label>
                    <input type="text" class="form-control" id="companyAddress" value="<?=$company->address?>">
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
            url: '<?=Yii::$app->urlManager->createUrl(['site/save', 'id' => $company->id])?>',
            method: 'POST',
            data: {
                companyName: document.getElementById("companyName").value,
                companyINN: document.getElementById("companyINN").value,
                companyDirector: document.getElementById("companyDirector").value,
                companyAddress: document.getElementById("companyAddress").value,
            }
        }).done(function (){
            document.getElementById('tableName').innerText = document.getElementById("companyName").value;
            document.getElementById('tableINN').innerText = document.getElementById("companyINN").value;
            document.getElementById('tableDirector').innerText = document.getElementById("companyDirector").value;
            document.getElementById('tableAddress').innerText = document.getElementById("companyAddress").value;
            $('#editModal').modal('hide');
        });
    });
</script>