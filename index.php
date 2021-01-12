<?php
    $mysqli = new mysqli("db", "root", "root", "demo");
    if(isset($_POST['submit'])) {
        $author = htmlspecialchars($_POST['author']);
        $content = htmlspecialchars($_POST['content']);

        $insert_query = $mysqli->prepare("INSERT INTO citation (author, content) VALUES(?, ?)");
        $insert_query->bind_param('ss', $author, $content);
        $insert_query->execute();

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Citation</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div>
            <div>
                <p class='text-center mt-3'>Ajouter une citation</p>
            </div>
            <form action='' method='POST' style='display: flex;flex-direction: column;align-items: center;'>
                <input
                    class='form-control w-75 mb-3'
                    name='author'
                    type='text'
                    placeholder='Auteur'
                    required
                />
                <textarea
                    class='form-control w-75 mb-3'
                    name='content'
                    placeholder='Citation'
                    required
                ></textarea>
                <input
                    class='form-control w-50'
                    type='submit'
                    name='submit'
                    value='Enregistrer'
                />
            </form>

            <hr />
            <div>
                <p class='text-center'>Citations</p>
            </div>

            <?php
                $query = 'SELECT * FROM citation';
                $req = $mysqli->query($query);
                while($rows = $req->fetch_object()) {
                    $citations[] = $rows;
                }
                foreach ($citations as $citation) {
                    echo '<p style="margin: 5px;">'.$citation->author.': <br />'.$citation->content.'</p> <hr/>';
                }
            ?>

        </div>
    </body>
</html>
