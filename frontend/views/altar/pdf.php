<table border="0">
    <tr>
        <td valign="top" height="150px">
            <img src="./images/logo.png" width="150px">
        </td>
        <td valign="bottom" height="150px">
            <h1 style='font-family: freesans'></h1>
        </td>
    </tr>
</table>

<center>
    <?= $content ?>
</center>

<?php if (isset($signFilePath) && $signFilePath ) { ?>
    <table>
        <tr>
            <td valign="middle" height="300px">
                <img src="<?= $signFilePath ?>">
            </td>
            <td valign="middle" height="300px">
                <h4>Client signature: </h4>
            </td>
        </tr>
    </table>
<?php } ?>