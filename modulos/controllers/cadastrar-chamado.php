    <?php
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chamado";

    $conn = mysqli_connect($localhost, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_POST['tipoErro'] == "2") {
        $tipo_erro = 2;
    } else
    if ($_POST['tipoErro'] == "1") {
        $tipo_erro = 1;
    }

    $titulo = $_POST['Titulo'];

    $descricao = $_POST['Descricao'];

    $sql = "INSERT INTO chamados (titulo, tipo_erro, descricao) VALUES ('$titulo', '$tipo_erro', '$descricao');";

    $cadastro = mysqli_query($conn, $sql);

    if ($cadastro) {
        echo "<script> alert('Novo registro criado com sucesso')</script>";
    } else {
        echo "não";
        echo "<script>alert('Erro: " . $sql . "<br>" . mysqli_error($conn) . "')</script>";
    }

    exit('<script>location.href = "http://localhost/prototipo2/modulos/solicitante/index-solicitante.phtml"</script>');
    ?>