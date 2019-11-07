<?php
    require 'config.php';
    require 'class/reservas.class.php';

    $reservas = new Reservas($pdo);
?>
<h1>Reservas</h1>

<a href="reservar.php">Adicionar Reserva </a> <br/><br/>

<form method="GET">
    <select name="ano">
        <?php for($q = date('Y'); $q >= 2000 ; $q--): ?>
        <option <?=($_GET['ano'] == $q)? 'selected="selected"':''?> > <?php echo $q; ?> </option>
        <?php endfor; ?>
    </select>
    <select name="mes">
        <option <?=($_GET['mes'] == '01')? 'selected="selected"':''?> >01</option>
        <option <?=($_GET['mes'] == '02')? 'selected="selected"':''?> >02</option>
        <option <?=($_GET['mes'] == '03')? 'selected="selected"':''?> >03</option>
        <option <?=($_GET['mes'] == '04')? 'selected="selected"':''?> >04</option>
        <option <?=($_GET['mes'] == '05')? 'selected="selected"':''?> >05</option>
        <option <?=($_GET['mes'] == '06')? 'selected="selected"':''?> >06</option>
        <option <?=($_GET['mes'] == '07')? 'selected="selected"':''?> >07</option>
        <option <?=($_GET['mes'] == '08')? 'selected="selected"':''?> >08</option>
        <option <?=($_GET['mes'] == '09')? 'selected="selected"':''?> >09</option>
        <option <?=($_GET['mes'] == '10')? 'selected="selected"':''?> >10</option>
        <option <?=($_GET['mes'] == '11')? 'selected="selected"':''?> >11</option>
        <option <?=($_GET['mes'] == '12')? 'selected="selected"':''?> >12</option>
    </select>
    <input type="submit" value="Mostrar" />
</form>

<?php
    if(empty($_GET['ano'])) {
        exit;
    }

    $data = $_GET['ano'].'-'.$_GET['mes'];
    $dia1 = date('w', strtotime($data));
    $dias = date('t', strtotime($data));
    $linhas = ceil(($dia1+$dias) / 7);
    $dia1 = -$dia1;
    $data_inicio = date('Y-m-d', strtotime($dia1.' days', strtotime($data)));
    $data_fim = date('Y-m-d', strtotime((($dia1 + ($linhas * 7) - 1)).' days', strtotime($data)));

    $lista = $reservas->getReservas($data_inicio, $data_fim);
/*
    foreach($lista as $item) {
        $data1 = date('d/m/Y', strtotime($item['data_inicio']));
        $data2 = date('d/m/Y', strtotime($item['data_fim']));

        echo $item['pessoa'].' reservou o carro '.$item['id_carro'].' entre '.$data1.' e '.$data2.'<br/>';
    }
*/
?>
<hr/>
<?php
    require 'calendario.php';
?>