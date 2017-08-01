<table border="0" width="100%">
    <tr>
        <td valign="top" align="left" height="150px" width="150px">
            <img src="./images/logo_en.png" height="100px">
        </td>
        <td valign="bottom" height="150px" width="90%">
            <h1 style='font-family: freesans'><?= $title ?></h1>
        </td>
        <td valign="top" align="right"  width="150px">
            <img src="./images/logo.png" height="100px">
        </td>

    </tr>
</table>

<center>
    <?= $table_html_rows ?>
</center>

<table>
    <tr>
        <td valign="middle" height="200px">
            <img src="<?= $sign_img_pah ?>">
        </td>
        <td valign="middle" height="200px">
            <h4>Client signature: </h4>
        </td>
    </tr>
</table>