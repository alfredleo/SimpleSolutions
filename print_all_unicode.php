<html>
<style>
    .table-striped tbody > tr:nth-child(odd) > td, .table-striped tbody > tr:nth-child(odd) > th {
        background-color: #f9f9f9;
    }
    .table-bordered td {
        border-left: 1px solid #dddddd;
    }
    .table-bordered {
        border: 1px solid #dddddd;
        border-collapse: separate;
        *border-collapse: collapse;
        border-left: 0;
    }
    .table th, .table td {
        padding: 4px;
        line-height: 20px;
        text-align: center;
        vertical-align: top;
        border-top: 1px solid #dddddd;
    }
    td, th {
        display: table-cell;
    }
    table {
        max-width: 100%;
        background-color: transparent;
        border-collapse: collapse;
        border-spacing: 0;
    }
</style>


<?php
echo ord('‘');die;
echo '<table class="table table-bordered table-striped"><tbody><tr>';
for ($i = 0; $i < 0xffff; $i++) {
    $isNewline = ($i % 32 === 0);
    if($isNewline && $i != 0) echo '</tr><tr>';
    echo '<td>';
    echo mb_convert_encoding('&#' . $i, 'UTF-8', 'HTML-ENTITIES');
    echo '</td>';
}
echo '</tr></tbody></table>';
?>
</html>