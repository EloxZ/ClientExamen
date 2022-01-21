<?php
    session_start();

    if (isset($_SESSION['login']) && isset($_SESSION['usuario'])) {
        $email = $_SESSION['usuario']->email;
    } else {
        header('Location: /login.php');
    }

    if (isset($_SESSION['server_msg'])) {
        echo $_SESSION['server_msg'];
        unset($_SESSION['server_msg']);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $file = $_FILES['imagen'];
        $id = $_POST['id'];


        $file_size = $file['size'];

        if (($file_size > 2*1024*1024)){
            $_SESSION['server_msg'] = "File too large. File must be less than 2 MB.";
            header('Location: .');
        } else if  ($file['type'] == 'image/jpg' || $file['type'] == 'image/png' || $file['type'] == 'image/jpeg'){
            $filename= $file['tmp_name'];
            $client_id = "531facc897ea14b"; // AQUI SU CLIENT ID
            $handle = fopen($filename, "r");
            $data = fread($handle, filesize($filename));
            $pvars   = array('image' => base64_encode($data));
            $timeout = 30;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
            $out = curl_exec($curl);
            curl_close ($curl);
            $pms = json_decode($out,true);
            $urlFoto="";
            
            if( isset( $pms['data']['link'] ) ){
                $urlFoto=$pms['data']['link'];
            }
        

            $url = 'https://examenserver.herokuapp.com/articulos/add';
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, true);

            $data = array(
                "descripcion" => $_POST['descripcion'],
                "precio" => $_POST['precio'],            
                "vendedor" => $email,
                "foto" => $urlFoto
            );
            
            $json = json_encode($data);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $output = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch); 
            $result = json_decode($output);
            
            $_SESSION['server_msg'] = $result->data->msg;
            
            header('Location: ../index.php');
        }
    }
?>


<h1>Publicar articulo</h1>

<form action="crear_articulo.php" method="POST">
    <input placeholder="Descripción" name="descripcion" required>
    <input placeholder="Precio de salida" name="precio" required>
    <input type="file" name="imagen" type="image/jpeg, image/jpg, image/png">
    <input type="submit" value="Crear">
</form>


<a href="../index.php" class="btn btn-danger">Cancelar</a>