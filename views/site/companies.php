<?php
    $this->title = 'Компании';
?>
<?php
if(Yii::$app->user->identity->isAdmin()):
?>
<div class="text-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
        Добавить новую компанию
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление новой компании</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="companyName">Название компании</label>
                    <input type="text" class="form-control" id="companyName">
                </div>
                <div class="form-group">
                    <label for="companyINN">ИНН</label>
                    <input type="number" class="form-control" id="companyINN" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="companyDirector">Генеральный директор</label>
                    <input type="text" class="form-control" id="companyDirector">
                </div>
                <div class="form-group">
                    <label for="companyAddress">Адрес</label>
                    <input type="text" class="form-control" id="companyAddress">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                <button type="button" class="btn btn-primary" id="btnSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>
<hr/>
<?php endif; ?>
<table style="width: 100%">
    <tr>
        <th style="border: solid black 1px;">Название компании</th>
        <th style="border: solid black 1px;">ИНН</th>
        <th style="border: solid black 1px;">Генеральный директор</th>
        <th style="border: solid black 1px;">Адрес</th>
    </tr>
    <?php foreach ($companies as $company):?>
    <tr>
        <td style="border: solid black 1px;"><a href="<?=Yii::$app->urlManager->createUrl(['site/company', 'id' => $company->id])?>"><?=$company->name?></a></td>
        <td style="border: solid black 1px;"><?=$company->inn?></td>
        <td style="border: solid black 1px;"><?=$company->director?></td>
        <td style="border: solid black 1px;"><?=$company->address?></td>
    </tr>
    <?php endforeach;?>
</table>

<script type="text/javascript">
    document.getElementById("btnSave").addEventListener('click', function ()
    {
        $.ajax({
            url: '<?=Yii::$app->urlManager->createUrl(['site/create'])?>',
            method: 'POST',
            data: {
                companyName: document.getElementById("companyName").value,
                companyINN: document.getElementById("companyINN").value,
                companyDirector: document.getElementById("companyDirector").value,
                companyAddress: document.getElementById("companyAddress").value,
            }
        }).done(function (data){
            $('#createModal').modal('hide');
            let redirectUrl = '<?=Yii::$app->urlManager->createAbsoluteUrl(['site/company', 'id' => ''])?>';
            window.location.replace(redirectUrl + data);
        });
    });
</script>