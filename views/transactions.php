<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Income</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <!-- Table -->
    <table class="table table-dark table-hover">
        <!-- Table Header -->
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Check #</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <!-- Table Header ### -->

        <!-- Incomes -->
        <tbody>
            <?php
            if (isset($datas)  &&  !empty($datas)) :
                foreach ($datas as $data) :
                    $class = ($data['amount'] < 0) ? 'text-danger' : 'text-success';
            ?>
            <tr>
                <th scope="row"><?= format_Date($data['date']) ?></th>
                <td><?= $data['checkNumber'] ?></td>
                <td><?= $data['description'] ?></td>
                <td class="<?= $class ?>"><?= format_Dollor_Amount($data['amount']) ?> </td>
            </tr>
            <?php
                endforeach;
            endif;
            ?>

        </tbody>
        <!-- Incomes ### -->

        <!-- Total -->
        <tbody>
            <tr>
                <th colspan="3" class="text-end">Total Income:</th>
                <td><?= format_Dollor_Amount($totals['totalIncome'] ?? 0) ?></td>
            </tr>
            <tr>
                <th colspan="3" class="text-end" class="text-right">Total Expense:</th>
                <td><?= format_Dollor_Amount($totals['totalExpense'] ?? 0) ?></td>
            </tr>
            <tr>
                <th colspan="3" class="text-end">Net Total:</th>
                <td><?= format_Dollor_Amount($totals['netTotals'] ?? 0) ?></td>
            </tr>
        </tbody>
        <!-- Total### -->

    </table>
    <!-- Table ###-->

</body>

</html>