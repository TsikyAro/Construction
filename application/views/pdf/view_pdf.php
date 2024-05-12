<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdf</title>
 </head>
 <body>
   <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>Object</th>
                <th>number</th>
            </tr>
        </thead>
        <tbody>
            <?php for( $i =0; $i<count($marques);$i++){?>
                <tr>
                    <td><?= $marques[$i]->idmarque?></td>
                    <td><?= $marques[$i]->nommarque?></td>
                    <td>Huhu</td>
                    <td>0214</td>
                </tr>
            <?php }?>
        </tbody>
    </table>
 </body>
 </html>