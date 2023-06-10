<!DOCTYPE html>

<html>

<head>
    <Title>Pendaftaran Asisten</Title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Pendaftaran Asisten Praktikum</h1>
        <form method="post" action="./AsistenView.php">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Kelas Praktikum</th>
                        <th>IPK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($list as $a) :
                    ?>
                        <tr class="bg-warning text-white">
                            <td><?= $no++; ?></td>
                            <td><?= $a['NIM'] ?></td>
                            <td><?= $a['NAMA'] ?></td>
                            <td><?= $a['PRAKTIKUM'] ?></td>
                            <td><?= $a['IPK'] ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
    </div>
    <a href="/AsistenController/logout">logout</a>
</body>

</html>